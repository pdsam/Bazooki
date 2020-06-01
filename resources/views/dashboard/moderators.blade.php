@extends('layouts.dashboard_page')

@section('active-moderators', 1)

@section('tab-content')
    <h2>Manage moderators</h2>
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    @if(count($moderators) == 0)
        <p class="mt-3">There are no moderators \_(ツ)_/¯</p>
    @endif

    <div class="mb-3">
        <h4>Add moderator</h4>
        <div class="shadow-sm border mt-3 mt-lg-1 add-moderator-card">
            <div class="card rounded-0 border-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-lg-5 col-sm-6">
                        <div class="card-body">
                            <label for="staticEmail2" class="card-subtitle sr-only">Email</label>
                            <input type="email" class="form-control" id="staticEmail2" placeholder="Email">
                        </div>
                    </div>
                    <div class="col-lg-5 col-sm-6">
                        <div class="card-body">
                            <label for="inputPassword2" class="card-subtitle sr-only">Password</label>
                            <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
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
            </div>
        </div>
    </div>

    <div class="mb-3">
        <h4>Moderator list</h4>
        @foreach ($moderators as $moderator)
            <div class="shadow-sm border mt-3 mt-lg-1 moderator-card">
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
                                <button class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    
@endsection