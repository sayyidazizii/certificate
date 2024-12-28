<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UnitController extends Controller
{
    /**
     * Menampilkan data unit dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units = Unit::paginate(10);
        return view('content.Unit.index', compact('units'));
    }

    /**
     * Menampilkan form untuk membuat unit.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Unit.create');
    }

    /**
     * Menyimpan data unit baru.
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
                'code' => 'required|unique:units',
                'name' => 'required',
            ]);

            // Create the new unit
            Unit::create($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Unit created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to create unit. Please try again.');
        }

        return redirect()->route('unit.index');
    }

    /**
     * Menampilkan form untuk mengedit unit.
     *
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        return view('content.Unit.edit', compact('unit'));
    }

    /**
     * Memperbarui data unit.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Unit $unit)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'code' => 'required|unique:units,code,' . $unit->id,
                'name' => 'required',
            ]);

            // Update the unit
            $unit->update($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Unit updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to update unit. Please try again.');
        }

        return redirect()->route('unit.index');
    }

    /**
     * Menghapus unit.
     *
     * @param \App\Models\Unit $unit
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Unit $unit)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the unit
            $unit->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Unit deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete unit. Please try again.');
        }

        return redirect()->route('unit.index');
    }
}
