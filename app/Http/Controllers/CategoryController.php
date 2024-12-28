<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Menampilkan data Category dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoris = Category::paginate(10);
        return view('content.Category.index', compact('categoris'));
    }
    /**
     * Menampilkan form untuk membuat Category.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('content.Category.create');
    }
    /**
     * Menyimpan data Category baru.
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
                'category_name' => 'required',
            ]);

            // Create the new Category
            Category::create($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Category created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to create category. Please try again.');
        }

        return redirect()->route('category.index');
    }
    public function edit(Category $categoris)
    {
        return view('content.Category.edit', compact('categoris'));
    }

    /**
     * Memperbarui data Category.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Category $categoris
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Category $categoris)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Validate the request data
            $request->validate([
                'category_name' => 'required',
            ]);

            // Update the Category
            $categoris->update($request->all());

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Category updated successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to update category. Please try again.');
        }

        return redirect()->route('category.index');
    }

    /**
     * Menghapus Category.
     *
     * @param \App\Models\Category $categoris
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $categoris)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Category
            $categoris->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Category deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete category. Please try again.');
        }

        return redirect()->route('category.index');
    }
}
