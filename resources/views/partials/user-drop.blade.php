<div class="dropdown-menu" aria-labelledby="navbarDropdown">
    {{-- Details --}}
    <a class="dropdown-item" href="{{ route('user-details') }}">{{ __('Details') }}</a><hr>
    {{-- Orders --}}
    <a class="dropdown-item" href="{{ route('user-orders') }}">{{ __('Orders') }}</a><hr>
    {{-- logout --}}
    <a class="dropdown-item" href="{{ route('logout') }}"
    onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
        </form>
</div>