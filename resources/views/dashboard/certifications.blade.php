@extends('layouts.dashboard_page')

@section('active-certifications', 1)

@section('tab-content')
    <h2>Certifications</h2>
    <?php for ($i=0; $i < 10; $i++) { ?>
        <div class="shadow-sm border mt-3 mt-lg-1">
            <div class="card rounded-0 border-0">
                <div class="row align-items-center no-gutters">
                    <div class="col-12 col-sm-4">
                        <img src="/assets/gun.jpg" class="card-img rounded-0" alt="logo">
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="card-body">
                            <h4 class="card-title">Super cool gun</h4>
                            <h6 class="card-subtitle text-muted">Owned by: <a href="profile.php">super_cool_man</a></h6>
                            <div class="mt-3">
                                <p>
                                This is a genuine revolver, I got it from my grandfather. It dates back to WWII.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="certification<?= $i ?>" class="collapse p-3">
                <div class="my-3 mx-2">
                    Certification documents:
                    <ul>
                        <li>
                            <a href="/assets/cert1.pdf">document1</a>
                        </li>
                        <li>
                            <a href="/assets/cert2.pdf">document2</a>
                        </li>
                        <li>
                            <a href="/assets/cert3.pdf">document3</a>
                        </li>
                    </ul>
                </div>
                <div class="mt-2">
                    <button class="btn btn-success">
                        Accept
                    </button>
                    <button class="btn btn-danger">
                        Reject
                    </button>
                </div>
            </div>
            <a href="#certification<?= $i ?>" class="cert-toggle justify-content-center d-flex py-3 text-muted bg-light" data-toggle="collapse" data-target="#certification<?= $i?>">
                <p class="m-0">Documents <span class="fa fa-chevron-down"></span></p>
            </a>
        </div>
    <?php } ?>
@endsection