@extends('layouts.app')

{{-- pull data from db orders table --}}
@section('content')
<div class="container w-75 py-5">
    <div class="card-row text-center">
        <h1><u>My Orders</u></h1>
    </div>
    <div class="container w-75">
        @if (count($orders)>0)
        @foreach ($orders as $order)
        <div class="card-body ">
            <div class="row">
                <div class="col-md-9">
                    <div class="card-row">
                        <h5>Order #{{$order->orderId}}</h5>
                    </div>
                    <div class="card-row">
                        <i>{{date('D, d-M-Y H:i:s',strtotime($order->created_at))}}</i>
                    </div>
                </div>
                <div class="col-md-3">
                    <form action="{{route('user-orders-details')}}">
                        <input type="hidden" value="{{$order->orderId}}" name='id'>
                        <input type="hidden" value="{{date('D, d-M-Y H:i:s',strtotime($order->created_at))}}" name='date'>
                        <button class="btn float-right" class='tooltip-test' title='Order ID: {{$order->orderId}}'><i class="fas fa-angle-right fa-2x text-dark"></i></button>
                    </form>
                </div>
            </div><hr>
        </div>
        @endforeach 
        @else
        <h2>You have no orders</h2>
        <h3>Click to start ordering 
            <i class='fas fa-arrow-right'></i>
            <a href="{{route('shop')}}"><i class="fas fa-shopping-cart"></i></a>
        </h3>
        @endif
        <div class="card-footer d-flex justify-content-center">
            {!! $orders->links() !!}
        </div>
    </div>
</div>
@endsection