<nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
    <a class='navbar-brand' href="{{url('/')}}"><i class="fa fa-home fa-2x "></i></a>
        <button class="navbar-toggler" type="button" data-toggle='collapse' data-target='#navbarSupportedContent' aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{__('Toggle navigation')}}">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Categories-drop --}}
        <div class="collapse navbar-collapse d-flex justify-content-around" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item mx-2">
                    @include('partials.categories-drop')
                </li>
            </ul>
        {{-- Create Product --}}
        <ul class="navbar-nav ">
            <li class="nav-item mr-2">
                    @if (Auth::check() && Auth::user()->is_admin==1)
                        <a class="btn btn-secondary" href="{{route('admin.createpage')}}" type="button" aria-haspopup="true" aria-expanded="false">
                        CREATE PRODUCT</a>
                    @endif
            </li>
        </ul>

        {{-- Pre Login --}}
        @guest
        <ul class="navbar-nav ">
        <li class="nav-item mr-2">
            <form method="post" action="{{ route('login') }}">
        @csrf
        <div class="form-row">
        <div class=" my-1 mx-1">
        <label for="email" class="sr-only col-form-label text-md-right"></label>
        <input id="email" type="email" class="form-control form-control-sm @error('email') is-invalid @enderror " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="email address">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        </li>
        <li class="nav-item mr-2">
        <div class="my-1 mx-1">
        <label for="password" class="sr-only col-form-label text-md-right"></label>
        <input id="password" type="password" class="form-control form-control-sm @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </li>
    </ul>
        
        {{-- login --}}
        <ul class="navbar-nav ">
        <li class="nav-item mr-2">
            <button type="submit" class="btn btn-primary login">{{ __('Login')}}</button>
        </li>
        </form>
        </ul>
        {{-- register --}}
        <ul class="navbar-nav ">
        <li class="nav-item mr-2">
            <form action="{{route('register')}}" method="get">
            <button type="submit" class="btn btn-primary register">{{ __('Register') }}</button>
            </form>
        </li>
        </ul>
        @endguest

        {{-- Post Login --}}
        @if (Auth::check())
        <ul class="navbar-nav">
            <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <h4 class="d-inline text-white"> {{ Auth::user()->name }}</h4>
            </a>
            <div class="dropdown nav-item" style="width: 1px;">
                @include('partials.user-drop')
            </div>
        </li>
        </ul>
        @endif

        {{-- Search Bar --}}
        <ul class="navbar-nav">
        <li class="nav-item">
        <form action="{{route('search')}}" method="get" role="search">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" name="search" placeholder="Search products..." required> 
                    <button type="submit" class="btn">
                        <i class="fas fa-search" style="color: white"></i>
                    </button>
            </div>
        </form>
        </li>
        </ul>

            {{-- Shopping Cart --}}
        <ul class="navbar-nav">
            <li class='nav-item dropdown'>
                <a id='navbarDropdown' class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="badge badge-pill badge-dark">
                        @if (Auth::check())
                        <i class='fa fa-shopping-cart fa-2x'>({{\Cart::session(Auth::user()->id)->getTotalQuantity()}})</i>
                        @else
                        <i class='fa fa-shopping-cart fa-2x'>({{\Cart::getTotalQuantity()}})</i>
                        @endif
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 380px; padding: 0px; border-color: #9DA0A2">

                    <ul class="list-group" style="margin: 20px">
                        {{-- cart-drop --}}
                        @include('partials.cart-drop')
                    </ul>
                </div>
            </li>
            <ul>
        </div>
    </div>
</nav>

