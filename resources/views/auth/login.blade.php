@extends('layouts.main') <!-- يفترض أن لديك layout رئيسية -->

@section('content')
<div class="account-login section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                <form class="card login-form" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="card-body">
                        <div class="title">
                            <h3>Login Now</h3>
                            <p>You can login using your social media account or email address.</p>
                        </div>

                        {{-- Social login buttons --}}
                       

                        

                        {{-- Email & Password --}}
                        <div class="form-group input-group">
                            <label for="email">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" id="email" name="email" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group input-group">
                            <label for="password">Password</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" id="password" name="password" required>
                            @error('password')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="d-flex flex-wrap justify-content-between bottom-content">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input width-auto" id="remember" name="remember">
                                <label class="form-check-label">Remember me</label>
                            </div>
                            <a class="lost-pass" href="">Forgot password?</a>
                        </div>

                        <div class="button">
                            <button class="btn" type="submit">Login</button>
                        </div>
                        <p class="outer-link">Don't have an account? <a href="{{route('register.form')}}">Register here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
