@extends('layouts.app')

@section('content')
    <div class="container d-flex py-5 justify-content-center">
        <div class="col-md-8 text-center">
            <i class="fas fa-check-circle fa-5x" style="color: green"></i>
            <h1>Order Confirmed!</h1>
            <h2>Order Number: {{$orders[count($orders)-1]->orderId}}</h2>
        </div>
    </div>
{{-- {{dd($cartCollection)}} --}}
{{-- {{dd($billing)}} --}}
{{-- {{dd($payment)}} --}}

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3>Delivery Details</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card-body col-md-8">
                        <div>
                            <div class="card-title">
                                <b>Delivery for</b>
                            </div>
                            {{$billing[count($billing)-1]->name}}    <br>
                            {{$billing[count($billing)-1]->mobile}} 
                        </div>
                        <br>
                        <div>
                            <div class="card-title">
                            <b>Address</b> 
                            </div>
                            {{$billing[count($billing)-1]->address}}
                        </div>
                    </div>
                    <div class="card-body col-md-4">
                        <div class="card-title">
                        <b>Delivery method</b><br>
                        </div>
                        Standard Delivery
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Order Summary</h3>
            </div>
            @foreach ($cartCollection as $item)
            <div class="row">
                <div class="card-body col-md-2">
                <img src="storage/images/{{$item->attributes->image}}" style="height: 100px; width:100px;">
                </div>
                <div class="card-body col-md-4">
                    <div class="card-row">
                        {{$item->name}}
                    </div> 
                    <div class="card-row">
                        {{$item->attributes->slug}}
                    </div>
                    <div class="card-row">
                        Qty:{{$item->quantity}}
                    </div>
                </div>
            </div>
            @endforeach
            <hr>
            <div class="row">
                <div class="card-body col-md-8">
                    <div class="card-row">
                        Sub-Total 
                    </div>
                    <div class="card-row">
                        Tax
                    </div>
                    <div class="card-row">
                        Discount
                    </div>
                    <hr>
                    <div class="card-row">
                        <b>Total</b>
                    </div>
                </div>
                <div class="card-body col-md-4">
                    <div class="card-row">
                        ${{\Cart::getsubTotal()}}
                    </div>
                    <div class="card-row">
                        ${{number_format(0.07*(\Cart::session(Auth::user()->id)->getsubTotal()),2)}}
                    </div>
                    <div class="card-row">
                        @if (isset($condition))
                        ${{number_format($condition->getCalculatedValue(\Cart::getsubTotal()),2)}}
                        @else
                        $0
                        @endif
                    </div>
                    <hr>
                    <div class="card-row">
                        ${{number_format(\Cart::session(Auth::user()->id)->getsubTotal()
                            +0.07*(\Cart::session(Auth::user()->id)->getsubTotal()),2)}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3>Payment Information</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="card-body col-md-8">
                        <b>Credit Card</b>  
                        <div class="card-row">
                            Card Number: {{$payment[count($payment)-1]->cardNumber}}
                        </div>
                        <div class="card-row">
                            Expiry Date {{$payment[count($payment)-1]->cardExpiry}}
                        </div>
                        <div class="card-row">
                            Amount: ${{number_format(Cart::session(Auth::user()->id)->getsubTotal()
                                +0.07*(Cart::session(Auth::user()->id)->getsubTotal()),2)}}
                        </div>
                    </div>
                    <div class="card-body col-md-4">
                        <b>Billing address:</b>  
                        <div class="card-row">
                            {{$billing[count($billing)-1]->name}}
                        </div>
                        <div class="card-row">
                            {{$billing[count($billing)-1]->address}}
                        </div>
                        <div class="card-row">
                            {{$billing[count($billing)-1]->mobile}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center">
            <a class="btn btn-success btn-lg text-white my-3" href="{{route('shop')}}">Back To Home</a>
        </div>
    </div>
    {{-- {{\Cart::session(Auth::user()->id)->clear()}} --}}
@endsection