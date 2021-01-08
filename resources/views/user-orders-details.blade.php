@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row">
        <h1>My Orders</h1>
    </div>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                Order #{{($orders['orderId'])}}
            </div>
            <div class="row">
            {{date('D, d-M-Y H:i:s',strtotime($orders['created_at']))}}
            </div>
        </div>
    </div>
    <hr>
    {{-- {{dd($orderdetails)}} --}}
    <div class="row">
        {{count($orderdetails) . ' item(s)'}}
    </div>
    <br>
    @foreach ($orderdetails as $order)
    <div class="row">
        <img src="storage/images/{{$order->image_path}}" style="max-width: 10%;" alt="img">
    </div>
    <hr>
    @endforeach
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <b><h4>View Details</h4></b>
            </div>
        </div>
        <div class="col-md-2">
            <form action="{{route('user-orders-summary')}}">
                <input type="hidden" value="{{$orders['orderId']}}" name="id">
                <button class="btn"><i class="fas fa-angle-right fa-2x text-dark"></i></button>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <b><h4>Track Order</h4></b>
            </div>
        </div>
        <div class="col-md-2">
            <button class="btn"><i class="fas fa-angle-right fa-2x text-dark"></i></button>
        </div>
    </div>
</div>
@endsection