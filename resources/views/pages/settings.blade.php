@extends('layouts.app')

@section('title', 'Account settings - Bazooker')

@section('content')
    <div class="px-2">
        <div class="mb-5">
            <h2>Change Password</h2>
            @foreach ($errors->pass_change->all() as $message)
                <p class="text-danger">{{ $message }}</p>
            @endforeach
            <form method="POST" action="/account/settings/password">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="oldPass">Old password</label>
                    <input class="form-control w-auto" type="password" name="oldPass" id="oldPass">
                </div>

                <div class="form-group">
                    <label for="newPass">New password</label>
                    <input class="form-control w-auto" type="password" name="newPass" id="newPass">
                </div>

                <div class="form-group">
                    <label for="confirmPass">Confirm new password</label>
                    <input class="form-control w-auto" type="password" name="confirmPass" id="confirmPass">
                </div>
                <button class="btn btn-olive" type="submit">Update</button>
            </form>
        </div>
        <div class="mb-5">
            <div class="d-flex-column d-md-flex align-items-center mb-2 md-md-0">
                <h2>
                    Payment methods
                </h2>
                <a class="ml-0 ml-md-4" href="" data-toggle="modal" data-target="#add-method-form">
                    <i class="fa fa-plus p-0"></i>
                    Add
                </a>
                <div id="add-method-form" class="modal fade">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5>Add a New Payment Method</h5>
                            </div>
                            <div class="modal-body">
                                <form class="form" action="/account/settings/payment" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="cardNumber">Card Number:</label>
                                        <input class="form-control" type="text" name="cardNumber" id="cardNumber">
                                    </div>
                                    <div class="form-group">
                                        <label for="cardType">Card Type:</label>
                                        <input class="form-control" type="text" name="cardType" id="cardtype">
                                    </div>
                                    <input class="form-control" type="submit" value="Add Card">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($payment_methods as $method)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                        <div class="card mb-4 mx-auto" style="max-width: 16rem">
                            <img src="{{ asset('assets/master-card-logo.jpg') }}" alt="" class="card-img-top">
                            <div class="card-body">
                                <h5 class="card-title">{{ $method->card_number }}</h5>
                                <p class="card-text">{{ $method->type }}</p>
                                <form method="POST" action="/account/settings/payment">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="methodId" value="{{ $method->id }}">
                                    <input class="btn btn-olive" type="submit" value="Remove">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5">
            <h2 class="text-danger">Danger zone</h5>
            <p class="text-muted">The things in this area are very <span class="font-weight-bold">D A N G E R O U S</span></p>
            <div id="danger-zone-area" class="collapse mb-3 border border-danger">
                <div class="row justify-content-between border mx-0 p-3">
                    <div class="col-12 col-md-6">
                        <strong>
                            Delete account
                        </strong>
                        <p class="m-0">Once you delete your account, you can't get it back.</p>
                    </div>
                    <div class="col-12 col-md-6 d-flex justify-content-start justify-content-md-end align-items-center">
                        <button class="btn btn-danger mt-2 mt-md-0">Delete Account</button>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-danger" data-toggle="collapse" data-target="#danger-zone-area">Show</button>
        </div>
    </div>
    </div>
@endsection
