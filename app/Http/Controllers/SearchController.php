<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $search = $request->input('search');
        if ($search != "") {
            $products = Product::where('name', 'LIKE', '%' . $search . '%')->get();
            return view('search')->withDetails($products)->withQuery($search);
        }
    }
}
