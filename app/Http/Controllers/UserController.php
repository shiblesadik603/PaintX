<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function index(){

        $items = Item::all();
        $cart = session()->get('cart', []);
        $cartLength = count($cart);

        if(auth()->user()->role == "admin"){
            return view('denied');
        }
        return view('user.index', compact('items','cartLength'));
    }
}
