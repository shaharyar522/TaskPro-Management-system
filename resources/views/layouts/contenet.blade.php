 <!-- Header -->
        <header class="header">
            <div>
                <button class="toggle-btn" id="toggleBtn">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
            <div class="user-actions">
                <div class="notification-bell">
                    <i class="fas fa-bell"></i>
                    <span class="notification-badge">3</span>
                </div>
                <div class="dropdown">
                    <div class="user-profile dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                        <span class="user-name">John Doe</span>
                        <i class="fas fa-chevron-down"></i>
                    </div>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="#"><i class="fas fa-user me-2"></i> Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Settings</a></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-envelope me-2"></i> Messages</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#"><i class="fas fa-sign-out-alt me-2"></i> Logout</a></li>
                    </ul>
                </div>
            </div>
        </header>

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h1 class="welcome-title">Welcome back, John!</h1>
                <p class="welcome-text">Here's what's happening with your tasks today.</p>
                <button class="btn btn-light">View Tasks</button>
            </div>

            <!-- Stats Cards -->
            <div class="row">
                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon primary">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h5 class="stats-title">Total Tasks</h5>
                        <h3 class="stats-value">24</h3>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 12% from last week
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon success">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <h5 class="stats-title">Completed</h5>
                        <h3 class="stats-value">15</h3>
                        <div class="stats-change positive">
                            <i class="fas fa-arrow-up"></i> 8% from last week
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon warning">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h5 class="stats-title">In Progress</h5>
                        <h3 class="stats-value">6</h3>
                        <div class="stats-change negative">
                            <i class="fas fa-arrow-down"></i> 3% from last week
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="stats-card">
                        <div class="stats-icon danger">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <h5 class="stats-title">Overdue</h5>
                        <h3 class="stats-value">3</h3>
                        <div class="stats-change negative">
                            <i class="fas fa-arrow-up"></i> 5% from last week
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tasks Section -->
            <div class="row mt-4">
                <div class="col-lg-8">
                    <h3 class="section-title">Recent Tasks</h3>
                    
                    <div class="task-card">
                        <div class="task-header">
                            <h4 class="task-title">Design Dashboard UI</h4>
                            <span class="task-priority priority-high">High Priority</span>
                        </div>
                        <p class="task-description">
                            Create a modern and responsive dashboard UI for the new admin panel with all required components and widgets.
                        </p>
                        <div class="task-footer">
                            <div class="task-assignees">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Assignee" class="assignee-avatar">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Assignee" class="assignee-avatar">
                                <img src="https://randomuser.me/api/portraits/women/33.jpg" alt="Assignee" class="assignee-avatar">
                            </div>
                            <div class="task-date">
                                Due: Today, 5:00 PM
                            </div>
                        </div>
                    </div>
                    
                    <div class="task-card">
                        <div class="task-header">
                            <h4 class="task-title">Implement API Endpoints</h4>
                            <span class="task-priority priority-medium">Medium Priority</span>
                        </div>
                        <p class="task-description">
                            Develop and test all required API endpoints for user management module with proper authentication.
                        </p>
                        <div class="task-footer">
                            <div class="task-assignees">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Assignee" class="assignee-avatar">
                                <img src="https://randomuser.me/api/portraits/men/12.jpg" alt="Assignee" class="assignee-avatar">
                            </div>
                            <div class="task-date">
                                Due: Tomorrow, 11:00 AM
                            </div>
                        </div>
                    </div>
                    
                    <div class="task-card">
                        <div class="task-header">
                            <h4 class="task-title">Write Documentation</h4>
                            <span class="task-priority priority-low">Low Priority</span>
                        </div>
                        <p class="task-description">
                            Prepare comprehensive documentation for the new features added in the latest release.
                        </p>
                        <div class="task-footer">
                            <div class="task-assignees">
                                <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Assignee" class="assignee-avatar">
                            </div>
                            <div class="task-date">
                                Due: Friday, 3:00 PM
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <h3 class="section-title">Task Progress</h3>
                    
                    <div class="progress-container">
                        <div class="progress-title">
                            <span>Design Dashboard</span>
                            <span>75%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-title">
                            <span>API Development</span>
                            <span>45%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: 45%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-title">
                            <span>Testing</span>
                            <span>30%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: 30%"></div>
                        </div>
                    </div>
                    
                    <div class="progress-container">
                        <div class="progress-title">
                            <span>Documentation</span>
                            <span>15%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-bar-fill" style="width: 15%"></div>
                        </div>
                    </div>
                    
                    <h3 class="section-title mt-4">Quick Actions</h3>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add New Task
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-calendar-plus me-2"></i> Schedule Meeting
                        </button>
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-file-export me-2"></i> Generate Report
                        </button>
                    </div>
                </div>
            </div>
        </div>