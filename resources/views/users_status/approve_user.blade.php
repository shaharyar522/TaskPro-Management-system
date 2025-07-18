@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
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
          <th>Registration Date</th>
          <th>Email</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        @foreach($approved  as $user)
          <tr id="user-row-{{ $user->id }}">
            <td>{{ $user->id }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->last_name }}</td>
            <td>{{ $user->copy_id }}</td>
            <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</td>
            <td>{{ $user->email }}</td>
            <td><span class="badge bg-success">Approved</span></td>
            <td>
              <button class="btn btn-sm btn-danger block-user-btn" data-id="{{ $user->id }}">
                <i class="fas fa-ban"></i>
              </button>
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


@endsection
