<?php

namespace App\Http\Controllers;

use App\Models\Cage;
use App\Models\Hewan;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CageController extends Controller
{
    /**
     * Menampilkan data Cage dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cages = Cage::paginate(10);
        return view('content.Cage.index', compact('cages'));
    }
    /**
     * Menampilkan form untuk membuat Cage.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $animals = Hewan::all();
        return view('content.Cage.create', compact('animals'));
    }
    /**
     * Menyimpan data Cage baru.
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
            $request->validate(rules: [
                'cage_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer|min:0',
                'animal_id' => 'required|exists:animals,animal_id',
            ]);

            // Create the new Cage
            Cage::create($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Cage created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to create cage. Please try again.');
        }

        return redirect()->route('cage.index');
    }
    public function edit(Cage $cages)
    {
        $animals = Hewan::all();
        return view('content.Cage.edit', compact('cages', 'animals'));
    }

    /**
     * Memperbarui data Cage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cage $cages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Cage $cages)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'cage_name' => 'required|string|max:255',
                'location' => 'required|string|max:255',
                'capacity' => 'required|integer|min:0',
                'animal_id' => 'required|exists:animals,animal_id',
            ]);

            // Update the Cage
            $cages->update($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Cage updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to update Cage. Please try again.');
        }

        return redirect()->route('cage.index');
    }

    /**
     * Menghapus Cage.
     *
     * @param \App\Models\Cage $cages
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Cage $cages)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Cage
            $cages->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Cage deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete Cage. Please try again.');
        }

        return redirect()->route('cage.index');
    }
}
