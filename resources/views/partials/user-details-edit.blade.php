@extends('layouts.app')

@section('content')
<div class="container py-5">

<h1>Account Information</h1>
<hr>
{{-- {{dd($details)}} --}}
<form action="{{route('user-details-update')}}" method="POST">
    @csrf
    <div class="form-group">
    <input class="form-control" value="{{$details[0]->firstname}}" type="text" name="first_name" placeholder="First Name" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" value="{{$details[0]->lastname}}" type="text" name="last_name" placeholder="Last Name" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" value="{{$details[0]->email}}" type="email" name="email" placeholder="Email" required>
    </div>
    
    <div class="form-group">
        <input class="form-control" value="{{$details[0]->postalcode}}" type="text" name="postal_code" placeholder="Postal Code" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" value="{{$details[0]->mobile}}" type="text" name="mobile_number" placeholder="Mobile Number" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" value="{{$details[0]->address}}" type="text" name="address_line" placeholder="Address Line" required>
    </div>
    <button type="submit" class="btn btn-secondary">Save</button>
</form>
</div>
    
@endsection