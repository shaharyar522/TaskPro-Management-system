@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
<link rel="stylesheet" href="{{asset('css/userpage/editmodal.css')}}">
@include('layouts.header')



<div class="dashboard-content">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="section-title">
      <i class="fas fa-user-check me-2"></i> Approved Users Management
    </h2>
  </div>

  <div class="table-responsive">
    <table class="table user-approval-table" id="approved-users-table">
      <thead>
        <tr>
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Copy ID</th>
          <th>Project Name</th>
          <th>Registration Date</th>
          <th>Email</th>
          <th>Status</th>
          <th style="text-align: center;">Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($approved as $user)
        <tr id="user-row-{{ $user->id }}">
          <td>{{ $user->id }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->last_name }}</td>
          <td>{{ $user->copy_id }}</td>
          <td>{{ $user->project_name }}</td>
          <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
          <td>{{ $user->email }}</td>
          <td><span class="badge bg-success">Approved</span></td>

          <td>
            <div class="d-flex gap-2 justify-content-center action-buttons">
              <!-- Block Button -->
              <button class="btn btn-outline-danger btn-icon-text block-user-btn" data-id="{{ $user->id }}">
                <i class="fas fa-ban"></i>
                <span>User Block</span>
              </button>
              <!-- Edit Button -->
              <button class="btn btn-outline-primary btn-icon-text edit-user-btn" data-id="{{ $user->id }}">
                <i class="fas fa-edit"></i>
                <span>Edit</span>
              </button>
            </div>
          </td>


        </tr>
        @endforeach
      </tbody>
    </table>

    <div class="mt-3 d-flex justify-content-center">
      {{ $approved->links('pagination::bootstrap-5') }}
    </div>
  </div>
</div>




<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Block User Script -->
<script>
  document.querySelectorAll('.block-user-btn').forEach(button => {
    button.addEventListener('click', function () {
      const userId = this.dataset.id;

      Swal.fire({
        title: 'Are you sure?',
        text: "This will block the user.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, block user!'
      }).then((result) => {
        if (result.isConfirmed) {
          fetch(`{{ url('/admin/users/block') }}/${userId}`, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
          })
          .then(response => response.json())
          .then(data => {
            if (data.success) {
              Swal.fire('Blocked!', data.message, 'success');
              document.getElementById('user-row-' + userId).remove();

  // uay code immediattly coutntre show kary ga
    const blockedCountElem = document.querySelector('.menu-badge.bg-danger');
    const approvedCountElem = document.querySelector('.menu-badge.bg-success');

    if (blockedCountElem && approvedCountElem) {
      blockedCountElem.textContent = parseInt(blockedCountElem.textContent) + 1;
      approvedCountElem.textContent = parseInt(approvedCountElem.textContent) - 1;
    }

            } else {
              Swal.fire('Error!', data.message || 'Something went wrong.', 'error');
            }
          })
          .catch(() => {
            Swal.fire('Error!', 'Failed to communicate with the server.', 'error');
          });
        }
      });
    });
  });
</script>
<!-- end Block User Script -->

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
            <label>Project Name</label>
            <select class="form-control" name="project_name" id="edit-project-name">
              <option value="">Select Project</option>
              <option value="CCI">CCI</option>
              <option value="Frontier">Frontier</option>
            </select>
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
  document.getElementById('edit-project-name').value = user.project_name || '';
          document.getElementById('edit-user-form').action = `/admin/users/update/${user.id}`;

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