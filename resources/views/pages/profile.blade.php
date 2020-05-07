@extends('layouts.app')

@section('head')
    <link rel="stylesheet" href={{ asset('css/profile.css') }}>
@endsection

@section('content')
    <div class="row">
        <div id="profile_pic" class="col-sm-4 d-flex text-center align-items-center justify-content-center">
            <img class="rounded-circle" src={{ asset("storage/avatars/$user->id") }}>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
        <div id="profile_description" class="col-sm-8 text-left">
            <div class="jumbotron m-0 p-4 h-100">
                <div class="d-flex justify-content-between">
                    <h1 class="display-4">{{ $user->name }}</h1>
                    @if (Auth::user()->id == $user->id)
                        <div class="align-self-center">
                            <button class="btn btn-olive" data-toggle="modal" data-target="#edit-form">Edit</button>
                        </div>
                    @endif
                </div>
                <p class="lead">{{ $user->description }}</p>
            </div>
        </div>
        @if (Auth::user()->id == $user->id)
            <div id="edit-form" class="modal fade">
                <form class="w-100" method="POST" action="/profile/{{ $user->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="m-0">
                                    Edit Profile
                                </h5>
                            </div>
                            <div class="modal-body">
                                <div class="d-flex">
                                    <div>
                                        <div class="form-group">
                                            <input type="file" name="profilePic" id="profilePic">
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input class="form-control" type="text" name="name" placeholder="Name" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" id="dsription-in" name="description" cols="30" rows="10">{{ $user->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-start">
                                    <input class="btn btn-olive mr-3" type="submit" value="Done">
                                    <button class="btn btn-purple" data-toggle="modal" data-target="#edit-form">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        @endif
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
