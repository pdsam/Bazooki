@extends('layouts.app')

@section('title', 'Account settings - Bazooker')

@section('content')
    <h1 class="mb-4">Settings</h1>
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
                    <label for="oldPass">Old password*</label>
                    <input class="form-control w-auto" type="password" name="oldPass" id="oldPass">
                </div>

                <div class="form-group">
                    <label for="newPass">New password*</label>
                    <input class="form-control w-auto" type="password" name="newPass" id="newPass">
                </div>

                <div class="form-group">
                    <label for="confirmPass">Confirm new password*</label>
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
                                <p>Valid card types are Visa, Maestro and MasterCard.</p>
                                <form id="paymentMethodForm" class="form" action="/account/settings/payment" method="POST">
                                    @csrf
                                    @method('POST')
                                    <input id="cardTypeInput" type="hidden" name="cardType">
                                    <div class="form-group">
                                        <label for="cardNumber">Card Number:</label>
                                        <input class="form-control" type="text" name="cardNumber" id="cardNumber">
                                    </div>
                                    <p id="cardTypeLabel"></p>
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
                            @switch($method->type)
                                @case('visa')
                                    <img src="{{ asset("assets/visa-logo.png") }}" alt="card brand logo" class="card-img-top m-auto">
                                    @break
                                @case('maestro')
                                <img src="{{ asset("assets/maestro-logo.png") }}" alt="card brand logo" class="card-img-top m-auto">
                                @break
                                @case('mastercard')
                                <img src="{{ asset("assets/mastercard-logo.png") }}" alt="card brand logo" class="card-img-top m-auto">
                                @break
                            @endswitch
                            <div class="card-body">
                                <h5 class="card-title">{{ $method->card_number }}</h5>
                                <form method="POST" action="/account/settings/payment">
                                    @csrf
                                    @method("DELETE")
                                    <input type="hidden" name="methodId" value="{{ $method->id }}">
                                    <input class="btn btn-danger" type="submit" value="Remove">
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="mb-5">
            <h2 class="text-danger">Danger zone</h2>
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
                        <button class="btn btn-danger mt-2 mt-md-0" data-toggle="modal" data-target="#delete-account-form">Delete Account</button>
                    </div>
                    <div id="delete-account-form" class="modal fade">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="text-danger">Delete account</h4>
                                </div>
                                <div class="modal-body">
                                    <p class="text-danger">Please type your password.</p>
                                    <form id="deleteAccountForm" class="form" action="/account/delete" method="POST">
                                        @csrf
                                        @method('POST')
                                        <div class="form-group">
                                            <label for="password">Password:</label>
                                            <input class="form-control" type="password" name="password" id="password">
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password:</label>
                                            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword">
                                        </div>
                                        <input class="form-control" type="submit" value="Delete Account">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-outline-danger" data-toggle="collapse" data-target="#danger-zone-area">Show</button>
        </div>
    </div>
    <script>
        $('#paymentMethodForm').on('submit', function (e) {
            e.preventDefault();
            const input = $('#cardTypeInput');
            const label = $('#cardTypeLabel');
            const value = $('#cardNumber').val();
            input.val(null);
            if (!$.isNumeric(value)) {
                label.html('Invalid card number');
                return;
            }

            if (value.length === 16) {
                if (value.charAt(0) === '4') {
                    input.val('visa');
                }

                let initial = parseInt(value.substring(0,2));
                if (initial >= 51 && initial <= 55) {
                    input.val('mastercard');
                }
                initial = parseInt(value.substring(0,4));
                if (initial >= 2221 && initial <= 2720) {
                    input.val('mastercard');
                }
            }
            if (value.length >= 12 && value.length <= 19) {
                let initial = parseInt(value.substring(0,2));
                if ((initial >= 56 && initial <= 69) || initial === 50) {
                    input.val('maestro');
                }
            }
            if (input.val !== null) {
                this.submit();
            }
        });

        $('#cardNumber').on('change', function() {
            const input = $('#cardTypeInput');
            const label = $('#cardTypeLabel');
            if (!$.isNumeric(this.value)) {
                input.val(null);
                label.html('Invalid card number');
                return;
            }

            const value = this.value;

            if (value.length === 16) {
                if (value.charAt(0) === '4') {
                    input.val('visa');
                    label.html('Visa');
                    return;
                }

                let initial = parseInt(value.substring(0,2));
                if (initial >= 51 && initial <= 55) {
                    input.val('mastercard');
                    label.html('MasterCard');
                    return;
                }
                initial = parseInt(value.substring(0,4));
                if (initial >= 2221 && initial <= 2720) {
                    input.val('mastercard');
                    label.html('MasterCard');
                    return;
                }
            }
            if (value.length >= 12 && value.length <= 19) {
                let initial = parseInt(value.substring(0,2));
                if ((initial >= 56 && initial <= 69) || initial === 50) {
                    input.val('maestro');
                    label.html('Maestro');
                    return;
                }
            }

            input.value = null;
            label.innerHTML = 'Invalid card type';
        });
    </script>
@endsection
