<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ObatController extends Controller
{
     /**
     * Menampilkan data unit dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $obats = Obat::with('item')->paginate(10);
        return view('content.Obat.index', compact('obats'));
    }
    /**
     * Menampilkan form untuk membuat obat baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mengambil data items untuk dipilih dalam dropdown
        $items = Item::all();
        return view('content.Obat.create', compact('items'));
    }

    public function store(Request $request)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Validasi data request
            $validatedData = $request->validate([
                'item_id' => 'required|exists:items,item_id',
                'medicine_type' => 'required|string|max:255',
                'dosage' => 'required|string|max:255',
                'expiration_date' => 'required|date|after_or_equal:today',
            ]);

            // Menyimpan data obat
            Obat::create($validatedData);

            // Commit transaksi
            DB::commit();

            // Flash pesan sukses ke session
            session()->flash('success', 'Obat berhasil dibuat.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada yang gagal
            DB::rollBack();

            // Flash pesan error ke session
            session()->flash('error', 'Gagal membuat obat. Silakan coba lagi.');
        }

        return redirect()->route('obat.index');
    }

    public function edit(Obat $obat)
    {
        $obat->expiration_date = \Carbon\Carbon::parse($obat->expiration_date);
        return view('content.Obat.edit', compact('obat'));
    }

    /**
     * Memperbarui data obat di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param \App\Models\Obat $obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Obat $obat)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Validasi data request
            $validatedData = $request->validate([
                'medicine_type' => 'required|string|max:255',
                'dosage' => 'required|string|max:255',
                'expiration_date' => 'required|date',
            ]);

            // Update data obat
            $obat->update($validatedData);

            // Commit transaksi
            DB::commit();

            // Flash pesan sukses ke session
            session()->flash('success', 'Obat updated successfully.');
        } catch (\Exception $e) {
            // Rollback transaksi jika ada yang gagal
            DB::rollBack();

            // Flash pesan error ke session
            session()->flash('error', 'Failed to update obat. Please try again.');
        }

        return redirect()->route('obat.index');
    }

    public function destroy(Obat $obat)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the unit
            $obat->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'obat deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete obat. Please try again.');
        }

        return redirect()->route('obat.index');
    }




}
