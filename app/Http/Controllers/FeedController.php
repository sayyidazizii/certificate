<?php

namespace App\Http\Controllers;

use App\Models\Feed;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FeedController extends Controller
{
    /**
     * Menampilkan data Feed dengan pagination.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feeds = Feed::paginate(10);
        return view('content.Feed.index', compact('feeds'));
    }

    /**
     * Menampilkan form untuk membuat Feed.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
{
    $items = Item::all(); // Ambil semua data item
    return view('content.Feed.create', compact('items'));
}


    /**
     * Menyimpan data Feed baru.
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
            'item_id' => 'required|exists:items,item_id', // Ensure item_id is passed and exists in items table
            'feed_type' => 'required|in:Herbivore,Carnivore,Omnivore', // Feed type validation
            'expiration_date' => 'required|date|after_or_equal:today', // Expiration date validation
        ]);

        // Create the new feed using validated data
        Feed::create($validatedData);

        // Commit the transaction
        DB::commit();

        // Flash success message to session
        session()->flash('success', 'Feed created successfully.');

    } catch (\Exception $e) {
        // Rollback the transaction if something goes wrong
        DB::rollBack();

        // Log the error for debugging
        \Log::error($e->getMessage());

        // Flash error message to session
        session()->flash('error', 'Failed to create feed. Error: ' . $e->getMessage());
    }

    return redirect()->route('feed.index');
}


    /**
     * Menampilkan form edit untuk Feed.
     *
     * @param \App\Models\Feed $feed
     * @return \Illuminate\Http\Response
     */
    public function edit(Feed $feed)
    {
        $feed->expiration_date = \Carbon\Carbon::parse($feed->expiration_date);
        return view('content.Feed.edit', compact('feed'));
    }

    /**
     * Memperbarui data Feed.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Feed $feed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Feed $feed)
{
    DB::beginTransaction();

    try {
        // Validate data
        $validatedData = $request->validate([
            'feed_type' => 'required|in:Herbivore,Carnivore,Omnivore',
            'expiration_date' => 'required|date',
        ]);

        // Update feed
        $feed->update($validatedData);

        DB::commit();

        session()->flash('success', 'Feed updated successfully.');
    } catch (\Exception $e) {
        DB::rollBack();

        // Log the exception message for debugging
        \Log::error('Error updating feed: ' . $e->getMessage());

        // Flash error message to session
        session()->flash('error', 'Failed to update feed. Please try again.');
    }

    return redirect()->route('feed.index');
}


    /**
     * Menghapus Feed.
     *
     * @param \App\Models\Feed $feed
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Feed $feed)
    {
        // Start a database transaction
        DB::beginTransaction();

        try {
            // Delete the Feed
            $feed->delete();

            // Commit the transaction
            DB::commit();

            // Flash success message to session
            session()->flash('success', 'Feed deleted successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction if something goes wrong
            DB::rollBack();

            // Flash error message to session
            session()->flash('error', 'Failed to delete feed. Please try again.');
        }

        return redirect()->route('feed.index');
    }
}
