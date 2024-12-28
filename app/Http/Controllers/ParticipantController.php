<?php

namespace App\Http\Controllers;

use App\Models\Dojo;
use App\Models\Participant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ParticipantController extends Controller
{
    /**
     * Menampilkan data Participant dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $participants = Participant::paginate(10);
        return view('content.Participant.index', compact('participants'));
    }

    /**
     * Menampilkan form untuk membuat Participant.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Fetch all dojos to display in the dropdown
        $dojos = Dojo::all();
        return view('content.Participant.create', compact('dojos'));
    }

    /**
     * Menyimpan data Participant baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'participant_name' => 'required|string|max:255',
                'dojo_id' => 'required|exists:dojos,id', // Validate dojo_id exists in dojos table
            ]);

            // Create the new Participant
            Participant::create($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Participant created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Log the error
            Log::error('Failed to create Participant: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);

            // Flash error message to session
            session()->flash('error', 'Failed to create Participant. Please try again.');
        }

        return redirect()->route('participant.index');
    }

    /**
     * Menampilkan form untuk mengedit Participant.
     *
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\Response
     */
    public function edit(Participant $participant)
    {
        // Fetch all dojos to display in the dropdown
        $dojos = Dojo::all();
        return view('content.Participant.edit', compact('participant', 'dojos'));
    }

    /**
     * Memperbarui data Participant.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Participant $participant)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'participant_name' => 'required|string|max:255',
                'dojo_id' => 'required|exists:dojos,id', // Validate dojo_id exists in dojos table
            ]);

            // Update the Participant
            $participant->update($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Participant updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Log the error
            Log::error('Failed to update Participant: ' . $e->getMessage(), [
                'participant_id' => $participant->id,
                'request' => $request->all(),
                'exception' => $e
            ]);

            // Flash error message to session
            session()->flash('error', 'Failed to update Participant. Please try again.');
        }

        return redirect()->route('participant.index');
    }

    /**
     * Menghapus Participant.
     *
     * @param \App\Models\Participant $participant
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Participant $participant)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Participant
            $participant->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Participant deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete Participant. Please try again.');
        }

        return redirect()->route('participant.index');
    }

    public function importForm()
    {
        return view('content.Participant.import'); // Create this view for the form
    }

    /**
     * Handle the import of Participants from an Excel file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        // Validate the uploaded file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:10240', // Allow only Excel files
        ]);

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Load the spreadsheet
            $spreadsheet = IOFactory::load($request->file('file')->getPathname());
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Loop through the rows (skip the first row which is headers)
            foreach ($rows as $key => $row) {
                if ($key === 0) continue; // Skip the header row

                $participantName = $row[0];  // Participant name in the first column
                $dojoName = $row[1];         // Dojo name in the second column

                // Find the Dojo by name
                $dojo = Dojo::where('dojo_name', $dojoName)->first();

                // Skip if dojo is not found
                if (!$dojo) {
                    continue;
                }

                // Create a new Participant
                Participant::create([
                    'participant_name' => $participantName,
                    'dojo_id' => $dojo->id,  // Use the dojo ID from the found Dojo
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Flash success message
            session()->flash('success', 'Participants imported successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if an error occurs
            DB::rollBack();

            // Log the error
            Log::error('Failed to import Participants: ' . $e->getMessage(), [
                'exception' => $e
            ]);

            // Flash error message
            session()->flash('error', 'Failed to import Participants. Please try again.');
        }

        return redirect()->route('participant.index');
    }
}
