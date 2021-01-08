@extends('layouts.app')

@section('content')
<div class="container py-5">

<h1>Account Information</h1>
<hr>
<form action="{{route('user-details-create')}}" method="POST">
    @csrf
    <div class="form-group">
        <input class="form-control" type="text" name="first_name" placeholder="First Name" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" type="text" name="last_name" placeholder="Last Name" required>
    </div>

    <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" type="text" name="postal_code" placeholder="Postal Code" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" type="text" name="mobile_number" placeholder="Mobile Number" required>
    </div>
        
    <div class="form-group">
        <input class="form-control" type="text" name="address_line" placeholder="Address Line" required>
    </div>

    <button type="submit" class="btn btn-secondary">Save</button>
</form>
</div>
    
@endsection