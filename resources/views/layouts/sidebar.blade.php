<div class="sidebar">
    
    @role('admin')
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="logo-text">Admin</div>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{route('admin.dashboard')}}" class="nav-link active" id="dashboard-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.pending')}}" class="nav-link" id="pending-link">
                <i class="fas fa-user-clock"></i>
                <span>Pending Users</span>
                <span class="menu-badge bg-warning">{{ $pendingCount ?? 0 }}</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.approve')}}" class="nav-link" id="approved-link">
                <i class="fas fa-user-check"></i>
                <span>Approved Users</span>
                <span class="menu-badge bg-success">{{ $approvedCount ?? 0 }}</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.blocked')}}" class="nav-link" id="blocked-link">
                <i class="fas fa-user-lock"></i>
                <span>Blocked Users</span>
                <span class="menu-badge bg-danger">{{ $blockedCount ?? 0 }}</span>
            </a>
        </li>
        <li>
             <a href="{{route('user.frontier')}}" class="nav-link" id="blocked-link">
                <i class="fas fa-user"></i>
                <span>Frontier Users</span>
            </a>
        </li>
        <li>
            <a href="{{route('user.cci')}}" class="nav-link" id="blocked-link">
                <i class="fas fa-user"></i>
                <span>CCI Users</span>
            </a>
        </li>
    </ul>
    @endrole
    
    @role('user')
    <div class="sidebar-header">
        <div class="logo-icon">
            <i class="fas fa-user-shield"></i>
        </div>
        <div class="logo-text">User</div>
    </div>
    <ul class="sidebar-menu">
        <li>
            <a href="{{route('user.dashboard')}}" class="nav-link active" id="dashboard-link">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
        </li>
       
        <li>
            <a href="#" class="nav-link" id="blocked-link">
                <i class="fas fa-user-lock"></i>
                <span>Test users</span>
                
            </a>
        </li>
    </ul>
    @endrole
</div>