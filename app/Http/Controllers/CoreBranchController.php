<?php

namespace App\Http\Controllers;

use App\Models\CoreBranch;
use Illuminate\Http\Request;

class CoreBranchController extends Controller
{
    /**
     * Menampilkan daftar Core Branch dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $branches = CoreBranch::paginate(10); // Mengambil data Core Branch dengan pagination
        return view('content.CoreBranch.index', compact('branches'));
    }

    public function create()
    {
        return view('content.CoreBranch.create');
    }

    /**
     * Menyimpan data Core Branch baru ke dalam database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'branch_code' => 'required|unique:core_branch,branch_code',
            'branch_name' => 'required|string|max:255',
            'branch_city' => 'required|string|max:255',
            'branch_address' => 'required|string|max:500',
            'branch_manager' => 'required|string|max:255',
            'branch_email' => 'required|email|max:255',
            'branch_phone1' => 'required|string|max:20',
        ]);

        // Menyimpan data Core Branch baru
        CoreBranch::create([
            'branch_code' => $request->branch_code,
            'branch_name' => $request->branch_name,
            'branch_city' => $request->branch_city,
            'branch_address' => $request->branch_address,
            'branch_manager' => $request->branch_manager,
            'branch_email' => $request->branch_email,
            'branch_phone1' => $request->branch_phone1,
        ]);

        // Redirect ke halaman utama dengan pesan sukses
        return redirect()->route('CoreBranch.index')->with('success', 'Branch created successfully!');
    }


    public function edit($id)
    {
        $branch = CoreBranch::findOrFail($id);
        return view('content.CoreBranch.edit', compact('branch'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $branch = CoreBranch::findOrFail($id);

        $branch->update([
            'branch_code' => $request->branch_code,
            'branch_name' => $request->branch_name,
            'branch_city' => $request->branch_city,
            'branch_address' => $request->branch_address,
            'branch_manager' => $request->branch_manager,
            'branch_email' => $request->branch_email,
            'branch_phone1' => $request->branch_phone1,
        ]);

        return redirect()->route('CoreBranch.index')->with('success', 'Branch updated successfully!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $branch = CoreBranch::findOrFail($id);
        $branch->delete();

        return redirect()->route('CoreBranch.index')->with('success', 'Branch deleted successfully.');
    }
}