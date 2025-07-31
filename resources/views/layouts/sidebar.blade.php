<div class="sidebar" id="sidebar">

    {{-- ADMIN SIDEBAR --}}
    @role('admin')
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="logo-text">Admin Panel</div>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.pending') }}" class="nav-link {{ request()->routeIs('user.pending') ? 'active' : '' }}">
                <i class="fas fa-user-clock"></i>
                <span>Pending Users</span>
                @if(isset($pendingCount))
                    <span class="menu-badge bg-warning">{{ $pendingCount }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('user.approve') }}" class="nav-link {{ request()->routeIs('user.approve') ? 'active' : '' }}">
                <i class="fas fa-user-check"></i>
                <span>Approved Users</span>
                @if(isset($approvedCount))
                    <span class="menu-badge bg-success">{{ $approvedCount }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('user.blocked') }}" class="nav-link {{ request()->routeIs('user.blocked') ? 'active' : '' }}">
                <i class="fas fa-user-lock"></i>
                <span>Blocked Users</span>
                @if(isset($blockedCount))
                    <span class="menu-badge bg-danger">{{ $blockedCount }}</span>
                @endif
            </a>
        </li>
        <li>
            <a href="{{ route('user.frontier') }}" class="nav-link {{ request()->routeIs('user.frontier') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>Frontier</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.cci') }}" class="nav-link {{ request()->routeIs('user.cci') ? 'active' : '' }}">
                <i class="fas fa-user"></i>
                <span>CCI</span>
            </a>
        </li>
    </ul>
    @endrole


    {{-- USER SIDEBAR --}}
    @role('user')
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-user"></i>
        </div>
        <div class="logo-text">User Panel</div>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="{{ route('user.dashboard') }}" class="nav-link {{ request()->routeIs('user.dashboard') ? 'active' : '' }}">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="#" class="nav-link">
                <i class="fas fa-vial"></i>
                <span>Test Users</span>
            </a>
        </li>
    </ul>
    @endrole

</div>
