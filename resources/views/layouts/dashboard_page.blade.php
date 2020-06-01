@extends('layouts.app')

@section('title', 'Bazooki - Dashboard')

@section('head')
    <link rel="stylesheet" href={{ asset('css/dashboard.css') }}>
@endsection


@section('content')
@if (session('error'))
    <div class="alert alert-error">
        {{ session('error') }}
    </div>
@endif
<div class="row">
    <nav class="col-12 col-lg-3 bg-light sidebar">
        <ul class="nav flex-column" role="tablist">
            <li class="nav-item py-2">
                <a class="nav-link @hasSection('active-sales') active @endif" @if(!View::hasSection('active-sales')) href="/mod" @endif>
                    <i class="fa fa-money-bill-wave"></i>
                    Sales 
                    @hasSection('active-sales')
                        <span class="sr-only">(current)</span>
                    @endif
                </a>
            </li>
            <li class="nav-item py-2">
                <a class="nav-link @hasSection('active-auctions') active @endif" @if(!View::hasSection('active-auctions')) href="/mod/auctions" @endif>
                    <i class="fa fa-gavel"></i>
                    Auctions
                    @hasSection('active-auctions')
                        <span class="sr-only">(current)</span>
                    @endif
                </a>
            </li>
            <li class="nav-item py-2">
                <a class="nav-link @hasSection('active-certifications') active @endif" @if(!View::hasSection('active-certifications')) href="/mod/certifications" @endif>
                    <i class="fa fa-user-check"></i>
                    Certifications
                    @hasSection('active-certifications')
                        <span class="sr-only">(current)</span>
                    @endif
                </a>
            </li>
            <li class="nav-item py-2">
                <a class="nav-link @hasSection('active-users') active @endif" @if(!View::hasSection('active-users')) href="/mod/users" @endif>
                    <i class="fa fa-users"></i>
                    Users
                    @hasSection('active-users')
                        <span class="sr-only">(current)</span>
                    @endif
                </a>
            </li>
            <li class="nav-item py-2">
                <a class="nav-link @hasSection('active-moderators') active @endif" @if(!View::hasSection('active-moderators')) href="/mod/moderators" @endif>
                    <i class="fa fa-shield-alt"></i>
                    Moderators
                    @hasSection('active-moderators')
                        <span class="sr-only">(current)</span>
                    @endif
                </a>
            </li>
        </ul>
    </nav>

    <main class="col-12 col-lg-9">
        @yield('tab-content')       
    </main>
</div>
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/collapseChevron.js') }}"></script>
@endsection