<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    //
    public function shop(Request $request, Product $pro)
    {
        if ($request->category_id == null) {
            $products = Product::paginate(6);
            return view('shop')
                ->withTitle('E-Commerce | Store')
                ->with(['products' => $products]);
        } else {
            $products = DB::table('products')->where('category_id', $request->category_id)->paginate(3);
            return view('shop')
                ->withTitle('E-Commerce | Store')
                ->with(['products' => $products]);
        }
    }

    public function cart()
    {
        //Login User
        if (Auth::check()) {
            $userId = auth()->user()->id;
            $cartCollection = \Cart::session($userId)->getContent();
            return view('cart')
                ->withTitle('E-COMMERECE STORE | CART')
                ->with(['cartCollection' => $cartCollection]);
        }
    }

    public function add(Request $request)
    {
        //Login User
        if (Auth::check()) {
            $userId = auth()->user()->id;
            \Cart::session($userId)->add(array(
                'id' => $request->id,
                'name' => $request->name,
                'price' => $request->price,
                'details' => $request->detail,
                'quantity' => $request->quantity,
                'attributes' => array(
                    'image' => $request->img,
                    'slug' => $request->slug
                )
            ));
            return redirect()->back()->with('success_msg', 'Item is Added to Cart!');
        }
    }

    public function remove(Request $request)
    {
        //Login User
        if (Auth::check()) {
            $userId = auth()->user()->id;
            \Cart::session($userId)->remove($request->id);
            return redirect()->route('cart.index')->with('success_msg', 'Item is removed');
        }
    }

    public function update(Request $request)
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            \Cart::session($userId)->update(
                $request->id,
                array(
                    'quantity' => array(
                        'relative' => false, //what is relative
                        'value' => $request->quantity
                    ),
                )
            );
            return redirect()->route('cart.index')->with('success_msg', 'Cart updated');
        }
    }

    public function clear()
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            \Cart::session($userId)->clear();
            return redirect()->route('cart.index')->with('success_msg', 'Cart Cleared!');
        }
    }

    public function checkout()
    {
        if (Auth::check()) {
            $userId = auth()->user()->id;
            $cartCollection = \Cart::session($userId)->getContent();
        }
        return view('cart-checkout')
            ->withTitle('E-COMMERECE STORE | CHECKOUT')
            ->with(['cartCollection' => $cartCollection]);
    }
}
