<div class="shadow-sm border mt-3 mt-lg-1 certification-card">
    <div class="card rounded-0 border-0">
        <div class="row align-items-center no-gutters">
            <div class="col-12 col-sm-4">
                <img src="{{ asset($bazooker->profile_pic) }}" class="card-img rounded-0" alt="logo">
            </div>
            <div class="col-12 col-sm-8">
                <div class="card-body">
                    <h4 class="card-title"><a href="/profile/{{ $bazooker->id }}">{{ $bazooker->name }}</a></h4>
                    <h6 class="card-subtitle text-muted"><a href="/profile/{{ $bazooker->id }}">{{ $bazooker->username }}</a></h6>
                    <div class="mt-3">
                        <p>
                            {{ $bazooker->description }}
                        </p>
                    </div>
                    <div class="row ml-0 justify-content-between">
                        <form method="post" action="/mod/users/suspend/{{$bazooker->id}}">
                            @csrf
                            <label for="duration">Duration</label>
                            <input type="numric" value="0" id="duration"></input>
                            <button type="submit" class="btn btn-large bg-warning">Suspend</button>
                        </form>
                        <form method="post" class="mr-2" action="/mod/users/ban/{{$bazooker->id}}">
                            @csrf
                            <button type='submit' class="btn btn-large btn-danger">Ban</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>