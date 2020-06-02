@extends('layouts.app')

@section('title', 'Review an auctioneer')

@section('head')
@endsection

@section('content')
    <h1>Post review on <a style="color: var(--purple)" href="{{ route('profile', $auctioneer->id) }}">{{ $auctioneer->name }}</a></h1>

    <form class="mb-5" action="/transaction/{{ $transaction_id }}/reviewauctioneer" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">Rating (1/10)</label>
            <input class="form-control" type="number" name="rating" id="rating" min="1" max="10" required="required">
        </div>
        <div class="form-group">
            <label for="opinion">Write something about this bazooker</label>
            <textarea class="form-control" name="opinion" id="opinion" cols="80" rows="15"></textarea>
        </div>

        <input class="btn btn-olive" type="submit" value="Post">
    </form>
@endsection