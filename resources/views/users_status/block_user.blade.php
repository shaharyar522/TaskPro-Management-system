@extends('layouts.app')

@section('content')

@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
<link rel="stylesheet" href="{{asset('css/userpage/editmodal.css')}}">

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


         <td>
  <div class="d-flex gap-2 justify-content-center action-buttons">
    
    <!-- Unblock Button -->
    <button class="btn btn-outline-success btn-icon-text unblock-user-btn" data-id="{{ $user->id }}">
      <i class="fas fa-unlock-alt me-1"></i>
      <span>Unblock</span>
    </button>

    <!-- Edit Button -->
    <button class="btn btn-outline-primary btn-icon-text edit-user-btn" data-id="{{ $user->id }}">
      <i class="fas fa-edit me-1"></i>
      <span>Edit</span>
    </button>

  </div>
</td>


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

{{-- unblock js --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.unblock-user-btn').forEach(button => {
      button.addEventListener('click', function () {
        const userId = this.dataset.id;

        Swal.fire({
          title: 'Are you sure?',
          text: 'This will unblock the user!',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#28a745',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, Unblock!'
        }).then((result) => {
          if (result.isConfirmed) {
            // Submit unblock request
            fetch(`/admin/users/${userId}/unblock`, {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({})
            })
            .then(res => {
              if (res.ok) {
                Swal.fire('Unblocked!', 'User has been unblocked.', 'success')
                  .then(() => {
                    window.location.href = '{{ route("user.blocked") }}'; // Redirect to approved users page
                  });
              } else {
                Swal.fire('Error!', 'Something went wrong.', 'error');
              }
            });
          }
        });
      });
    });
  });
</script>
        {{-- ============ start edit portion start ============--}}

<!-- Edit User Modal -->
<div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="edit-user-form" method="POST">
     @csrf
    @method('PUT')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" id="edit-user-id">

          <div class="mb-3">
            <label>First Name</label>
            <input type="text" class="form-control" name="name" id="edit-name">
          </div>
          <div class="mb-3">
            <label>Last Name</label>
            <input type="text" class="form-control" name="last_name" id="edit-last-name">
          </div>
          <div class="mb-3">
            <label>Copy ID</label>
            <input type="text" class="form-control" name="copy_id" id="edit-copy-id">
          </div>
          <div class="mb-3">
            <label>Registration Date</label>
            <input type="date" class="form-control" name="registration_date" id="edit-registration-date">
          </div>
          <div class="mb-3">
            <label>Email</label>
            <input type="email" class="form-control" name="email" id="edit-email">
          </div>
        </div>

        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Update User</button>
        </div>
      </div>
    </form>
  </div>
</div>

<script>
  document.querySelectorAll('.edit-user-btn').forEach(button => {
    button.addEventListener('click', () => {
      const userId = button.dataset.id;

      fetch(`/admin/pending-users/${userId}`)
        .then(response => response.json())
        .then(user => {
          document.getElementById('edit-user-id').value = user.id || '';
          document.getElementById('edit-name').value = user.name || '';
          document.getElementById('edit-last-name').value = user.last_name || '';
          document.getElementById('edit-copy-id').value = user.copy_id || '';
          document.getElementById('edit-email').value = user.email || '';
          document.getElementById('edit-registration-date').value = user.registration_date || '';

          document.getElementById('edit-user-form').action = `/admin/users/updateblock/${user.id}`;

          const modal = new bootstrap.Modal(document.getElementById('editUserModal'));
          modal.show();
        })
        .catch(error => {
          console.error('Error fetching user:', error);
          alert('Something went wrong while fetching user data.');
        });
    });
  });
</script>

@if(session('success'))
<script>
  Swal.fire({
      icon: 'success',
      title: 'Success',
      text: '{{ session('success') }}',
      timer: 2000,
      showConfirmButton: false
    });
</script>
@endif

{{-- ============ End edit portion start ============ --}}


@endsection