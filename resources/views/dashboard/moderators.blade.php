@extends('layouts.dashboard_page')

@section('active-moderators', 1)

@section('tab-content')
    <h2>Manage moderators</h2>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="mb-3">
        <h4>Add moderator</h4>
        <div class="shadow-sm border mt-3 mt-lg-1 add-moderator-card">
            <div class="card rounded-0 border-0">
                <form action="/mod/moderators" method="POST">
                    @csrf
                    <div class="row align-items-center no-gutters">
                        <div class="col-lg-5 col-sm-6">
                            <div class="card-body">
                                <label for="staticEmail2" class="card-subtitle sr-only">Email</label>
                                <input name="email" type="email" class="form-control" id="staticEmail2" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <div class="card-body">
                                <label for="inputPassword2" class="card-subtitle sr-only">Password</label>
                                <input name="password" type="password" class="form-control" id="inputPassword2" placeholder="Password" required>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 moderator-delete">
                            <div class="card-body">
                                <button class="btn btn-success">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h4 id="moderator-list">Moderator list</h4>

        @if(count($moderators) == 0)
            <p class="mt-3">There are no moderators \_(ツ)_/¯</p>
        @endif

        @foreach ($moderators as $moderator)
            <div class="shadow-sm border mt-3 mt-lg-1 moderator-card" id="moderator{{$moderator->id}}">
                <div class="card rounded-0 border-0">
                    <div class="row align-items-center no-gutters">
                        <div class="col-lg-5 col-sm-6">
                            <div class="card-body">
                                <h6 class="card-subtitle text-muted">Email</h6>
                                <h5 class="card-title">{{$moderator->email}}</h5>
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <div class="card-body">
                                <h6 class="card-subtitle text-muted">Password</h6>
                                <h5 class="card-title">{{$moderator->password}}</h5>
                            </div>
                        </div>
                        <div class="col-lg-2 col-sm-12 moderator-delete">
                            <div class="card-body">
                                <button class="btn btn-danger" onclick="deleteModerator({{ $moderator->id }})">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
    <script src="{{ asset('js/dashboard_moderators.js') }}" defer></script>
@endsection