@extends('layouts.app')

@section('content')
<div class="container py-5">
    @if (session()->has('error_msg'))
    <div class="alert alert-danger alert-dismissible fade show" role='alert'>
        {{ session('error_msg')}}
        <button type='button' class='close' data-dismiss="alert">
            <span aria-hidden='true'>x</span>
        </button>
    </div>
    @endif

    {{-- {{dd($data)}} --}}
{{-- {{dd($userDetails)}} --}}
    {{-- Billing Details --}}
<div class="card">
    <div class="card-title">
        <h1 class="text-center">Checkout</h1><hr>
        <div class="row">
        <div class="card-body col-md-6">
            <div class="card-title">
                <h2>Billing Details</h2>
            </div>
            <hr>
            <form action={{route('user-orders-cfm')}} method="POST">
            @csrf
            @if ($userDetails->isEmpty())
            Email Address
            <input type="text" class="form-control" name="email" required>
            Name
            <input type="text" class="form-control" name="name" required>
            Address
            <input type="text" class="form-control" name="address" required>
            City
            <input type="text"  class="form-control" name="city" required>
            @else
            Email Address
            <input type="text" value="{{$userDetails[0]->email}}" class="form-control" name="email" required>
            Name
            <input type="text" value="{{$userDetails[0]->firstname}} {{$userDetails[0]->lastname}}" class="form-control" name="name" required>
            Address
            <input type="text" value="{{$userDetails[0]->address}}" class="form-control" name="address" required>
            City
            <input type="text" value="{{$data->countryName}}, {{$data->cityName}}" class="form-control" name="city" required>
            <br>
            @endif
            {{-- Payment Details --}}
            @if ($userDetails->isEmpty())
            <div class="card-title">
                <h2>Payment Details</h2><hr>
            </div>
            Name on Card
            <input type="text" class="form-control" name="card_name" required>
            Address  
            <input type="text" class="form-control" name="card_address" required>
            Credit Card Number
            <input type="text" class="form-control" pattern="[0-9]{16}" name="card_number"placeholder="16 Digits Card Number" required>
            <div class="row">
                <div class="card-body col-md-5">
                    Expiry
                    <input type="month" class="form-control" name="card_expiry" required>
                </div>
                <div class="card-body col-md-4">
                    CVC Code
                    <input type="text" class="form-control" pattern="[0-9]{3}" name="card_cvc" placeholder="e.g 123" required>
                </div>   
            </div>
            <div class="row">
                <button type="submit" class="btn btn-success mx-auto" style="width: 40%; font-size: 25px;">Complete Order</button>
            </div>
        </form>
    </div>
    @else
    <div class="card-title">
        <h2>Payment Details</h2><hr>
    </div>
        
    Name on Card
    <input type="text" value="{{$userDetails[0]->firstname}} {{$userDetails[0]->lastname}}" class="form-control" name="card_name" required>
    Address  
    <input type="text" value="{{$userDetails[0]->address}}" class="form-control" name="card_address" required>
    Credit Card Number
    <input type="text" class="form-control" pattern="[0-9]{16}" name="card_number"placeholder="16 Digits Card Number" required>
    <div class="row">
        <div class="card-body col-md-5">
            Expiry
            <input type="month" class="form-control" name="card_expiry" required>
        </div>
        <div class="card-body col-md-4">
            CVC Code
            <input type="text" class="form-control" pattern="[0-9]{3}" name="card_cvc" placeholder="e.g 123" required>
        </div>   
    </div>
    <div class="row">
        <button type="submit" class="btn btn-success mx-auto" style="width: 40%; font-size: 25px;">Complete Order</button>
    </div>
</form>
</div>
    @endif

        {{-- Order Details --}}
        <div class="card-body col-md-6">
            <h2>Your Order</h2>
            <hr>
            @foreach ($cartCollection as $item)
            <div class="row">
                <div class="card-body col-md-3">
                    <img src="storage/images/{{$item->attributes->image}}" style="max-width:100%"><br>
                </div>
            <div class="card-body col-md-6">
            {{$item->name}}<br>
            {{$item->details}} <br>
            Price: ${{$item->price}} <br>
            Subtotal: ${{$item->getPriceSum()}}
            </div>
            <div class="card-body col-md-3">
            <div class="row mt-auto mb-auto">
                <div class="badge badge-pill badge-secondary" style="font-size: 20px">
                    {{$item->quantity}}
                </div>
            </div>
        </div>
            </div>
            @endforeach
            <hr>
            {{-- Payment Calculations --}}
            <div class="row">
                <div class="card-body col-md-6 ">
                    <div class="card-row">
                        Subtotal: 
                    </div>
                    <div class="card-row">
                        Tax (7%): 
                    </div>
                    <div class="card-row">
                        Discount
                        @if (isset($condition))
                        ({{$condition->getName()}}):
                        <a href="{{route('coupon.destroy')}}">Remove</a>
                        @endif
                    </div>
                    <hr>
                    <div class="card-row">
                    <b>Total:</b> 
                    </div>
                </div>
                <div class="card-body col-md-4 text-right">
                    <div class="card-row">
                        ${{number_format(Cart::session(Auth::user()->id)->getsubTotal(),2)}}
                    </div>
                    <div class="card-row">
                        ${{number_format(0.07*(\Cart::session(Auth::user()->id)->getsubTotal()),2)}}
                    </div>
                    <div class="card-row">
                        @if (isset($condition))
                        -${{number_format($condition->getCalculatedValue(\Cart::session(Auth::user()->id)->getsubTotal()),2)}}
                        @else
                        $0
                        @endif
                    </div>
                    <hr>
                    <div class="card-row">
                        @if (isset($condition))
                        <b>${{number_format((Cart::session(Auth::user()->id)->getsubTotal()
                         - $condition->getCalculatedValue(Cart::session(Auth::user()->id)->getsubTotal()) //Coupon
                         + 0.07*(Cart::session(Auth::user()->id)->getsubTotal())) //GST
                        , 2)}}</b>
                        @else
                        <b>${{number_format(Cart::session(Auth::user()->id)->getsubTotal()
                        +0.07*(Cart::session(Auth::user()->id)->getsubTotal()),2)}}</b>
                        @endif
                    </div>
                </div>
            </div>     
            <hr>    
            
            {{-- Coupon Code --}}
            <div class="card">
            <form action="{{route('coupon.store')}}" method="POST">
                @csrf
                    <div class="card-row mx-2">
                        Have a code?
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <input class="form-control" type="text" name="coupon_code" placeholder="Coupon Code">
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-secondary">Apply</button>
                            </div>
                        </div>
                    </div> 
                </form>
            </div>
            @if (session()->has('success_msg'))
                <div class="alert alert-success alert-dismissible fade show" role='alert'>
                    {{ session('success_msg')}}
                    <button type='button' class='close' data-dismiss="alert">
                        <span aria-hidden='true'>x</span>
                    </button>
                </div>
            @endif
            </div>
        </div>
        
    </div>
</div>

@endsection