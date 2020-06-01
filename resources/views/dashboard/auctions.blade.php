@extends('layouts.dashboard_page')

@section('active-auctions', 1)

@section('tab-content')
    <h2>Auctions</h2>
    <?php for ($i=0; $i < 10; $i++) { ?>
        <div class="card shadow-sm rounded-0 border mt-3 mt-lg-1">
            <div class="row align-items-center no-gutters">
                <div class="col-12 col-sm-4">
                    <img src="/assets/gun.jpg" class="card-img rounded-0" alt="logo">
                </div>
                <div class="col-12 col-sm-8">
                    <div class="card-body">
                        <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                            <div class="">
                                <h5 class="card-title">Super cool gun</h5>
                                <h6 class="card-subtitle text-muted">Ends at: 05/07/2020 23:59:59</h6>
                            </div>
                            <div>
                                <span class="mr-1" style="font-size: 2rem">300</span>$
                            </div>
                        </div>
                        <p class="card-text">This gun is very strong. It is also very pretty.</p>
                        <div>
                            <button class="btn btn-large btn-primary">Freeze</button>
                            <button class="btn btn-large btn-danger">Remove</button>
                        </div>
                    </div>
                </div>
                <a href="#" class="stretched-link"></a>
            </div>
        </div>
    <?php } ?>
@endsection