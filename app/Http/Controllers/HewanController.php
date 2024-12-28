<?php

namespace App\Http\Controllers;

use App\Models\Hewan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HewanController extends Controller
{
    /**
     * Menampilkan data hewan dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hewan = Hewan::paginate(10); // Mengambil data hewan dengan pagination
        return view('content.Hewan.index', compact('hewan'));
    }

    /**
     * Menampilkan form untuk menambahkan hewan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Hewan.create');
    }

    /**
     * Menyimpan data hewan baru.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Validasi data
            $validatedData = $request->validate([
                'animal_Name' => 'required|string|max:255',
                'species' => 'required|string|max:255',
                'date_of_birth' => 'nullable|date',
                'gender' => 'required|in:male,female',
            ]);

            // Buat hewan baru
            Hewan::create($validatedData);

            // Commit transaksi
            DB::commit();

            // Tambahkan pesan sukses ke sesi
            session()->flash('success', 'Hewan berhasil ditambahkan.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Tambahkan pesan error ke sesi
            session()->flash('error', 'Gagal menambahkan hewan. Silakan coba lagi.');
        }

        return redirect()->route('hewan.index');
    }

    /**
     * Menampilkan form untuk mengedit data hewan.
     *
     * @param \App\Models\Hewan $hewan
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $animal = Hewan::findOrFail($id);
        return view('content.Hewan.edit', compact('animal'));
    }

    /**
     * Memperbarui data hewan.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Hewan $hewan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Hewan $hewan)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Validasi data
            $validatedData = $request->validate([
                'animal_Name' => 'required|string|max:255',
                'species' => 'required|string|max:255',
                'date_of_birth' => 'nullable|date',
                'gender' => 'required|in:male,female',
            ]);

            // Perbarui data hewan
            $hewan->update($validatedData);

            // Commit transaksi
            DB::commit();

            // Tambahkan pesan sukses ke sesi
            session()->flash('success', 'Hewan berhasil diperbarui.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Tambahkan pesan error ke sesi
            session()->flash('error', 'Gagal memperbarui hewan. Silakan coba lagi.');
        }

        return redirect()->route('hewan.index');
    }

    /**
     * Menghapus data hewan.
     *
     * @param \App\Models\Hewan $hewan
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Hewan $hewan)
    {
        // Mulai transaksi database
        DB::beginTransaction();

        try {
            // Hapus data hewan
            $hewan->delete();

            // Commit transaksi
            DB::commit();

            // Tambahkan pesan sukses ke sesi
            session()->flash('success', 'Hewan berhasil dihapus.');
        } catch (\Exception $e) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();

            // Tambahkan pesan error ke sesi
            session()->flash('error', 'Gagal menghapus hewan. Silakan coba lagi.');
        }

        return redirect()->route('hewan.index');
    }
}
