<nav class="navbar navbar-expand-lg fixed-top navbar-light shadow nav-cus">
    <img src="{{ asset('front/img/video-camera.png') }}" />
    <a style="padding-left: 12px; color: white;" class="navbar-brand" href="/home">Rekomendasi Film</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link gray-d" href="/home">Home</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}">
                    {{ csrf_field() }}
                    <button class="nav-link btn-tr gray-d" type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>