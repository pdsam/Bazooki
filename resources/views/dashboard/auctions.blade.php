@extends('layouts.dashboard_page')

@section('active-auctions', 1)

@section('tab-content')
    <h2>Auctions</h2>
    @foreach ($auctions as $auction)
        @include('partials.dashboard.auctionCard',['auction'=> $auction])
    @endforeach

    <script src="{{ asset('js/collapse.js') }}" defer></script>
    <script src="{{ asset('js/modal_form.js') }}" defer></script>
@endsection