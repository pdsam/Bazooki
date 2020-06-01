@extends('layouts.app')

@section('title', 'Bazooker - My Activity')

@section('head')
@endsection

@section('content')
    <h1>Activity</h1>
    <div class="d-flex flex-column">
        <a class="ml-3 mb-3" href="{{ url()->route('myauctions') }}">
            <div class="btn btn-olive">
                My auctions
            </div>
        </a>
        <a class="ml-3 mb-3" href="{{ url()->route('mybids') }}">
            <div class="btn btn-olive">
                My bids
            </div>
        </a>
    </div>
@endsection
