<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Review;
use Illuminate\Http\Request;

class ProductController extends Controller
{



    public function prooduct_detail($id)
    {
        $item = Item::findOrFail($id);
        $cart = session()->get('cart', []);
        $cartLength = count($cart);

        $reviews = Review::where('item_id', $id)->get();
        // dd($reviews);

        // if(auth()->user()->role == "user"){
        //     return view('denied');
        // }
        return view('user.product_details', compact('item','cartLength','reviews'));
    }

}
