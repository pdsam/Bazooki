@extends('layouts.app')

@section('title', 'Review an auctioneer')

@section('head')
@endsection

@section('content')
    <h1>Post review on {{ $winner->name }}</h1>

    <form class="mb-5" action="">
        <div class="form-group">
            <label for="rating">Rating (1/10)</label>
            <input class="form-control" type="number" name="rating" id="rating" min="1" max="10" required="required">
        </div>
        <div class="form-group">
            <label for="opinion">Write your explanation</label>
            <textarea class="form-control" name="opinion" id="opinion" cols="80" rows="15" required="required"></textarea>
        </div>

        <input class="btn btn-olive" type="submit" value="Post">
    </form>
@endsection