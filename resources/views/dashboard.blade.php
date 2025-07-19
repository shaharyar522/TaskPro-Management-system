@extends('layouts.app')
@include('layouts.sidebar')
@section('content')
<!-- Header -->
@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/dashbodfront.css')}}">

<!-- Dashboard Content -->
<div class="dashboard-container">
    <!-- Welcome Card -->
    <div class="welcome-card">
        <div class="welcome-content">
            <div class="welcome-header">
                <h1 class="welcome-title">Task Management Dashboard</h1>
                <p class="welcome-text">Here's what's happening with your tasks today</p>
            </div>

            <div class="welcome-stats">


                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-info">
                        <span class="menu-badge bg-warning">{{ $pendingCount ?? 0 }}</span>
                        <span class="stat-label">Pending User</span>
                    </div>
                </div>

                <div class="stat-card">

                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-info">
                        <span class="menu-badge bg-success">{{ $approvedCount ?? 0 }}</span>
                        <span class="stat-label">Approved User</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                    <div class="stat-info">
                        <span class="menu-badge bg-danger">{{ $blockedCount ?? 0 }}</span>
                        <span class="stat-label">blocked User</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="welcome-illustration">
            <img src="https://illustrations.popsy.co/amber/digital-nomad.svg" alt="Task Management Illustration">
        </div>
    </div>


</div>
@endsection