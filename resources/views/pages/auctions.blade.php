@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href={{ asset('css/landing_page.css') }}>
@endsection

@section('content')
    <script type="text/javascript" defer>
        $(document).ready(function(){
            //Event for pushed the video
            $('.carousel').carousel({
                pause: true,
                interval: false
            });
        });
    </script>        

    <div id="landing-page">
        <div class="jumbotron section-jumbotron">
            <h1 class="display-4">Current Auctions <i class="fas fa-gavel"></i></h1>
            <hr class="my-2">
            <p class="lead">“Those who dare seek, shall find what they are seeking for.”</p>
            <p>- Lailah Gifty Akita, Think Great: Be Great!</p>
        </div>

@include('partials.auctions.carousel', [
    'title' => "<i class='fas fa-fire' style='color:red'></i> HOT DEALS <i class='fas fa-fire' style='color:red'></i>", 
    'id' => "hot-deals-carousel", 
    'items' => $hotdeals, 
    'cardsize' => "col-md-3"]
    )

    @include('partials.auctions.carousel', [
        'title' => "<i class='fas fa-bolt' style='color:#caa900'></i> FLASH SALES <i class='fas fa-bolt' style='color:#caa900'></i>", 
        'id' => "flash-carousel", 
        'items' => $flash, 
        'cardsize' => "col-md-3"]
    )

    @include('partials.auctions.carousel', [
        'title' => "<i class='fas fa-search' style='color:var(--highlight-purple)'></i> CATEGORIES <i class='fas fa-search' style='color:var(--highlight-purple)'></i>", 
        'id' => "main-carousel", 
        'items' => $main, 
        'cardsize' => "col-md-3"]
        )
    </div>
@endsection
