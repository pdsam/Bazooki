@extends('layouts.app')

@section('title', 'Bazooki - Contact Us')

@section('head')
    <link rel="stylesheet" href={{ asset('css/contact_us.css') }}>
@endsection

@section('content')
<div class="jumbotron section-jumbotron">
    <h1 class="display-4">Contact Us <i class="fas fa-envelope"></i></h1>
    <hr class="my-2">
    <p class="lead">“One good conversation can shift the direction of change forever.”</p>
    <p>- Linda Lambert</p>
</div>
<div class="row">
    <div class="col-lg-6 col-sm-12">
        <img src={{ asset('/assets/panda_hello.png') }}>
    </div>
    <div class="col-lg-6 col-sm-12">
        <div class="contact-div">
            <h3>Contact</h3>
            <p>Email us at: <strong>hello@bazooki.com</strong></p>
            <p>Call us through: <strong>+351 912345678</strong></p>
            <h3>Address</h3>
            <p>Melton Meadow Road</p>
            <p>Porto, Portugal</p>
        </div>
    </div>
</div>
@endsection
