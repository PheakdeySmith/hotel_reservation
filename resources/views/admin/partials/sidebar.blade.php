<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Apsara<span><b>HOTEL</b></span>
        </a>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Customers</li>
            <li class="nav-item">
                <a href="{{ route('admin.customertype.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Customer Type</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.customer.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Customer Table</span>
                </a>
            </li>
            <li class="nav-item nav-category">Rooms</li>
            <li class="nav-item">
                <a href="{{ route('admin.roomtype.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="layout"></i>
                    <span class="link-title">Room Type</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('admin.room.index') }}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Room Table</span>
                </a>
            </li>
            <li class="nav-item nav-category">Transaction</li>
            <li class="nav-item">
                <a href="{{ route('admin.reservation') }}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Reservation</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
