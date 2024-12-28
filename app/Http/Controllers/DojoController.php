<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Dojo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\IOFactory;

class DojoController extends Controller
{
    /**
     * Menampilkan data Dojo dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dojos = Dojo::paginate(10);
        return view('content.Dojo.index', compact('dojos'));
    }

    /**
     * Menampilkan form untuk membuat Dojo.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Dojo.create');
    }

    /**
     * Menyimpan data Dojo baru.
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
                'dojo_name' => 'required|string|max:255',
            ]);

            // Create the new Dojo
            Dojo::create($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Dojo created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Log the error
            Log::error('Failed to create Dojo: ' . $e->getMessage(), [
                'request' => $request->all(),
                'exception' => $e
            ]);

            // Flash error message to session
            session()->flash('error', 'Failed to create Dojo. Please try again.');
        }

        return redirect()->route('dojo.index');
    }

    /**
     * Menampilkan form untuk mengedit Dojo.
     *
     * @param \App\Models\Dojo $dojo
     * @return \Illuminate\Http\Response
     */
    public function edit(Dojo $dojo)
    {
        return view('content.Dojo.edit', compact('dojo'));
    }

    /**
     * Memperbarui data Dojo.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Dojo $dojo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Dojo $dojo)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'dojo_name' => 'required|string|max:255',
            ]);

            // Update the Dojo
            $dojo->update($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Dojo updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();
            // Log the error
            \Log::error('Failed to update Dojo: ' . $e->getMessage(), [
                'dojo_id' => $dojo->id,
                'request' => $request->all(),
                'exception' => $e
            ]);


            // Flash error message to session
            session()->flash('error', 'Failed to update Dojo. Please try again.');
        }

        return redirect()->route('dojo.index');
    }

    /**
     * Menghapus Dojo.
     *
     * @param \App\Models\Dojo $dojo
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Dojo $dojo)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Dojo
            $dojo->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Dojo deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete Dojo. Please try again.');
        }

        return redirect()->route('dojo.index');
    }

    public function importForm()
    {
        return view('content.Dojo.import');
    }

    /**
     * Mengimpor data Dojo dari file Excel.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import(Request $request)
    {
        // Validate the file upload
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:10240', // Limit the file size to 10MB
        ]);

        try {
            // Load the uploaded file
            $file = $request->file('file');
            $spreadsheet = IOFactory::load($file);

            // Get the first sheet
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray();

            // Skip the first row (header row)
            array_shift($rows);

            // Start a database transaction
            DB::beginTransaction();

            foreach ($rows as $row) {
                // Assuming the first column is 'dojo_name'
                $dojoName = $row[0]; // Adjust the index based on your Excel file structure

                // Create Dojo records
                Dojo::create([
                    'dojo_name' => $dojoName,
                ]);
            }

            // Commit the transaction
            DB::commit();

            // Flash success message
            session()->flash('success', 'Dojo data imported successfully.');

        } catch (Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Log the error
            Log::error('Failed to import Dojo: ' . $e->getMessage(), [
                'exception' => $e,
            ]);

            // Flash error message
            session()->flash('error', 'Failed to import Dojo data. Please try again.');
        }

        return redirect()->route('dojo.index');
    }
}
