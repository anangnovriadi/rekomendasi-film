<nav class="navbar navbar-expand-lg fixed-top navbar-light shadow nav-cus">
    <img src="{{ asset('front/img/video-camera.png') }}" />
    <a style="padding-left: 12px; color: white;" class="navbar-brand" href="/home">Rekomendasi Film</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto" id="nav">
            <li class="nav-item nav-inner">
                <a class="nav-link gray-d {{ Request::is('home') ? 'active-nav' : '' }}" href="/home">Home</a>
            </li>
            <li class="nav-item nav-inner">
                <a class="nav-link gray-d {{ Request::is('all-film') ? 'active-nav' : '' }}" href="{{ route('film') }}">Daftar Film</a>
            </li>
            <li class="nav-item nav-inner">
                <a class="nav-link gray-d {{ Request::is('coming-soon') ? 'active-nav' : '' }}" href="{{ route('coming.film') }}">Coming Soon</a>
            </li>
            <li class="nav-item nav-inner">
                <form action="{{ route('search.film') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="input-group">
                        <input type="text" name="qry" class="form-control rad-cus gross" placeholder="Search Film" />
                        <div class="input-group-append">
                            <button class="btn rad-cus2" type="submit" id="button-addon2">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </li>
            <li class="nav-item nav-inner dropdown nav-item-left">
                <div class="dropdown-menu shadow-medium" style="left: -38px;" aria-labelledby="dropdownMenuButton">
                    <a style="color: black;" class="dropdown-item text-left" href="{{ route('profile') }}">Profile</a>
                    <a class="dropdown-item text-left" href="#" style="text-transform: capitalize;">
                        <form method="POST" action="{{ route('logout') }}">
                            {{ csrf_field() }}
                            <button class="nav-link btn-tr p-0" style="color: black;" type="submit">Logout</button>
                        </form>
                    </a>
                </div>
                <a class="nav-link gray-d dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">{{ Auth::user()->firstname }}</a>
            </li>
        </ul>
    </div>
</nav>