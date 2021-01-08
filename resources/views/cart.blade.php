@extends('layouts.app')

@section('content')
    <div class="container" style='margin-top:80px'>
        <nav aria-label='breadcrumb'>
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href="/">Shop</a></li>
                <li class='breadcrumb-item active' aria-current="page">Cart</li>
            </ol>
        </nav>

        @if (session()->has('success_msg'))
        <div class='alert alert-success alert-dismissable fade show' role="alert">
            {{ session()->get('success_msg')}}
            <button type='button' class='close' data-dismiss='alert' aria-label="Close">
                <span aria-hidden="true">x</span>
            </button>            
        </div>
        @endif
        @if (session()->has('alert_msg'))
            <div class="alert alert-warning alert-dismissible fade show" role='alert'>
                {{ session()->get('alert_msg')}}
                <button type='button' class='close' data-dismiss="alert" aria-label="Close">
                    <span aria-hidden='true'>x</span>
                </button>
            </div>
        @endif
        @if (count($errors)>0)
            @foreach ($errors>all() as $error)
                <div class="alert alert-success alert-dismissible fade show" role='alert'>
                    {{$error}}
                    <button type='button' class='close' data-dismiss="alert" aria-label="Close">
                        <span aria-hidden='true'>x</span>
                    </button>
                </div>
            @endforeach    
        @endif
        <div class="row justify-content-center">
            <div class="col-lg-7">
                <br>
                {{-- Login User Qty--}}
                @if (Auth::check())
                    @if (\Cart::session(Auth::user()->id)->getTotalQuantity()>0)
                        <h4>{{ \Cart::session(Auth::user()->id)->getTotalQuantity()}} Product(s) in Your Cart</h4><br>
                    @else
                        <h4>No Product(s) In Your Cart</h4><br>
                    <a href="{{route('shop')}}" class="btn btn-dark">Continue Shopping</a>    
                        @endif
                @endif
                {{-- Login User Cart --}}
                @if(Auth::check())
                @foreach ($cartCollection as $item)
                    <div class="row">
                        <div class="col-lg-3">
                            <img src="storage/images/{{$item->attributes->image}}" class='img-thumbnail' width='200' height='200'> 
                        </div>
                        <div class="col-lg-5">
                            <p>
                                <b><a href="/{{route('shop')}}/{{$item->attributes->slug}}">{{$item->name}}</a></b><br>
                                <b>Price: </b>${{$item->price}} <br>
                                <b>Sub Total: </b>${{$item->getPriceSum()}}<br>
                            </p>
                        </div>
                        <div class="col-lg-4">
                            <div class="row">
                                <form action="{{route('cart.update')}}" method="post">
                                    @csrf
                                    <div class="form-group row">
                                        <input type="hidden" value="{{$item->id}}" id="id" name="id">
                                        <input type="number" class="form-control form-control-sm" value="{{$item->quantity}}" 
                                                id="quantity" name="quantity" min="0" style="width:70px; margin-right:10px;">
                                        <button class="btn btn-secondary btn-sm" data-toggle="tooltip" title="Click to Update Quantity" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>  
                                    </div>
                                </form>
                                <form action="{{route('cart.remove')}}" method="post">
                                    @csrf
                                    <input type="hidden" value="{{$item->id}}" name="id" id="id">
                                    <button class='btn btn-dark btn-sm' data-toggle="tooltip" title="Click to Remove Item" style="margin-right: 10px;"><i class="fa fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                @if (count($cartCollection)>0)
                <form action="{{route('cart.clear')}}" method="POST">
                    @csrf
                    <button class="btn btn-secondary btn-md">Clear Cart</button>
                </form>
                @endif
            </div>
                @if (count($cartCollection)>0)
                    <div class="col-lg-5">
                        <div class="card">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Total: </b>${{round(\Cart::getsubTotal(),2)}}</li>
                            </ul>
                        </div>
                        <br><a href="{{route('shop')}}" class="btn btn-dark">Continue Shopping</a>
                        <a href="{{route('cart.checkout')}}" class="btn btn-success">Proceed to checkout</a>
                    </div>
                @endif
            </div>
            <br><br>
        </div>
        @endif
    @endsection

