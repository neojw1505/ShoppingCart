{{-- Login User --}}
@if(Auth::check())
@if (count(\Cart::session(Auth::user()->id)->getContent())>0)
    @foreach (\Cart::session(Auth::user()->id)->getContent() as $item)
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-3">
                <img src="../storage/images/{{$item->attributes->image}}" style="width: 50px; height:50px; position: fill;">
            </div>
            <div class="col-lg-5">
                <b>{{$item->name}}</b>
                <br><small>Qty: {{$item->quantity}}</small>
            </div>
            <div class="col-lg-2 my-auto">
                <p>${{ \Cart::session(Auth::user()->id)->get($item->id)->getPriceSum()}}</p>    
            </div>
            <div class="col-lg-1 mx-2">
            
            </div>
            <hr>
        </div>
    </li>
    @endforeach
    <br>
    <li class="list-group-item">
        <div class="row">
            <div class="col-lg-10">
                <b>Total: </b>${{\Cart::getsubTotal()}}
            </div>
            <div class="col-lg-2">
                <form action="{{route('cart.clear')}}" method="post">
                @csrf
                    <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                </form>
            </div>
        </div>
    </li>
    <br>
    <div class="row" style="margin: 0px;">
        <a class='btn btn-dark btn-sm btn-block' href="{{route('cart.index')}}">
            CART <i class="fa fa-arrow-right"></i>
        </a>
        <a class='btn btn-dark btn-sm btn-block' href="{{route('cart.checkout')}}">
            CHECKOUT <i class="fa fa-arrow-right"></i>
        </a>
    </div>
@else
    <li class="list-group-item">Your Cart is Empty</li>
@endif
@else 
    <li class="list-group-item">Login to add items to Cart</li>
@endif    
