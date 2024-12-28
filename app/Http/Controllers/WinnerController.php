<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class WinnerController extends Controller
{
    /**
     * Menampilkan data Winner dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $winners = Winner::paginate(10);
        return view('content.Winner.index', compact('winners'));
    }

    /**
     * Menampilkan form untuk membuat Winner.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Winner.create');
    }

    /**
     * Menyimpan data Winner baru.
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
                'winner_name' => 'required|string|max:255',
            ]);

            // Create the new Winner
            Winner::create($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Winner created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Log the error
            Log::error('Failed to create Winner: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);

            // Flash error message to session
            session()->flash('error', 'Failed to create Winner. Please try again.');
        }

        return redirect()->route('winner.index');
    }

    /**
     * Menampilkan form untuk mengedit Winner.
     *
     * @param \App\Models\Winner $winner
     * @return \Illuminate\Http\Response
     */
    public function edit(Winner $winner)
    {
        return view('content.Winner.edit', compact('winner'));
    }

    /**
     * Memperbarui data Winner.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Winner $winner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Winner $winner)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'winner_name' => 'required|string|max:255',
            ]);

            // Update the Winner
            $winner->update($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Winner updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Log the error
            Log::error('Failed to update Winner: ' . $e->getMessage(), [
                'winner_id' => $winner->winner_id,
                'request' => $request->all(),
                'exception' => $e
            ]);

            // Flash error message to session
            session()->flash('error', 'Failed to update Winner. Please try again.');
        }

        return redirect()->route('winner.index');
    }

    /**
     * Menghapus Winner.
     *
     * @param \App\Models\Winner $winner
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Winner $winner)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Winner
            $winner->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Winner deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete Winner. Please try again.');
        }

        return redirect()->route('winner.index');
    }

    public function importForm()
    {
        return view('content.Winner.import');
    }

    /**
     * Handle the import of winners from an Excel file.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        // Validate the file
        $request->validate([
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        try {
            // Load the Excel file
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);

            // Get the first sheet
            $sheet = $spreadsheet->getActiveSheet();

            // Loop through rows and insert into the database
            $rowIterator = $sheet->getRowIterator();
            $isFirstRow = true;
            foreach ($rowIterator as $row) {
                if ($isFirstRow) {
                    $isFirstRow = false; // Skip the first row (header)
                    continue;
                }

                // Get the cell value for the winner name
                $winnerName = $sheet->getCell('A' . $row->getRowIndex())->getValue();

                // Insert into database
                Winner::create([
                    'winner_name' => $winnerName,
                ]);
            }

            // Flash success message
            session()->flash('success', 'Winners imported successfully.');
        } catch (\Exception $e) {
            // Log the error and flash an error message
            Log::error('Failed to import Winners: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);
            session()->flash('error', 'Failed to import Winners. Please try again.');
        }

        return redirect()->route('winner.index');
    }
}
