@extends('layouts.app')

@section('title', $user->name. '\'s profile')

@section('head')
    <link rel="stylesheet" href={{ asset('css/profile.css') }}>
@endsection

@section('content')
    <h1>Profile</h1>
    <div class="row">
        <div id="profile_pic" class="col-12 col-md-4 d-flex text-center align-items-center justify-content-center">
            <img class="rounded-circle" alt="profile picture" style="max-width: 200px" src={{ asset($user->photo()) }}>
        </div>
        <div id="profile_description" class="col-12 col-md-8 mt-3 mt-md-0 text-left">
            <div class="d-flex justify-content-between">
                <h1 class="display-4">{{ $user->name }}</h1>
                @if (Auth::guard('bazooker')->check())
                    @if (Auth::user()->id == $user->id)
                        <div class="align-self-center">
                            <button class="btn btn-olive" data-toggle="modal" data-target="#edit-form">Edit</button>
                        </div>
                    @endif
                @endif
            </div>
            <p class="lead">{{ $user->description }}</p>
        </div>

        @if (Auth::guard('bazooker')->check())
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
                                    <div>
                                        <div class="form-group mb-4">
                                            <label class="mb-2" for="profilePic"><span class="font-weight-bold">Profile picture</span> (less 2MB, jpg, png, dif...):</label>
                                            <input type="file" name="profilePic" id="profilePic">
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Name:</label>
                                            <input class="form-control" type="text" id="name" name="name" placeholder="Name" value="{{ $user->name }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" id="description" name="description" cols="30" rows="10">{{ $user->description }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer justify-content-start">
                                    <input class="btn btn-olive mr-3" type="submit" value="Done">
                                    <button class="btn btn-purple" type="button" data-toggle="modal" data-target="#edit-form">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            @endif
        @endif
    </div>

    <hr class="customhr">

    <div>
        <h2 class="mb-5">Bazooker Ratings</h2>
        <div class="row">
            <div class="col-12 col-md-6">
                @php $avg = $user->winnerFeedbackAVG(); @endphp
                <h2>As a bidder</h2>
                <p><span style="font-size: 2rem">{{ is_null($avg) ? 0 : $avg }}</span><span style="font-size: 1.5rem">/10</span></p>
                <p>Out of {{ $user->winnerFBCount() }} reviews.</p>
            </div>
            <div class="col-12 col-md-6">
                @php $avg = $user->auctioneerFeedbackAVG(); @endphp
                <h2>As an auctioneer</h2>
                <p><span style="font-size: 2rem">{{ is_null($avg) ? 0 : $avg }}</span><span style="font-size: 1.5rem">/10</span></p>
                <p>Out of {{ $user->auctioneerFBCount() }} reviews.</p>
            </div>
        </div>
    </div>
@endsection
