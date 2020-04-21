@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href={{ asset('css/profile.css') }}>
@endsection

@section('content')
    <div class="row">
        <div id="profile_pic" class="col-sm-4 d-flex text-center align-items-center justify-content-center">
            <img class="rounded-circle" src="https://picsum.photos/300/300">
        </div>
        <div id="profile_description" class="col-sm-8 text-left">
            <div class="jumbotron m-0 p-4">
                <div class="d-flex justify-content-between">
                    <h1 class="display-4">{{ $user->name }}</h1>
                    <div class="align-self-center">
                        <button class="btn btn-lg btn-olive">Edit</button>
                    </div>
                </div>
                <div id="profile_stats" class="row">
                    <div class="col-sm-4">
                        <p>8 Users</p>
                    </div>
                    <div class="col-sm-4">
                        <p>8 Users</p>
                    </div>
                    <div class="col-sm-4">
                        <p>8 Users</p>
                    </div>
                </div>

                <p class="lead">{{ $user->description }}</p>
            </div>
        </div>

    </div>

    <hr class="customhr">
    <ul id="profile_tabs_select" class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Current Bids</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">Won Auctions</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">My Auctions</a>
        </li>
    </ul>

    <!-- Tab panes -->
    <div id="profile_tabs" class="tab-content">
        <div class="tab-pane active" id="tabs-1" role="tabpanel">
            <div class="card-deck">
                @for ($i = 1; $i < 6; $i++)
                    @include('partials.profile.bidcard', [
                        'title' => "Super cool gun $i",
                        'description' => "This gun is very strong. It is also very pretty.",
                        'owner' => "Chuck Norris",
                        'currentbid' => "2000"
                    ])
                @endfor
            </div>
        </div>
        <div class="tab-pane" id="tabs-2" role="tabpanel">
            <div class="card-deck">
                @for ($i = 6; $i < 11; $i++)
                    @include('partials.profile.winningcard', [
                        'title' => "Super cool gun $i",
                        'description' => "This gun is very strong. It is also very pretty.",
                        'owner' => "Chuck Norris",
                        'currentbid' => "2000"
                    ])
                @endfor
            </div>
        </div>
        <div class="tab-pane" id="tabs-3" role="tabpanel">
            <div class="card-deck">
                @for ($i = 11; $i < 16; $i++)
                    @include('partials.profile.owncard', [
                        'title' => "Super cool gun $i",
                        'description' => "This gun is very strong. It is also very pretty.",
                        'owner' => "Chuck Norris",
                        'currentbid' => "2000"
                    ])
                @endfor
            </div>
        </div>
    </div>
@endsection
