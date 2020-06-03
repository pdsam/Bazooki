<div class="shadow-sm border mt-3 mt-lg-1 certification-card">
    <div class="card rounded-0 border-0">
        <div class="row align-items-center no-gutters">
            <div class="col-12 col-sm-4">
                <img src="{{ asset($bazooker->photo()) }}" class="card-img rounded-0" alt="logo">
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
                </div>
            </div>
        </div>
    </div>
    <div id="actions{{ $bazooker->id }}" class="user_actions collapse">
        <div class="row my-3 mx-2">     
            @if(!$bazooker->isSuspended())               
            <div class="col-lg-6">
                <button class="btn btn-warning" data-toggle="modal" data-target="#suspensionModal{{ $bazooker->id }}">
                    Suspend
                </button>
            </div>
            @else
            <div class="col-lg-6">
                <button class="btn btn-warning" data-toggle="modal" data-target="#unsuspensionModal{{ $bazooker->id }}">
                    Unsuspend
                </button>
            </div>
            @endif
            @if(Auth::guard('admin')->check())  
            <div class="col-lg-6">
                <button class="btn btn-danger" data-toggle="modal" data-target="#banModal{{ $bazooker->id }}">
                    Ban
                </button>
            </div>
            @else
            <div class="col-lg-6">
                <button class="btn btn-danger" data-toggle="modal" data-target="#banModal{{ $bazooker->id }}" disabled>
                    Ban
                </button>
            </div>
            @endif
        </div>
    </div>
    <a href="#actions{{ $bazooker->id }}" class="cert-toggle justify-content-center d-flex py-3 text-muted bg-light" data-toggle="collapse" data-target="#actions{{ $bazooker->id }}">
        <p class="m-0">Actions <span class="fa fa-chevron-down"></span></p>
    </a>

    <!-- Suspension modal -->
    <div class="modal fade" id="suspensionModal{{ $bazooker->id }}" tabindex="-1" role="dialog" aria-labelledby="suspensionModalLabel{{ $bazooker->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="suspensionModalLabel{{ $bazooker->id }}">Suspend User: {{ $bazooker->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/mod/users/suspend/{{$bazooker->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="suspension_duration">Duration</label>
                            <input name="duration" type="number" class="form-control" min="1" step="1" id="suspension_duration" placeholder="How many days?" required></input>
                        </div>
                        <div class="form-group">
                            <label for="suspension_reason">Reason</label>
                            <textarea name="reason" id="suspension_reason" class="form-control" rows="3" placeholder="Why is the user being suspended?" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning form-modal-button">Suspend</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Unsuspension modal -->
    <div class="modal fade" id="unsuspensionModal{{ $bazooker->id }}" tabindex="-1" role="dialog" aria-labelledby="unsuspensionModalLabel{{ $bazooker->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unsuspensionModalLabel{{ $bazooker->id }}">Unsuspend User: {{ $bazooker->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/mod/users/suspend/{{$bazooker->id}}">
                        @csrf
                        @method('PATCH')
                        <p>Are you sure you want to unsuspend this user?</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-warning form-modal-button">Unsuspend</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Ban modal -->
    <div class="modal fade" id="banModal{{ $bazooker->id }}" tabindex="-1" role="dialog" aria-labelledby="banModalLabel{{ $bazooker->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="banModalLabel{{ $bazooker->id }}">Ban User: {{ $bazooker->name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/mod/users/ban/{{$bazooker->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="ban_reason">Reason</label>
                            <textarea name="reason" id="ban_reason" class="form-control" rows="3" placeholder="Why is the user being banned?" required></textarea>
                        </div>
                        <p>Note: this action is irreversible!
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger form-modal-button">Ban</button>
                </div>
            </div>
        </div>
    </div>

    
</div>