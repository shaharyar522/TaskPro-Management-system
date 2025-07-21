@extends('user.layouts.layoutsUser')

@section('content')

<header class="dashboard-header">
    <div class="header-left">
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <h1 class="header-title" onclick="showSection('form-section')">Dashboard</h1>
        <h1 class="header-title" onclick="showSection('report-section')">Report</h1>

    </div>
    <div class="header-right">
        <div class="user-dropdown">
            <div class="user-profile">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                <span class="user-name">John Doe</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="dropdown-menu">
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                </a>
                <a href="#" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
<h1>This is CCI User Dashboard</h1>
@endsection