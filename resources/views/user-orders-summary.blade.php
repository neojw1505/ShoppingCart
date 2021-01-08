@extends('layouts.app')

@section('content')
    <div class="container py-5 w-50">
        <div class="card-row text-center pb-3">
            <h1><u>Order Summary</u></h1>
        </div>
        <div class="row">
            <div class="col-md-6">
                <h4>Order Number: {{$orderdetails[0]->orderId}}</h4>
            </div>
            <div class="col-md-6">
                <i class="fa fa-print fa-2x float-right"><small> Print</small></i>
            </div>
        </div>
        {{-- {{dd($billId)}} --}}
        {{-- {{dd($orderdetails)}} --}}
        <hr>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="card-body col-md-3">
                        <h5>Date</h5
                    <div class="card-body col-md-9 text-right">
                        {{date('D, d-M-Y H:i:s',strtotime($orderdetails[0]->created_at))}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="card-body col-md-3">
                        <h5>Total</h5>
                    </div>
                    <div class="card-body col-md-9 text-right">
                        ${{$orderdetails[0]->total}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="card-body col-md-3">
                        <h5>item(s)</h5>
                    </div>
                    <div class="card-body col-md-9 text-right">
                        {{count($orderdetails)}}
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="card-body col-md-3">
                        <h5>Paid by</h5>
                    </div>
                    <div class="card-body col-md-9 text-right">
                        Credit card
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="card-body col-md-3">
                        <h5>Address</h5>
                    </div>
                    <div class="card-body col-md-9 text-right">
                        {{$billId->address}}
                    </div>
                </div>
            </div>
        </div>

        @foreach ($orderdetails as $order)
        <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <img src="storage/images/{{$order->image_path}}" style="max-width: 100%" alt="img">
            </div>
            <div class="col-md-10 text-right">
                <div class="card-row">
                    <i>{{$order->name}}</i>
                </div>
                <div class="card-row">
                    <i>${{$order->price}}</i>
                </div>
                <div class="card-row">
                    <i>{{$order->details}}</i>
                </div>
                <div class="card-row">
                    <i>Quantity: {{$order->quantity}}</i>
                </div>
            </div>

        </div>
        <hr>
    </div>
    @endforeach
        <div class="row">
            <div class="col-md-6">
                <a href="{{'user-orders-summary?id=5'}}"><i class='fas fa-arrow-left fa-2x'  data-toggle="tooltip" title="Go to Previous Order"></i></a>
            </div>
            <div class="col-md-6 text-right">
                <a href="{{'user-orders-summary?id=6'}}"><i class='fas fa-arrow-right fa-2x'  data-toggle="tooltip" title="Go to Next order"></i></a>
            </div>
        </div>
    </div>
    {{-- {{$orders->items()}} --}}
    @endsection
