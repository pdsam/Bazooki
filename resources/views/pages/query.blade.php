@extends('layouts.app')

@section('title', 'Search for auctions')

@section('head')
    <link rel="stylesheet" href="{{ asset('/css/query.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
@endsection

@section('searchContent', isset($filters['s']) ? $filters['s'] : '')

@section('content')
    <div class="d-flex justify-content-end align-items-baseline mb-2 p-1 m-2 m-sm-0" style="margin-left:-15px; margin-right:-15px;">
        <label class="mr-1" for="sortByInput">Sort by:</label>
        <select class="w-auto custom-select rounded-0" id="sortByInput">
            <option value="bidDesc" @if(isset($filters['o']) && strcmp($filters['o'], 'bidDesc') == 0) selected="selected" @endif>Highest Bid (descending)</option>
            <option value="bidAsc" @if(!isset($filters['o']) || strcmp($filters['o'], 'bidAsc') == 0) selected="selected" @endif>Highest Bid (ascending)</option>
            <option value="dateEarl" @if(isset($filters['o']) && strcmp($filters['o'], 'dateEarl') == 0) selected="selected" @endif>End date (Earliest)</option>
            <option value="dateLate" @if(isset($filters['o']) && strcmp($filters['o'], 'dateLate') == 0) selected="selected" @endif>End date (Latest)</option>
        </select>
    </div>
    <div class="row m-2 m-sm-0">
        <!-- FILTERS -->
        <div class="col-12 col-lg-3 p-2 p-md-4 bg-white shadow-sm rounded-0 mb-auto">
            <a id="filters-toggle" class="d-block d-lg-none pb-1 border-bottom" href="#filters" data-toggle="collapse" data-target="#filters">
                <div class="d-flex justify-content-between align-items-center">
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
                    <div id="categoriesGroup" class="collapse show">
                        <select id="categoriesSelection" class="w-100" name="c[]" multiple="multiple">
                            @foreach(\App\Category::all() as $category)
                                <option value="{{ $category->id }}" @if(isset($filters['c']) && in_array($category->id, $filters['c'])) selected="selected" @endif>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

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
                    @include('partials.query.auction', ['auction'=>$auction, 'first' => $loop->first])
                @endforeach
                <div class="mt-3 d-flex justify-content-center">
                    @php
                        $first_page = $current_page - 3;
                        $first_page = $first_page < 0 ? 0 : $first_page;
                        $last_page = $current_page + 3;
                        $last_page = $last_page < $num_pages ? $last_page : $num_pages;
                            @endphp

                    @if ($current_page > 0)
                        <div class="page-btn m-1 mr-4 p-2 btn btn-olive rounded-0" data-content="{{ $current_page-1 }}">
                            <i class="p-0 fa fa-chevron-left"></i>
                        </div>
                    @endif
                    @for($i = $first_page; $i < $last_page; $i++)
                        <div class="page-btn m-1 p-2 btn btn-olive rounded-0" @if ($i == $current_page) style="background-color: var(--olive-darker); font-weight: bolder" @endif data-content="{{ $i }}">
                            {{ $i+1 }}
                        </div>
                    @endfor
                    @if ($current_page < $num_pages-1)
                        <div class="page-btn m-1 ml-4 p-2 btn btn-olive rounded-0" data-content="{{ $current_page+1 }}">
                            <i class="p-0 fa fa-chevron-right"></i>
                        </div>
                    @endif
                    @if($auctions->isEmpty())
                        <p>No Auctions were found</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
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

        $('#categoriesSelection').select2({
            theme: "classic",
            closeOnSelect: false,
            placeholder: "Categories",
        });
    </script>
@endsection
