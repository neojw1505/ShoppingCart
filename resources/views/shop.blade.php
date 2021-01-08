@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top:80px">
        <nav aria-label="breadcrumb">
            <ol class='breadcrumb'>
                <li class='breadcrumb-item'><a href="/">Home</a></li>
                <li class='breadcrumb-item active' aria-current='page'>Shop</li>
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
                <button type='button' class='close' data-dismiss="alert">
                    <span aria-hidden='true'>x</span>
                </button>
            </div>
        @endif
        <div class='row justify-content-center'>
            <div class='col-lg-12'>
                <div class="row">
                    <div class="col-lg-7">
                        <h4>Products In Store</h4>
                    </div>
                
                </div>
                <hr>
                <div class="row">
                    @foreach ($products as $pro)
                        <div class="col-lg-4">
                            <div class="card" style='margin-bottom:20px; height:auto;'>
                            <img src="../storage/images/{{$pro->image_path}}"
                            class='card-img-top mx-auto'
                            style='height:200px; width:200px; display:block;'
                            alt='{{$pro->image_path}}'>
                            </div>
                            <div class="card-body">
                            <h6 class='card-title'>{{$pro->name}}</h6>
                            <i>{{$pro->details}}</i>
                            <p>${{$pro->price}}</p>
                            <a href="{{route('cart.test',$pro)}}">test</a>
                            <form action="{{route('cart.store')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$pro->id}}" id="id" name='id'>
                                <input type="hidden" value="{{$pro->name}}" id="name" name='name'>
                                <input type="hidden" value="{{$pro->details}}" id="details" name='details'>
                                <input type="hidden" value="{{$pro->price}}" id="price" name='price'>
                                <input type="hidden" value="{{$pro->image_path}}" id="img" name='img'>
                                <input type="hidden" value="{{$pro->slug}}" id="slug" name='slug'>
                                <input type="hidden" value='1' id="quantity" name='quantity'>
                                <div class="card-footer" style='background-color:white'>
                                    <div class="row">
                                        <button class='btn btn-secondary btn-sm' class='tooltip-test' title='Add items to cart'>
                                            <i class="fa fa-shopping-cart"></i>Add to Cart
                                        </button>
                                        <hr>
                                    </div>
                                </div>
                            </form>

                            {{-- Admin Remove --}}
                            @if (Auth::check() && Auth::user()->is_admin ==1)
                            <form action="{{route('admin.remove')}}" method="post">
                                @csrf
                                <input type="hidden" value="{{$pro->id}}" id="id" name='id'>
                                <input type="hidden" value="{{$pro->name}}" id="name" name='name'>
                                <input type="hidden" value="{{$pro->price}}" id="price" name='price'>
                                <input type="hidden" value="{{$pro->image_path}}" id="img" name='img'>
                                <input type="hidden" value="{{$pro->slug}}" id="slug" name='slug'>
                                <input type="hidden" value='1' id="quantity" name='quantity'>
                                <button class='btn btn-secondary btn-sm' class='tooltip-test' title='Delete permanently item ID:{{$pro->id}}'>
                                            <i class="fa fa-trash"></i> Remove Permanently
                                        </button>   
                                        <hr>
                            @endif
                            </form>
                            {{-- Admin Update --}}
                            @if (Auth::check() && Auth::user()->is_admin ==1)
                            <form action="{{route('admin.update')}}" method="post">
                                @csrf
                                <button class='btn btn-secondary btn-sm' class='tooltip-test' title='Click to Update item: {{$pro->name}}'>
                                    <i class="fa fa-edit"></i> Update Details</button>   
                                <input type="hidden" value="{{$pro->id}}" id="id" name='id'>
                                <input type="text" value="{{$pro->name}}" id="name" name='name'>
                                <input type="text" value="{{$pro->details}}" id="details" name='details'>
                                <input type="text" value="{{$pro->price}}" id="price" name='price'>
                                <input type="text" value="{{$pro->image_path}}" id="img" name='img'>
                                <input type="hidden" value="{{$pro->slug}}" id="slug" name='slug'>
                                <input type="hidden" value='1' id="quantity" name='quantity'>
                            @endif
                            </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {!! $products->links() !!}
        </div>
    </div>

@endsection