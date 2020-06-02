@extends('layouts.app')

@section('title', 'Activity - My Auctions')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/query.css') }}">
@endsection

@section('content')
    <h1>Your auctions</h1>
    <div class="d-flex justify-content-end align-items-baseline mb-2 p-1 m-2 m-sm-0" style="margin-left:-15px; margin-right:-15px;">
        <form id="sortOrderForm" class="form-inline" action="/activity/myauctions" method="GET">
            <div class="form-group">
                <label class="mr-1" for="sortByInput">Sort by:</label>
                <select class="w-auto custom-select rounded-0" id="sortByInput" name="o">
                    <option value="dateEarl" @if(isset($sortOrder) && strcmp($sortOrder, 'dateEarl') == 0) selected="selected" @endif>End date (Earliest)</option>
                    <option value="dateLate" @if(!isset($sortOrder) || strcmp($sortOrder, 'dateLate') == 0) selected="selected" @endif>End date (Latest)</option>
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
        @foreach($auctions as $auction)
            <div class="card shadow-sm rounded-0 border-0 mb-2">
                <div class="row align-items-top no-gutters">
                    <div class="col-xs-12 col-sm-4">
                        <img src="{{ asset('assets/gun.jpg') }}" class="auction-img card-img rounded-0" alt="logo">
                    </div>
                    <div class="col-xs-12 col-sm-8">
                        <div class="card-body">
                            <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                                <div class="">
                                    <a href="{{ route('auction', $auction->id) }}">
                                        <h4 class="card-title">{{ $auction->item_name }}</h4>
                                    </a>
                                    @if ($auction->isOver())
                                        <h6 class="card-subtitle text-muted">Already over</h6>
                                    @else
                                        <h6 class="card-subtitle text-muted">Ends: {{ $auction->endDateTime()->format('d M Y H:i:s') }}</h6>
                                    @endif

                                    <div>
                                        @foreach($auction->categories as $cat)
                                            <span class="badge badge-light border mr-1 mt-2">{{ $cat->name }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                <div>
                                    <span class="mr-1 auction-price">{{ $auction->currentPrice() }}</span>$
                                </div>
                            </div>
                            <p class="mt-2 card-text auction-short-desc">{{ $auction->item_short_description }}</p>

                            @if ($auction->isOver())
                                <div>
                                    @if ($auction->highest_bidder !== null)
                                        Auction won by:
                                        <a href="{{ route('profile', $auction->highestBidder->id) }}">
                                            {{ $auction->highestBidder->name }}
                                        </a>
                                        :
                                        @if ($auction->transaction !== null)
                                            <a href="{{ route('reviewwinner', [$auction->transaction->id]) }}">
                                                Leave a review.
                                            </a>
                                        @else
                                            <p class="text-muted">Setting up transaction, you'll be able to post a review about this bazooker in a minute.</p>
                                        @endif
                                    @else
                                        This auction had no bids.
                                    @endif
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
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
