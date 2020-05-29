@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href="{{ asset('/css/query.css') }}">
@endsection

@section('searchContent', isset($filters['s']) ? $filters['s'] : '')

@section('content')
    <div class="d-flex justify-content-end align-items-baseline mb-2 p-1" style="margin-left:-15px; margin-right:-15px;">
        <label class="mr-1" for="sortByInput">Sort by:</label>
        <select class="w-auto custom-select rounded-0" id="sortByInput">
            <option value="bidDesc" @if(isset($filters['o']) && strcmp($filters['o'], 'bidDesc') == 0) selected="selected" @endif>Highest Bid (descending)</option>
            <option value="bidAsc" @if(!isset($filters['o']) || strcmp($filters['o'], 'bidAsc') == 0) selected="selected" @endif>Highest Bid (ascending)</option>
            <option value="dateEarl" @if(isset($filters['o']) && strcmp($filters['o'], 'dateEarl') == 0) selected="selected" @endif>End date (Earliest)</option>
            <option value="dateLate" @if(isset($filters['o']) && strcmp($filters['o'], 'dateLate') == 0) selected="selected" @endif>End date (Latest)</option>
        </select>
    </div>
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
                    <input type="hidden" name="s" value="@if (isset($filters['s'])){{ $filters['s'] }} @endif">
                    <input type="hidden" id="sortOrder" name="o" value="@if (isset($filters['o'])){{ $filters['o'] }} @endif">
                    <a class="d-block mt-2 section-toggle mb-2 mt-3" href="#categoriesGroup" data-toggle="collapse" data-target="#categoriesGroup">
                        <div class="d-flex justify-content-between align-items-center">
                            <p class="m-0">Category</p>
                            <i class="fa fa-chevron-up"></i>
                        </div>
                    </a>
                    @foreach(\App\Category::all() as $category)
                        <div id="categoriesGroup" class="collapse show">
                            <div class="custom-control custom-checkbox">
                                <input class="custom-control-input m-0" type="checkbox" name="c[]"
                                       id="cat{{ $category->id }}" value="{{ $category->id }}" @if(isset($filters['c']) && in_array($category->id, $filters['c'])) checked="checked" @endif>
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
                        <input class="control-form col-auto" type="number" name="m" id="maxBid" min="0"
                               value="@if ( isset($filters['m']) ){{ $filters['m'] }}@endif">
                    </div>

                    <button class="btn btn-primary mt-2 btn-olive" type="submit">Apply filters</button>
                </form>
            </div>
        </div>


        <!-- CONTENT DISPLAY -->
        <div class="col-12 col-lg-9 mt-2 mt-md-0 p-0">
            <div class="ml-md-1">
                @foreach ($auctions as $auction)
                    <div class="card shadow-sm rounded-0 border-0 @if (!$loop->last) mb-1 @endif mt-5 mt-md-0">
                        <div class="row align-items-center no-gutters">
                            <div class="col-xs-12 col-sm-4">
                                <img src="{{ asset('assets/gun.jpg') }}" class="card-img rounded-0" alt="logo">
                            </div>
                            <div class="col-xs-12 col-sm-8">
                                <div class="card-body">
                                    <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                                        <div class="">
                                            <h5 class="card-title">{{ $auction->item_name }}</h5>
                                            @php
                                                $duration = $auction->duration;
                                                $start_time =
                                                    DateTime::createFromFormat('Y-m-d H:i:s', $auction->start_time)
                                                    ->modify("+$duration seconds")->format('d M Y H:i:s');
                                            @endphp
                                            <h6 class="card-subtitle text-muted">Ends: {{ $start_time }}</h6>
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
                <div class="mt-3 d-flex justify-content-center">
                    @php
                        $first_page = $current_page - 3;
                        $first_page = $first_page < 0 ? 0 : $first_page;
                        $last_page = $current_page + 3;
                        $last_page = $last_page < $num_pages ? $last_page : $num_pages;
                            @endphp
                    @for($i = $first_page; $i < $last_page; $i++)
                        <div class="page-btn m-1 p-2 btn btn-olive rounded-0" data-content="{{ $i }}">
                            {{ $i }}
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        <div>
            <script>
                $('#sortByInput').change(function(e) {
                    $('#sortOrder').val(this.value);
                    $('#filtersForm').submit();
                });

                $('.page-btn').on('click', function(e) {
                    $("<input type='hidden'/>")
                        .attr("name", "p")
                        .attr("value", this.getAttribute('data-content'))
                        .prependTo("#filtersForm");
                    $('#filtersForm').submit();
                });
            </script>
@endsection
