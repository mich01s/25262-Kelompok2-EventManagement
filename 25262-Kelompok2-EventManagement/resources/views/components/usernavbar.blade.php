        <nav class="app-header navbar navbar-expand bg-body">
            <!--begin::Container-->
            <div class="container-fluid">
                <!--begin::Start Navbar Links-->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                            <i class="bi bi-list"></i>
                        </a>
                    </li>
                    <li class="nav-item d-none d-md-block">
                        <a href="{{ route('user.dashboard') }}" class="nav-link">Home</a>
                    </li>
                </ul>
                <!--end::Start Navbar Links-->

                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Navbar Search-->
                    <li class="nav-item">
                        <form class="d-flex" action="{{ route('user.events') }}" method="GET">
                            <input class="form-control form-control-sm me-2" type="search" name="q" placeholder="Cari event..." value="{{ request('q') }}" aria-label="Cari event" />
                            <button class="btn btn-sm btn-outline-secondary" type="submit">
                                <i class="bi bi-search"></i>
                            </button>
                        </form>
                    </li>
                    <!--end::Navbar Search-->

                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->

                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img src="{{asset('assets/img/user2-160x160.jpg')}}" class="user-image rounded-circle shadow"
                                alt="User Image" />
                            <span class="d-none d-md-inline">User</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                            <!--begin::User Image-->
                            <li class="user-header text-bg-primary">
                                <img src="{{asset('assets/img/user2-160x160.jpg')}}" class="rounded-circle shadow"
                                    alt="User Image" />
                                <p>
                                    User 
                                    <small>Member since Nov. 2023</small>
                                </p>
                            </li>
                            <!--end::User Image-->
                            <!--begin::Menu Body-->
                            <!--end::Menu Body-->
                            <!--begin::Menu Footer-->
                            <li class="user-footer">
                                <div class="d-flex justify-content-end gap-2">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-primary">Logout</button>
                                    </form>
                                    <a href="{{ route('profile.show') }}" class="btn btn-sm btn-outline-secondary">Lihat</a>
                                </div>
                            </li>
                            <!--end::Menu Footer-->
                        </ul>
                    </li>
                    <!--end::User Menu Dropdown-->
                </ul>
                <!--end::End Navbar Links-->
            </div>
            <!--end::Container-->
        </nav>