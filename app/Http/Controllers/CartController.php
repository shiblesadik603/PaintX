<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        
        if(auth()->user()->role == "admin"){
            return view('denied');
        }
        return view('cart');
    }
    public function addToCart($id)
    {
        $product = Item::findOrFail($id);

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "product_name" => $product->name,
                "photo" => $product->photo,
                "price" => $product->price,
                "quantity" => 1
            ];
        }

        
        session()->put('cart', $cart);


        if(auth()->user()->role == "admin"){
            return view('denied');
        }
        return redirect()->back()->with('success', 'Product add to cart successfully!');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {
            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart successfully updated!');
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product successfully removed!');
        }
    }
}