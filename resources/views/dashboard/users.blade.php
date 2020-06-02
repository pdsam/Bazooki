@extends('layouts.dashboard_page')

@section('active-certifications', 1)

@section('tab-content')
    <h2>Users</h2>
    @foreach ($bazookers as $bazooker)
        @include('partials.dashboard.bazookerCard',['bazooker'=> $bazooker])
    @endforeach

@endsection