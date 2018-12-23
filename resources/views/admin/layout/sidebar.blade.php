<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-devider m-0 mt-0 mb-3"></li>
                <li> <a class="waves-effect waves-dark" href="{{ route('dashboard') }}" aria-expanded="false"><i class="mdi mdi-home"></i><span class="hide-menu">Dashboard</span></a>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-movie"></i><span class="hide-menu">Film</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('view.film') }}">Daftar Film</a></li>
                        <li><a href="{{ route('view.genre') }}">Daftar Genre</a></li>
                    </ul>
                </li>
                <li> <a class="has-arrow waves-effect waves-dark" aria-expanded="false"><i class="mdi mdi-account-multiple"></i><span class="hide-menu">User</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{ route('view.user') }}">Daftar User</a></li>
                    </ul>
                </li>
                <li> <a class="waves-effect waves-dark" href="#" aria-expanded="false"><i class="mdi mdi-settings"></i><span class="hide-menu">Settings</span></a>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>