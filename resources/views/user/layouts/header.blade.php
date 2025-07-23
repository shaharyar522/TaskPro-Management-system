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
                        <img src="https://media.istockphoto.com/id/1321387967/vector/concept-of-project-closure-project-managment-life-cycle-3d-vector-illustration.jpg?s=612x612&w=0&k=20&c=ZLW7FtbJVoEZMvgErFn4ALa8wXntkEtLqCmPSiydN6c=" alt="User" class="user-avatar">
                
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <div class="dropdown-menu">
                        
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