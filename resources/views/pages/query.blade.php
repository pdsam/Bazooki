@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('/css/query.css') }}">
@endsection

@section('content')
    <div class="row">
        <!-- FILTERS -->
        <div class="col-12 col-lg-3 p-2 p-md-4 bg-white shadow-sm rounded-0">
            <a id="filters-toggle" class="d-block d-lg-none pb-1 border-bottom" href="#filters" data-toggle="collapse" data-target="#filters">
                <div class="d-flex justify-content-between">
                    <p class="m-0">Filters</p>
                    <i class="fa fa-chevron-up"></i>
                </div>
            </a>
            <h3 class="d-none d-lg-block mb-4">
                Filters
            </h3>
            <div id="filters" class="collapse show">
                <form id="filtersForm">
                    <input type="hidden" name="auction_name" value="@if (isset($filters['auction_name'])){{ $filters['auction_name'] }} @endif">
                    <a class="d-block mt-2 section-toggle mb-2 mt-3" href="#categoriesGroup" data-toggle="collapse" data-target="#categoriesGroup">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0">Category</p>
                            <i class="fa fa-chevron-up"></i>
                        </div>
                    </a>
                    @foreach(\App\Category::all() as $category)
                        <div id="categoriesGroup" class="collapse show">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input m-0" type="checkbox" name="categories[]" id="cat{{ $category->id }}" value="{{ $category->id }}" @if(isset($filters['categories'][$category->id])) checked="checked" @endif>
                                <label class="custom-control-label" for="cat{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                        </div>
                    @endforeach

                    <a class="d-block mt-2 section-toggle mb-2 mt-3" href="#maxBidPriceGroup" data-toggle="collapse" data-target="#maxBidPriceGroup">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0">Max Bid Price</p>
                            <i class="fa fa-chevron-up"></i>
                        </div>
                    </a>
                    <div id="maxBidPriceGroup" class="collapse show form-row">
                        <input class="control-form col-auto" type="number" name="max_bid" id="maxBid" min="0"
                               value="@if(isset($filters['max_bid'])) {{ $filters['max_bid'] }} @endif">
                    </div>

                    <button class="btn btn-primary mt-2 btn-olive" type="submit">Apply filters</button>
                </form>
            </div>
        </div>


        <!-- CONTENT DISPLAY -->
        <div class="col-12 col-lg-9 mt-2 mt-md-0 p-0">
            <div class="ml-md-1">
                @foreach ($auctions as $auction)
                    <div class="card shadow-sm rounded-0 border-0 mb-1 mt-5 mt-md-0">
                        <div class="row align-items-center no-gutters">
                            <div class="col-xs-12 col-sm-4">
                                <img src="{{ asset('assets/gun.jpg') }}" class="card-img rounded-0" alt="logo">
                            </div>
                            <div class="col-xs-12 col-sm-8">
                                <div class="card-body">
                                    <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                                        <div class="">
                                            <h5 class="card-title">{{ $auction->item_name }}</h5>
                                            <h6 class="card-subtitle text-muted">Ends at: 05/07/2020 23:59:59</h6>
                                        </div>
                                        <div>
                                            <span class="mr-1" style="font-size: 2rem">{{ $auction->maxBid() }}</span>$
                                        </div>
                                    </div>
                                    <p class="card-text">{{ $auction->item_short_description }}</p>
                                </div>
                            </div>
                            <a href="/auctions/{{ $auction->id }}" class="stretched-link"></a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div>
@endsection
