





@extends('layouts.app')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">

@section('content')
@include('layouts.header')

<div class="dashboard-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="section-title">
      <i class="fas fa-user-check me-2"></i>User Pending Task Management
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
          <th class="date-col">Registration Date</th>
          <th class="email-col">Email</th>
          <th class="status-col">Status</th>
          <th class="action-col">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($pendings as $user)
        <tr id="user-row-{{ $user->id }}">
          <td class="id-col">{{ $user->id }}</td>
          <td class="name-col"><span>{{ $user->name }}</span></td>
          <td class="name-col">{{ $user->last_name }}</td>
          <td class="copy-col">{{ $user->copy_id }}</td>
          <td class="date-col">{{ $user->created_at->format('d M Y') }}</td>
          <td class="email-col">{{ $user->email }}</td>
          <td class="status-col">
            <span class="badge bg-warning text-dark">Pending</span>
          </td>
          <td class="action-col">
            <button class="btn-action btn-view" data-id="{{ $user->id }}" data-bs-toggle="modal" data-bs-target="#userViewModal" title="View">
              <i class="fas fa-eye"></i>
            </button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
     <div class="mt-3 d-flex justify-content-center">
        {{ $pendings->links('pagination::bootstrap-5') }}
    </div>
  </div>



</div>

<!-- User View Modal -->
<div class="modal fade" id="userViewModal" tabindex="-1" aria-labelledby="userViewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header bg-primary text-white">
        <h5 class="modal-title"><i class="fas fa-user"></i> User Details</h5>
        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST" id="approve-user-form">
          @csrf
          <table class="table table-bordered">
            <tr><th>ID</th><td id="view-id"></td></tr>
            <tr><th>Name</th><td id="view-name"></td></tr>
            <tr><th>Last Name</th><td id="view-lastname"></td></tr>
            <tr><th>Copy ID</th><td id="view-copyid"></td></tr>
            <tr><th>Registration Date</th><td id="view-regdate"></td></tr>
            <tr><th>Email</th><td id="view-email"></td></tr>
            <tr><th>Email Verified At</th><td id="view-verified"></td></tr>
            <tr><th>Status</th>
              <td>
                <select class="form-select" name="status" id="view-status-select">
                  <option value="0">Inactive</option>
                  <option value="1">Active</option>
                </select>
              </td>
            </tr>
          </table>

          <div class="text-end mt-3">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  document.addEventListener("DOMContentLoaded", function () {
    // Show user in modal
    document.querySelectorAll(".btn-view").forEach(button => {
      button.addEventListener("click", function () {
        let userId = this.getAttribute("data-id");

        fetch(`/admin/pending-users/${userId}`)
          .then(response => response.json())
          .then(data => {
            document.getElementById("view-id").innerText = data.id;
            document.getElementById("view-name").innerText = data.name;
            document.getElementById("view-lastname").innerText = data.last_name;
            document.getElementById("view-copyid").innerText = data.copy_id;
            document.getElementById("view-regdate").innerText = data.registration_date ?? 'N/A';
            document.getElementById("view-email").innerText = data.email;
            document.getElementById("view-verified").innerText = data.email_verified_at ?? 'Not Verified';
            document.getElementById("view-status-select").value = data.status;

            // Set form action dynamically
            document.getElementById("approve-user-form").action = `/admin/pending-users/${data.id}/approve`;
          });
      });
    });

    // Show SweetAlert if update was successful
    @if(session('success'))
      Swal.fire({
        icon: 'success',
        title: 'Success',
        text: '{{ session("success") }}',
        confirmButtonColor: '#3085d6'
      });
    @endif
  });
</script>

@endsection
