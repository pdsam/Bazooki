<nav class="navbar navbar-expand-md navbar-light bg-light">
    <div>        
        <a class="navbar-brand" href="/auctions"><img src={{ asset('/assets/small_panda.png') }} alt="Bazooki">Bazooki</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="nav-item form-inline my-auto mx-auto" action="/auctions/query" method="GET">
            <div class="input-group">
                <input class="w-auto form-control rounded-0" type="text" name="s"
                       placeholder="Search" aria-label="Search"
                        value="@yield('searchContent')">
                <button class="input-group-light btn btn-olive rounded-0" type="submit">
                    <i class="fa fa-search p-0"></i>
                    Search
                </button>
            </div>
        </form>
        @if(Auth::guard('bazooker')->check() || Auth::guard('mod')->check() || Auth::guard('admin')->check())
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url()->route('mybids') }}">My Bids</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/auctions/add">Create Auction</a>
                </li>
                <li class="nav-item active dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user p-0"></i>
                        @auth('bazooker')
                            {{ Auth::user()->name }}
                        @endauth
                        @auth('mod')
                            {{ Auth::guard('mod')->user()->email }}
                        @endauth
                        @auth('admin')
                            {{ Auth::guard('admin')->user()->email }}
                        @endauth
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        @if(Auth::check())
                        <a class="dropdown-item" href="/profile">Profile</a>
                        <a class="dropdown-item" href="/activity">My activity</a>
                        <a class="dropdown-item" href="/account/settings">Account Settings</a>
                        @endif
                        @if(Auth::guard('mod')->check() || Auth::guard('admin')->check())
                        <a class="dropdown-item" href="/mod">Dashboard</a>
                        @endif
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Log out</a>
                    </div>
                </li>
            </ul>
        @else
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/login">Login</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/register">Register</a>
                </li>
            </ul>
        @endif
    </div>
</nav>
