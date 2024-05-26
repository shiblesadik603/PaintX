<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use App\Models\Review;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $items = Item::where('name', 'LIKE', "%$query%")->get();
        if(auth()->user()->role == "user"){
            return view('denied');
        }
        return view('items.search', compact('items'));
    }

    public function create()
    {
        if(auth()->user()->role == "user"){
            return view('denied');
        }
        return view('items.create');
        
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Create a new item
        $item = new Item();
        $item->name = $validatedData['name'];
        $item->description = $validatedData['description'];

        // Store the photo
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $filename = time() . '.' . $photo->getClientOriginalExtension();
            $path = $photo->storeAs('uploads/products', $filename, 'public');
            $item->photo = $filename;
        }

        $item->price = $validatedData['price'];
        $item->save();

        
        if(auth()->user()->role == "user"){
            return view('denied');
        }
        return redirect()->route('admin.dashboard')->with('success', 'Item created successfully.');
    }

    public function edit($id)
    {
        $item = Item::findOrFail($id);
        if(auth()->user()->role == "user"){
            return view('denied');
        }
        return view('items.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $item = Item::findOrFail($id);

            // Update the item
            $item->name = $request->input('name');
            $item->description = $request->input('description');
            $item->price = $request->input('price');

            // Store the photo if provided
            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $filename = time() . '.' . $photo->getClientOriginalExtension();
                $path = $photo->storeAs('uploads/products', $filename, 'public');
                $item->photo = $filename;
            }

            $item->save();
            if(auth()->user()->role == "user"){
                return view('denied');
            }
            return redirect()->route('admin.dashboard')->with('success', 'Item updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error updating item: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        if(auth()->user()->role == "user"){
            return view('denied');
        }
        return redirect()->route('admin.dashboard')->with('success', 'Item deleted successfully.');
    }

    public function review($id){

        $item = Item::findOrFail($id);
        // check if the item is already bought by this user using purchase table
        //  Get the currently authenticated user
        $user = auth()->user();

        // Check if the item is already bought by this user
        $isBought = Purchase::where('Users_userID', $user->id)
                            ->where('Item_itemID', $item->itemID)
                            ->exists();

           // For example, if $isBought is true, the user has bought the item
        if ($isBought) {
            // Do something
            return view('user.review', compact('item'));
        } else {
            // Do something else
            return view('denied');
        }

    }
    public function submit_review(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'rating' => 'required|integer|between:1,5',
            'message' => 'required|string|max:255',
        ]);

        // Find the item
        $item = Item::findOrFail($id);

        // Check if the user has already submitted a review for this item
        $existingReview = Review::where('user_id', auth()->id())
                                ->where('item_id', $item->itemID)
                                ->exists();

        if ($existingReview) {
            return redirect()->back()->with('error', 'You have already submitted a review for this item.');
        }

        // Create a new review
        $review = new Review();
        $review->user_id = auth()->id();
        $review->item_id = $item->itemID;
        $review->rating = $validatedData['rating'];
        $review->message = $validatedData['message'];
        $review->save();

        return redirect()->route('users.profile')->with('success', 'Review submitted successfully.');
    }
}
