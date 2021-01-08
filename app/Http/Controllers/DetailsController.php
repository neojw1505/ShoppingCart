<?php

namespace App\Http\Controllers;

use App\Models\Detail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DetailsController extends Controller
{
    //
    public function index()
    {
        $details = Detail::where('userId', Auth::user()->id)->get();
        return view('partials.user-details')->with(['details' => $details]);
    }

    public function create(Request $request)
    {
        $data = [
            'userId' => Auth::user()->id,
            'firstname' => $request->first_name,
            'lastname' => $request->last_name,
            'email' => $request->email,
            'postalcode' => $request->postal_code,
            'mobile' => $request->mobile_number,
            'address' => $request->address_line,
        ];
        Detail::create($data);
        return redirect()->route('user-details');
    }

    public function read()
    {
        $details = Detail::where('userId', Auth::user()->id)->get();
        return view('partials.user-details-edit')->with(['details' => $details]);
    }

    public function update(Request $request)
    {
        Detail::where('userId', Auth::user()->id)->update(
            [
                'firstname' => $request->first_name,
                'lastname' => $request->last_name,
                'email' => $request->email,
                'postalcode' => $request->postal_code,
                'mobile' => $request->mobile_number,
                'address' => $request->address_line,
            ]
        );
        return redirect()->route('user-details');
    }
}
