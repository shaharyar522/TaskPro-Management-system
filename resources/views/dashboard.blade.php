

@extends('layouts.app')


 @section('content')

      <!-- Header -->
    @include('layouts.header')

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Welcome Card -->
            <div class="welcome-card">
                <h1 class="welcome-title">Task Management</h1>
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

           
        </div>
     
 @endsection