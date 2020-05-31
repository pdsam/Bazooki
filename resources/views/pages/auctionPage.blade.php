@extends('layouts.app')

@section('head')
<link rel="stylesheet" href={{ asset('css/product.css') }}>
<script src="{{ asset('js/auction_page.js') }}" defer></script>
<script src="{{ asset('js/chart.js') }}" defer></script>
@endsection

@section('content')
<div class="row" id="product-details">
    <div class="col-lg-7">
        <div class="card">
            <div class="shadow-lg">
                <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @for ($i = 0; $i < count($photos); $i++)
                            <li data-target="carouselIndicators" data-slide-to="{{ $i }}"
                                @if($i == 0)
                                    class="active"
                                @endif
                            >
                        @endfor
                    </ol>

                    <div class="carousel-inner">
                        @for ($i = 0; $i < count($photos); $i++)
                            <div class="carousel-item {{$i == 0 ? 'active' : '' }}">
                                <img class="d-block w-100 image-responsive" src={{ asset($photos[$i]) }} alt="Slide {{ $i }}">
                            </div>
                        @endfor
                    </div>
                    <a class="carousel-control-prev" href="#carouselIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-body">
                <h3 class="card-title text-center card-c-element card-body">{{ $name }}</h3>
                <div class="card-c-element card-body">
                    <h3 class="card-title text-center" id="price">{{ $base_bid }}</h3>
                    <h3 id="duration-place" class="card-title text-center"></h3>
                    <p hidden id="timer-start-time">{{ $start_time }}</p>
                    <p hidden id="timer-duration">{{ $duration }}</p>
                </div>
                <div class="card-body w-100" id="bid-div">
                    <div class="row">
                        <form id="bid-form" class="form-inline" action="POST">
                            @csrf
                            <div class="form-group">
                                <input type="hidden" name="form-id" value="{{ $id }}">
                                <input id="money" type="number" class="form-control text-center col-12 col-md-8" name="amount" value="110"></input>
                                <div class="col-12 col-md-4 mt-2 mt-md-0 d-flex justify-content-center">
                                    <input type="submit" class="btn btn-purple w-100" id="bid-button" value="Bid Now"></input>

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title">Details </h3>
        <p class="card-text">{{ $description }}
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Price variation</h3>
        <!--<img src="../assets/chart.png" class="img-responsive" width="100%" />-->
        <canvas id="chart"  width="400" height="200"></canvas>
    </div>

</div>
<p id="aux-id" hidden>{{$id}}</p>

@endsection