<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Unit;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    /**
     * Menampilkan data unit dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::with(['category', 'unit'])->paginate(10);  // Mengambil data items dengan relasi category dan unit
        return view('content.Item.index', compact('items'));
    }

    public function create()
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('content.Item.create', compact('categories', 'units'));
       
    }

    /**
     * Menyimpan data item baru.
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
            $validatedData = $request->validate([
                'item_name' => 'required|string|max:255',
                'category_id' => 'required|exists:categoris,category_id',
                'unit_id' => 'required|exists:units,id',
                'stock' => 'required|integer|min:0',
                'unit_cost' => 'required|numeric|min:0',
                'unit_price' => 'required|numeric|min:0',
            ]);

            // Create the new item
            Item::create($validatedData);

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Item created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to create item. Please try again.');
        }

        return redirect()->route('item.index');
    }

    /**
     * Menampilkan form untuk mengedit item.
     *
     * @param \App\Models\Item $item
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item)
    {
        $categories = Category::all();
        $units = Unit::all();
        return view('content.Item.edit', compact('item', 'categories', 'units'));
    }

    /**
     * Memperbarui data unit.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Unit $item
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Item $item)
    {
    // Start a database transaction
    DB::beginTransaction();

    try {
        // Validate the request data
        $validatedData = $request->validate([
            'item_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categoris,category_id', // Ensure valid category
            'unit_id' => 'required|exists:units,id', // Ensure valid unit
            'stock' => 'required|integer|min:0', // Ensure stock is a valid integer
            'unit_cost' => 'required|numeric|min:0', // Ensure unit_cost is numeric and >= 0
            'unit_price' => 'required|numeric|min:0', // Ensure unit_price is numeric and >= 0
        ]);

        // Update the item
        $item->update($validatedData);

        // Commit the transaction
        DB::commit();

        // Flash success message to session
        session()->flash('success', 'Item updated successfully.');
    } catch (\Exception $e) {
        // Rollback the transaction if something goes wrong
        DB::rollBack();

        // Flash error message to session
        session()->flash('error', 'Failed to update item. Please try again.');
    }

    return redirect()->route('item.index');
    }

    public function destroy(Item $item)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the unit
            $item->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'item deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete item. Please try again.');
        }

        return redirect()->route('item.index');
    }





}
