<div class="card shadow-sm rounded-0 border-0 mb-3">
    <div class="row align-items-top no-gutters">
        <div class="col-xs-12 col-sm-4">
            <img src="{{ asset($auction->thumbnailPhoto()) }}" class="auction-img card-img rounded-0" alt="logo">
            <a href="{{ route('auction', $auction->id) }}" class="stretched-link pr-0"></a>
        </div>
        <div class="col-xs-12 col-sm-8">
            <div class="card-body">
                <div class="d-flex flex-column-reverse flex-sm-row justify-content-between align-items-top">
                    <div class="">
                        <a href="{{ route('auction', $auction->id) }}"><h4 class="card-title">{{ $auction->item_name }}</h4></a>
                        @if ($auction->isOver())
                        <h6 class="card-subtitle text-muted">Already over</h6>
                        @else
                        <h6 class="card-subtitle text-muted">Ends: {{ $auction->endDateTime()->format('d M Y H:i:s') }}</h6>
                        @endif

                        <div>
                            @foreach($auction->categories as $cat)
                            <span class="badge badge-light border mr-1 mt-2">{{ $cat->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div>
                        <span class="mr-1 auction-price">{{ $auction->currentPrice() }} €</span>
                    </div>
                </div>
                <p class="mt-2 card-text auction-short-desc">{{ $auction->item_short_description }}</p>
            </div>
        </div> 
    </div>
    <div id="actions{{ $auction->id }}" class="user_actions collapse">
        <div class="row my-3 mx-2">     
            @if(!$auction->isFrozen())               
            <div class="col-lg-6">
                <button class="btn btn-primary" data-toggle="modal" data-target="#freezeModal{{ $auction->id }}">
                    Freeze
                </button>
            </div>
            @else
            <div class="col-lg-6">
                <button class="btn btn-primary" data-toggle="modal" data-target="#unfreezeModal{{ $auction->id }}">
                    Unfreeze
                </button>
            </div>
            @endif
            <div class="col-lg-6">
                <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $auction->id }}"
                        @if(!Auth::guard('admin')->check()) disabled @endif
                    >
                    Delete
                </button>
            </div>
        </div>
    </div>
    <a href="#actions{{ $auction->id }}" class="cert-toggle justify-content-center d-flex py-3 text-muted bg-light" data-toggle="collapse" data-target="#actions{{ $auction->id }}">
        <p class="m-0">Actions <span class="fa fa-chevron-down"></span></p>
    </a>


    @if(!$auction->isFrozen())   
    <!-- Freeze modal -->
    <div class="modal fade" id="freezeModal{{ $auction->id }}" tabindex="-1" role="dialog" aria-labelledby="freezeModalLabel{{ $auction->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="freezeModalLabel{{ $auction->id }}">Freeze auction: {{ $auction->item_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/mod/auctions/freeze/{{$auction->id}}">
                        @csrf
                        <div class="form-group">
                            <label for="suspension_reason">Reason</label>
                            <textarea name="reason" id="suspension_reason" class="form-control" rows="3" placeholder="Why is the auction being frozen?" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary form-modal-button">Freeze</button>
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Unfreeze modal -->
    <div class="modal fade" id="unfreezeModal{{ $auction->id }}" tabindex="-1" role="dialog" aria-labelledby="unfreezeModalLabel{{ $auction->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="unfreezeModalLabel{{ $auction->id }}">Freeze auction: {{ $auction->item_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/mod/auctions/freeze/{{$auction->id}}">
                        @csrf
                        @method('PATCH')
                        <p>Are you sure you want to unfreeze this auction?</p>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary form-modal-button">Unfreeze</button>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal{{ $auction->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $auction->id }}" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel{{ $auction->id }}">Delete auction: {{ $auction->item_name }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="/mod/auctions/{{$auction->id}}">
                        @csrf
                        @method('DELETE')
                        <div class="form-group">
                            <label for="ban_reason">Reason</label>
                            <textarea name="reason" id="ban_reason" class="form-control" rows="3" placeholder="Why is the auction being deleted?" required></textarea>
                        </div>
                        <p>Note: this action is irreversible!
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger form-modal-button">Delete</button>
                </div>
            </div>
        </div>
    </div>
</div>