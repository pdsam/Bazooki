@extends('layouts.app')

@section('title', 'Bazooki - Login')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">       
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-5 col-sm-12">
            <div id="login-container" class="d-flex align-items-center py-1" class="text-center">
                <form method="POST" class="w-100 p-3 m-auto text-center">
                    @csrf
                    <img class="mb-4 mx-auto" src="{{ asset('../assets/panda_transparency.png') }}" alt="" width="150" height="150">
                    <h1 class="h3 mb-3 font-weight-normal">Welcome back Bazooker!</h1>

                    <div class="form-group">
                        <input type="text" class="form-control h-auto p-2" id="loginUsername" aria-describedby="userHelp" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control h-auto p-2" id="loginPassword" placeholder="Password" name="password" required>
                    </div>

                    <div class="font-weight-bold">
                        <label>
                            <input type="checkbox" value="remember-me"> Keep me logged in 
                        </label>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block mb-4 rounded-pill font-weight-bold p-3" type="submit">SIGN IN</button>
                    <button class="btn btn-lg btn-google btn-block text-uppercase rounded-pill font-weight-bold p-3" type="submit"><i class="fab fa-google mr-2"></i> Sign in with Google</button>

                    <div id="forgot-password" class="my-4">
                        <a href="#recover-password">Forgot your password?</a>
                    </div>

                    <div id="register-prompt" class="text-left">
                        <p>Want to become a bazooker? <a href="/register">Register here!</a></p>
                    </div>
                </form>
            </div>
        </div>
        <div id="login-img-container" class="col-lg-7 col-sm-12 text-center">
            <img class="mw-100 shadow-lg" src="../assets/login_img.jpg">
            <div class="p-1 mt-3 border-top">
                <p class="lead">“The whole point of collecting is the thrill of acquisition, which must be maximized, and maintained at all costs.”</p>
                <p>- John Baxter, A Pound of Paper: Confessions of a Book Addict</p>
            </div>
        </div>
    </div>
@endsection
