<?php

namespace App\Http\Controllers;

use App\Models\Winner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

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
}
