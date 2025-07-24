@extends('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
<link rel="stylesheet" href="{{asset('css/userpage/showmodal.css')}}">

@section('content')
@include('layouts.header')


<div class="dashboard-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">
            <i class="fas fa-user-check me-2"></i>User CCI Task Management
        </h2>
    </div>

    <div class="table-responsive">
        <table class="table user-approval-table" id="pending-users-table">
            <thead>
                <tr>
                    <th class="id-col">ID</th>
                    <th class="name-col">First Name</th>
                    <th class="name-col">Last Name</th>
                    <th class="copy-col">Copy ID</th>
                    <th class="project-col">Project Name</th>
                    <th class="date-col">Registration Date</th>
                    <th class="email-col">Email</th>
                    <th class="action-col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($CCI as $user)
                <tr id="user-row-{{ $user->id }}">
                    <td class="id-col">{{ $user->id }}</td>
                    <td class="name-col"><span>{{ $user->name }}</span></td>
                    <td class="name-col">{{ $user->last_name }}</td>
                    <td class="copy-col">{{ $user->copy_id }}</td>
                    <td class="project-col">{{ $user->project_name }}</td>
                    <td class="date-col">{{ $user->created_at->format('d M Y') }}</td>
                    <td class="email-col">{{ $user->email }}</td>
                    <td class="status-col">
                        <a href=""
                            class="btn btn-sm btn-outline-primary d-inline-flex align-items-center gap-1 shadow-sm rounded-pill px-3 py-1">
                            <i class="fas fa-eye"></i> View Entries
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection