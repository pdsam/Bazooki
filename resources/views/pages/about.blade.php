@extends('layouts.app')

@section('title', 'Bazooki - About')

@section('head')
    <link rel="stylesheet" href={{ asset('css/about.css') }}>
@endsection

@section('content')
<div class="jumbotron section-jumbotron">
    <h1 class="display-4">About <i class="fas fa-info-circle"></i></h1>
    <hr class="my-2">
    <p class="lead">“It's not who you are underneath, it's what you do that defines you.”</p>
    <p>- Batman Begins</p>
</div>
<div class="row">
    <div class="col-lg-8 col-sm-12">
        <div class="about-div">
            <h3>What is Bazooki?</h3>
            <p>Bazooki is an <strong>online marketplace for all types of weaponry</strong>: real or collectible, modern or antique, from swords to guns.</p>
            <p>In this platform users can start Auctions on items they own and bid on weapons they are interested in.</p>
        </div>
        <div class="about-div">
            <h3>Why did you start Bazooki?</h3>
            <p>Modern gun stores lack the ability to have a large catalog due to their market being highly regionalized - e.g a gun store closer to a hunting zone has shotguns and rifles (used for hunting), while a city gun store mainly has handguns (used for self-defense).</p>
            <p>Before us there was no easy way to choose between a varied catalog of guns in a secure way!</p>
            <p>Additionally, as a weapons enthusiast, access to this kind of weaponry was scarce and limited. To collect this items, you either needed good connections or good luck in finding someone willing to sell.</p>
            <p>We came to address those problems and stop the process of acquisition from being frustrating and time-consuming.</p>
        </div>
        <div class="about-div">
            <h3>Why the name Bazooki?</h3>
            <p>Instead of thinking about all the deep and philosophical explanations about it, let's just agree that it is <strong>super cute</strong>!</p>
        </div>
    </div>
    <div class="col-lg-4 col-sm-12">
        <div class="card-columns">
            <div class="card">
                <img src={{ asset('assets/panda_transparency.png')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/gun.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/zoro.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/guts.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/sword.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/equipment.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/turret.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/gun2.jpg')}} class="card-img-top">
            </div>
            <div class="card">
                <img src={{ asset('assets/weapons/gun3.jpg')}} class="card-img-top">
            </div>
        </div>
    </div>
</div>
@endsection
