@extends('layouts.app')

@section('title', 'Activity - My Bids')

@section('head')
@endsection

@section('content')
    <h1>Your bids</h1>
    <div class="d-flex justify-content-end align-items-baseline mb-2 p-1 m-2 m-sm-0" style="margin-left:-15px; margin-right:-15px;">
        <form id="sortOrderForm" class="form-inline" action="/activity/mybids" method="GET">
            <div class="form-group">
                <label class="mr-1" for="sortByInput">Sort by:</label>
                <select class="w-auto custom-select rounded-0" id="sortByInput" name="o">
                    <option value="bidAsc" @if(isset($sortOrder) && strcmp($sortOrder, 'bidAsc') == 0) selected="selected" @endif>Highest Bid (Ascending)</option>
                    <option value="bidDesc" @if(isset($sortOrder) && strcmp($sortOrder, 'bidDesc') == 0) selected="selected" @endif>Highest Bid (Descending)</option>
                    <option value="dateEarl" @if(isset($sortOrder) && strcmp($sortOrder, 'dateEarl') == 0) selected="selected" @endif>Time of bid (Earliest)</option>
                    <option value="dateLate" @if(!isset($sortOrder) || strcmp($sortOrder, 'dateLate') == 0) selected="selected" @endif>Time of bid (Latest)</option>
                </select>
            </div>
            <div class="form-group ml-0 ml-lg-3">
                <label class="mr-1" for="filter">Filter: </label>
                <select class="w-auto custom-select rounded-0" id="filter" name="f">
                    <option value="both" @if(!isset($filter) || strcmp($filter, 'both') == 0) selected="selected" @endif>Live and finished auctions</option>
                    <option value="onlyLive" @if(isset($filter) && strcmp($filter, 'onlyLive') == 0) selected="selected" @endif>Only live auctions</option>
                    <option value="onlyOver" @if(isset($filter) && strcmp($filter, 'onlyOver') == 0) selected="selected" @endif>Only finished auctions</option>
                </select>
            </div>
        </form>
    </div>
    <div>
        @foreach($bids as $bid)
            <div class="row bg-white shadow-sm p-2 m-2">
                <h4 class="col-12">{{ $bid->amount }}$ - {{ $bid->time }}</h4>
                <a class="col-12" href="{{ url()->route('auction', [$bid->auction->id]) }}">
                    <h5>
                        {{ $bid->auction->item_name }}
                    </h5>
                </a>
                @if ($bid->auction->isOver())
                    <span class="col-6 text-danger" style="font-size: 0.8rem">Ended</span>
                @endif

                @if ($bid->bidder_id == $bid->auction->highest_bidder && $bid->amount == $bid->auction->current_price)
                    <p class="col-6 m-0" style="color: var(--olive)">Winning Bid</p>
                @endif
            </div>
        @endforeach
    </div>
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
    </div>
    <script>
        $('#sortByInput').change(function(e) {
            $('#sortOrderForm').submit();
        });
        $('#filter').change(function(e) {
            $('#sortOrderForm').submit();
        });
        $('.page-btn').on('click', function(e) {
            $("<input type='hidden'/>")
                .attr("name", "p")
                .attr("value", this.getAttribute('data-content'))
                .prependTo("#sortOrderForm");
            $('#sortOrderForm').submit();
        });
    </script>
@endsection
