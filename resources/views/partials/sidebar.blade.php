<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a {{-- target="_blank"  --}} href="{{ route('homepage') }}" class="brand-link text-center">
        <span class="brand-text font-weight-light">Pakomkost</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">
                    {{ Auth::user()->name }} || {{ Auth::user()->brand_name ?? '' }}
                </a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <li class="nav-item" style="margin-bottom: 10px;">
                    <a href="{{ route('kosts.index') }}" class="nav-link" style="display: flex; align-items: center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-houses-fill" viewBox="0 0 16 16" style="margin-right: 5px;">
                            <path
                                d="M7.207 1a1 1 0 0 0-1.414 0L.146 6.646a.5.5 0 0 0.708.708L1 7.207V12.5A1.5 1.5 0 0 0 2.5 14h.55a2.5 2.5 0 0 1-.05-.5V9.415a1.5 1.5 0 0 1-.56-2.475l5.353-5.354z" />
                            <path
                                d="M8.793 2a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1.5-.5h1a.5.5 0 0 1.5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708z" />
                        </svg>
                        <p class="ml-2" style="margin-bottom: 0;">
                            Kost
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('room_classes.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-door-open"></i>
                        <p>Room Classes</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('rooms.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-bed"></i>
                        <p>Rooms</p>
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.properties.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Property
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.messages.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Messages
                        </p>
                    </a>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('admin.subscribers.index') }}" class="nav-link">
                        <i class="nav-icon fas fa-th"></i>
                        <p>
                            Subscriber
                        </p>
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a onclick="return document.getElementById('logout').submit();" href="#" class="nav-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                            class="bi bi-box-arrow-in-left" viewBox="0 0 16 16" style="margin-right: 10px;">
                            <path fill-rule="evenodd"
                                d="M10 3.5a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-2a.5.5 0 0 1 1 0v2A1.5 1.5 0 0 1 9.5 14h-8A1.5 1.5 0 0 1 0 12.5v-9A1.5 1.5 0 0 1 1.5 2h8A1.5 1.5 0 0 1 11 3.5v2a.5.5 0 0 1-1 0z" />
                            <path fill-rule="evenodd"
                                d="M4.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H14.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708z" />
                        </svg>
                        <p>
                            Logout
                        </p>
                        <form id="logout" action="{{ route('logout') }}" method="post">
                            @csrf
                        </form>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
