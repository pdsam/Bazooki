@extends('layouts.app')

@section('head')
<link rel="stylesheet" href={{ asset('css/product.css') }}>
<script src="{{ asset('js/auction_page.js') }}" defer></script>
<script src="{{ asset('js/chart.js') }}" defer></script>
<script src="{{ asset('js/modal_form.js') }}" defer></script>
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

        @if (Auth::id() == $owner)
            <div id="editAuction" class="card mb-3">
                <a href="/auctions/{{$id}}/edit" class="btn btn-olive">Edit Auction</a>
            </div>
        @endif

        <div id="product_info" class="card">
            <div class="card-body">
                <div id="product_info_header" @if(!$certified) class="card-c-element" @endif>
                    <h3 class="card-title text-center card-body">{{ $name }}</h3>
                    @foreach($categories as $cat)
                        <span class="badge badge-primary bg-olive">{{ $cat->name }}</span>
                    @endforeach
                </div>
                <div class="card-c-element card-body">
                    <h3 class="card-title text-center" id="price">€{{ $base_bid }}</h3>
                    <h3 id="duration-place" class="card-title text-center"></h3>
                    <p hidden id="timer-start-time">{{ $start_time }}</p>
                    <p hidden id="timer-duration">{{ $duration }}</p>
                </div>
                <div class="card-body w-100 pb-0" id="bid-div">
                    <div class="justify-content-center align-self-center">
                        <form id="bid-form" class="row pb-0" action="POST">
                            @csrf
                            <input type="hidden" name="form-id" value="{{ $id }}">
                            <div class="col-lg-8 col-12 form-group pr-0 pl-0">
                                <input id="money" type="number" class="form-control text-center" name="amount" value="{{$base_bid +1}}"></input>
                            </div>
                            <div class="col-lg-4 col-12 form-group pr-0 pl-0">
                                @if(!Auth::check() || Auth::id() == $owner )
                                    <input type="submit" class="btn btn-purple w-100" id="bid-button" value="Bid Now" disabled></input>
                                @else
                                    <input type="submit" class="btn btn-purple w-100" id="bid-button" value="Bid Now"></input>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        @if($certified)
            <div id="certification" class="card mt-3">
                <div class="card-body">
                    <div class="certification-text">
                        <h4 class="text-center">
                        <img src="{{asset('/assets/small_panda.png')}}">Certified by Bazooki</h4>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<div class="card mb-4">
    <div class="card-body">
        <h3 class="card-title">Details </h3>
        <span class="card-text">Posted by: </span><a href="/profile/{{$owner}}"><span>@php echo $ownerName; @endphp</span></a>
        <h4>Description:</h4>
        <p class="card-text">{{ $description }}</p>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <h3 class="card-title">Price variation</h3>
        <canvas id="chart"  width="400" height="200"></canvas>
    </div>
</div>
<p id="aux-id" hidden>{{$id}}</p>

@endsection
