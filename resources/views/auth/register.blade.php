@extends('layouts.app')

@section('title', 'Bazzoki - Register')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">       
@endsection

@section('content')
    <div class="row">
        <div id="login-img-container" class="col-lg-7 col-sm-12 text-center order-last order-lg-first">
            <img class="img-fluid shadow-lg" src="{{ asset('../assets/budda_cropped.jpg') }}">
            <div class="p-1 mt-3 border-top">
                <p class="lead">“There are two mistakes one can make along the road to truth… not going all the way, and not starting.”</p>
                <p>- Buddha</p>
            </div>
        </div>
        <div class="col-lg-5 col-sm-12">
            <div id="register-container" class="text-center w-100 d-flex align-items-center py-2">
                <form class="form-signin w-100 p-3 m-auto" method="POST">
                    @csrf
                    <img class="mb-4" src="{{ asset('assets/panda_transparency.png') }}" alt="" width="150" height="150">
                    <h1 class="h3 mb-3 font-weight-normal">Bazooker Sign Up</h1>

                    <div class="form-group">
                        <input type="text" class="form-control h-auto p-2" id="registerName" aria-describedby="userHelp" placeholder="Name" name="name" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control h-auto p-2" id="registerUsername" aria-describedby="userHelp" placeholder="Username" name="username" required>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="registerEmail" aria-describedby="emailHelp" placeholder="Email" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control h-auto p-2" id="registerPassword" placeholder="Password" name="password" required>
                    </div>

                    <div class="checkbox font-weight-bold text-left my-1">
                        <label>
                            <input class="p-2" type="checkbox" value="terms-and-conditions" required> I accept the Terms and Conditions 
                        </label>
                    </div>

                    <button class="btn btn-lg btn-primary btn-block mb-4 rounded-pill font-weight-bold p-3" type="submit">REGISTER</button>
                    <button class="btn btn-lg btn-google btn-block text-uppercase rounded-pill font-weight-bold p-3" type="submit"><i class="fab fa-google mr-2"></i> Register with Google</button>

                </form>
            </div>
        </div>
    </div>
</form>
@endsection
