@extends('layouts.app')

@section('title', 'Review a bazooker')

@section('head')
@endsection

@section('content')
    <h1>Post review on <a style="color: var(--purple)" href="{{ route('profile', $winner->id) }}">{{ $winner->name }}</a></h1>

    <form class="mb-5" action="/transaction/{{ $transaction_id }}/reviewwinner" method="POST">
        @csrf
        <div class="form-group">
            <label for="rating">Rating (1/10)</label>
            <input class="form-control" type="number" name="rating" id="rating" value="{{ old('rating') }}" min="1" max="10" required="required">
        </div>
        <div class="form-group">
            <label for="opinion">Write something about this bazooker</label>
            <textarea class="form-control" name="opinion" id="opinion" cols="80" rows="15" required="required">{{ old('opinion') }}</textarea>
        </div>

        <input class="btn btn-olive" type="submit" value="Post">
    </form>
@endsection