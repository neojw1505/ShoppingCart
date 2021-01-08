<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function remove(Request $request)
    {
        DB::table('products')->delete($request->id);
        return redirect()->route('shop')->with('success_msg', 'Item Permanently removed');
    }

    public function update(Request $request)
    {
        DB::table('products')->where('id', $request->id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'image_path' => $request->img,
        ]);
        return redirect()->route('shop')->with('success_msg', 'Item Updated!');
    }

    public function create(Request $request)
    {
        $image_name = $request->img->getClientOriginalName();
        $image = $request->img->storeAs('images', $image_name, 'public');

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'image_path' => $image_name,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ];
        Product::create($data);
        return redirect()->route('shop')->with('success_msg', 'Item Created!');
    }
}
