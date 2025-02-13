<nav class="navbar navbar-expand-lg navbar-light fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Online <span class="logo">Logistic System</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('home.page') ? 'active' : '' }}" href="{{ route('home.page') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('rate.calculator') ? 'active' : '' }}" href="{{ route('rate.calculator') }}">Rate Calculator</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('track.Shipment') || Route::is('track.shipments') ? 'active' : '' }}" href="{{ route('track.shipments') }}">Track Shipments</a>
                </li>
                @if (Auth::check())
                    @if (Auth::user()->role == 'user')
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('freightBooking') ? 'active' : '' }}" href="{{ route('freightBooking') }}">Book Freight</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ Route::is('payments') ? 'active' : '' }}" href="{{ route('payments') }}">Payments</a>
                        </li>
                    @endif
                @endif
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('contact.us') ? 'active' : '' }}" href="{{ route('contact.us') }}">Contact us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Route::is('about.us') ? 'active' : '' }}" href="{{ route('about.us') }}">About us</a>
                </li>
                @if (Auth::check())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}" id="sign-in-btn">Logout</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link {{ Route::is('auth', ['action' => 'login']) ? 'active' : '' }}" href="{{ route('auth', ['action' => 'login']) }}" id="sign-in-btn">Sign in</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
