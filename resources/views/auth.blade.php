@extends('userLayout')
@section('content')
    <div class="user-signup-container">
        <div class="user-signup">
            <div class="heading">
            <h1>{{ $action === 'login' ? 'Login' : 'Sign Up' }}</h1>

            @if ($errors->any())
                <div class="alert alert-success">
                    <ul style="list-style:none;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('auth', ['action' => $action]) }}" method="POST">
                @csrf
                @if ($action === 'signup')
                    <div class="txt_field">
                        <input type="text" name="name" required>
                        <span></span>
                        <label>Name</label>
                    </div>
                    <div class="txt_field">
                        <input type="text" name="address">
                        <span></span>
                        <label>Address</label>
                    </div>
                @endif
                <div class="txt_field">
                    <input type="text" name="email" required>
                    <span></span>
                    <label>Email</label>
                </div>
                <div class="txt_field">
                    <input type="password" name="password" required>
                    <span></span>
                    <label>Password</label>
                </div>
                @if ($action === 'signup')
                    <div class="txt_field">
                        <input type="password" name="password_confirmation" required>
                        <span></span>
                        <label>Confirm Password</label>
                    </div>
                @endif

                <input class="signup-btn"  type="submit" value="{{ $action === 'login' ? 'Login' : 'Sign Up' }}">

                <div class="signup_link-1">
                    @if ($action === 'login')
                    Not a member?  <a href="{{ route('auth', ['action' => 'signup']) }}">Sign Up</a>
                    @else
                    Already have an account? <a href="{{ route('auth', ['action' => 'login']) }}">Login Here</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
@endsection
