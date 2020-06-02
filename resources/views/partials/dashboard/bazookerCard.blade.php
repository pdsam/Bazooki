<div class="shadow-sm border mt-3 mt-lg-1 certification-card">
    <div class="card rounded-0 border-0">
        <div class="row align-items-center no-gutters">
            <div class="col-12 col-sm-4">
                <img src="{{ asset($bazooker->profile_pic) }}" class="card-img rounded-0" alt="logo">
            </div>
            <div class="col-12 col-sm-8">
                <div class="card-body">
                    <h4 class="card-title">{{ $bazooker->name }}</h4>
                    <h6 class="card-subtitle text-muted"><a href="/profile/{{ $bazooker->id }}">{{ $bazooker->username }}</a></h6>
                    <div class="mt-3">
                        <p>
                            {{ $bazooker->description }}
                        </p>
                    </div>
                    <a class="btn btn-primary" href="#" target="_blank" rel="noopener noreferrer">View certification</a>
                </div>
            </div>
        </div>
    </div>

</div>