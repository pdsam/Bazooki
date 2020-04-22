@extends('layouts.app')

@section('title', 'Bazooki - Not found')

@section('head')
    <link rel="stylesheet" href={{ asset('css/404.css') }}>
@endsection

@section('content')
    <div id="div-404">
        <h1>404 - Not found</h1>
        <img src={{ asset('/assets/panda_transparency.png') }}>
        <p class="lead">“Not all those who wander are lost.”</h1>
        <p>- J.R.R. Tolkien, The Fellowship of the Ring</p>
    </div>
@endsection
