@extends('layouts.app')

@section('content')

@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">

<div class="dashboard-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="section-title">
      <i class="fas fa-user-lock me-2"></i> Blocked Users Management
    </h2>
  </div>

  <div class="table-responsive">
    <table class="table user-approval-table" id="blocked-users-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Copy ID</th>
          <th>Registration Date</th>
          <th>Email</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        @foreach($blocked as $user)
          <tr id="user-row-{{ $user->id }}">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->copy_id }}</td>
            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
            <td>{{ $user->email }}</td>
            <td><span class="badge bg-danger">Blocked</span></td>
          </tr>
        @endforeach
      </tbody>
    </table>

      <div class="mt-3 d-flex justify-content-center">
        {{ $blocked->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@endsection
