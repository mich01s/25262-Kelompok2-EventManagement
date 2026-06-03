 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand">
          <!--begin::Brand Link-->
          <a href="../index.html" class="brand-link">
            <!--begin::Brand Image-->
            <img
              src="{{asset('assets/img/AdminLTELogo.png')}}"
              alt="AdminLTE Logo"
              class="brand-image opacity-75 shadow"
            />
            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <span class="brand-text fw-light">ADMIN</span>
            <!--end::Brand Text-->
          </a>
          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="navigation"
              aria-label="Main navigation"
              data-accordion="false"
              id="navigation"
            >
              <li class="nav-item">
                <a href="{{route('admin.dashboard')}}" class="nav-link">
                  <i class="nav-icon bi bi-speedometer"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
                
              </li>
              <li class="nav-item">
                <a href="{{route('organizer.index')}}" class="nav-link">
                  <i class="nav-icon bi bi-building"></i>
                  <p>organizer</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('kategori.index')}}" class="nav-link">
                  <i class="nav-icon bi bi-bank2"></i>
                  <p>Kategori</p>
                </a>
              </li>
              <li class="nav-item mt-3 border-top pt-3">
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button type="submit" class="nav-link w-100 text-start" style="border: none; background: none; padding: 0.5rem 0;">
                    <i class="nav-icon bi bi-box-arrow-right"></i>
                    <p>Logout</p>
                  </button>
                </form>
              </li>
              
          </nav>
        </div>
        <!--end::Sidebar Wrapper-->
      </aside>