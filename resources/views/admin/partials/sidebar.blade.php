<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Apsara<span><b>HOTEL</b></span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Fields</li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#customerPages" role="button"
                    aria-expanded="false" aria-controls="customerPages">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Manage Customer</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="customerPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="/admin/customertype" class="nav-link {{ request()->routeIs('admin.customertype.*') ? 'active' : '' }}">Customer Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/customer/index" class="nav-link {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}">Customer Table</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="collapse" href="#roomPages" role="button"
                    aria-expanded="false" aria-controls="roomPages">
                    <i class="link-icon" data-feather="home"></i>
                    <span class="link-title">Manage Room</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="collapse" id="roomPages">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="/admin/roomtype" class="nav-link {{ request()->routeIs('admin.roomtype.*') ? 'active' : '' }}">Room Type</a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/room/table" class="nav-link {{ request()->routeIs('admin.room.*') ? 'active' : '' }}">Room Table</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item nav-category">Transaction</li>
            <li class="nav-item">
                <a href="{{ route('reservation.index') }}" class="nav-link {{ request()->routeIs('reservation.index') ? 'active' : '' }}">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Reservation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
