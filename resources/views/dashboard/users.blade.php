@extends('layouts.dashboard_page')

@section('active-users', 1)

@section('tab-content')
    <h2>Users</h2>
    @foreach ($bazookers as $bazooker)
        @include('partials.dashboard.bazookerCard',['bazooker'=> $bazooker])
    @endforeach

    <script src="{{ asset('js/collapse.js') }}" defer></script>
    <script src="{{ asset('js/dashboard_users.js') }}" defer></script>
@endsection