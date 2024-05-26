<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function session(Request $request)
    {
        $productItems = [];

        Stripe::setApiKey(config('stripe.sk'));

        foreach (session('cart') as $id => $details) {


            $product_name = $details['product_name'];
            $total = $details['price'];
            $quantity = $details['quantity'];

            $unit_amount = $total * 100;

            $productItems[] = [
                'price_data' => [
                    'product_data' => [
                        'name' => $product_name,
                    ],
                    'currency'     => 'USD',
                    'unit_amount'  => $unit_amount,
                ],
                'quantity' => $quantity
            ];
        }

        //create a checkout session
        $checkoutSession = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items'           => $productItems,
            'mode'                 => 'payment',
            'success_url'          => route('success'),
            'cancel_url'           => route('cancel'),
        ]);

        if(auth()->user()->role == "admin"){
            return view('denied');
        }
        return redirect()->away($checkoutSession->url);
    }

    public function success(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart = $request->session()->get('cart');
            foreach ($cart as $id => $details) {
                $item = Item::findOrFail($id);
                Purchase::create([
                    'purchaseDate' => now()->format('Y-m-d'),
                    'purchaseQuantity' => $details['quantity'],
                    'Item_itemID' => $id,
                    'Users_userID' => auth()->user()->id,
                    'payAmount' => $details['price'],
                ]);
            }
            $request->session()->forget('cart');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error completing purchase: ' . $e->getMessage());
            return redirect()->route('cancel');
        }
        if(auth()->user()->role == "admin"){
            return view('denied');
        }
        return view('success');
    }


    public function cancel()
    {
        if (auth()->user()->role == 'Admin' || auth()->user()->role == 'Employee') {
            return view('denial.admin');
        }
        if(auth()->user()->role == "admin"){
            return view('denied');
        }
        return view('cancel');
    }
}
