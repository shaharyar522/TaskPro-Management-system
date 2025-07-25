@extends('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
<link rel="stylesheet" href="{{asset('css/userpage/showmodal.css')}}">
<style>
    /* Custom spacing for report table columns */
    .custom-report-table th,
    .custom-report-table td {
        padding: 12px 20px;
        /* Increase horizontal and vertical spacing */
        white-space: nowrap;
        /* Prevent line breaks */
    }

    /* Optional: Make sure table is responsive and looks nice */
    .custom-report-table {
        font-size: 14px;
    }

    @media (max-width: 768px) {

        .custom-report-table th,
        .custom-report-table td {
            padding: 10px;
            font-size: 12px;
        }
    }
</style>
<style>
    .filter-section {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 15px;
        margin-bottom: 15px;
    }

    .filter-section .form-label {
        font-size: 0.85rem;
        font-weight: 500;
        color: #333;
    }

    .filter-section .form-control {
        min-width: 180px;
    }

    .download-buttons a {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 6px 12px;
        font-size: 0.9rem;
        border-radius: 6px;
    }

    .download-buttons {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }
</style>
@section('content')
@include('layouts.header')

<div class="dashboard-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">
            <i class="fas fa-user-check me-2"></i>User CCI Task Management Record
        </h2>
    </div>

    <div class="filter-section">


        <!-- User Dropdown Filter -->
        <div class="mb-3">
            <label for="user_filter" class="form-label fw-bold">Select User:</label>
            <select id="user_filter" class="form-select w-auto" onchange="redirectToUser(this)">
                <!-- All Users Option -->
                <option value="{{ route('user.cci') }}" {{ !isset($user) ? 'selected' : '' }}>
                    All Users
                </option>
                @foreach($users as $u)
                <option value="{{ route('cci.show', $u->id) }}" {{ isset($user) && $user->id == $u->id ? 'selected' : ''
                    }}>
                    {{ $u->name }}
                </option>
                @endforeach
            </select>
        </div>

        <script>
            function redirectToUser(select) {
        const url = select.value;
        if (url) window.location.href = url;
    }
        </script>

        {{-- ================================= Start Date Filtering ================================= --}}
        <form action="{{ isset($user) ? route('cci.show', $user->id) : route('user.cci') }}" method="GET"
            class="d-flex gap-3 align-items-end flex-wrap">
            <div>
                <label for="start_date" class="form-label mb-0 small">Start Date</label>
                <input type="date" id="start_date" name="start_date" value="{{ request('start_date') }}"
                    class="form-control form-control-sm">
            </div>
            <div>
                <label for="end_date" class="form-label mb-0 small">End Date</label>
                <input type="date" id="end_date" name="end_date" value="{{ request('end_date') }}"
                    class="form-control form-control-sm">
            </div>
            <div>
                <button type="submit" class="btn btn-sm btn-primary mt-2">🔍 Search</button>
            </div>
            <div>
                <a href="{{ isset($user) ? route('cci.show', $user->id) : route('user.cci') }}"
                    class="btn btn-sm btn-secondary mt-2">Reset Date</a>
            </div>
        </form>

        {{-- ================================= End Date Filtering ================================= --}}

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="downloadDropdownCCI"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-download"></i> Download Records
            </button>
            <ul class="dropdown-menu" aria-labelledby="downloadDropdownCCI">
                <li>
                    <a class="dropdown-item"
                        href="{{ route('admincci.export.excel', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-file-excel text-success"></i> Excel File
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                        href="{{ route('admincci.export.csv', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-file-csv text-info"></i> CSV File
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                        href="{{ route('admincci.export.pdf', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-file-pdf text-danger"></i> PDF File
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                        href="{{ route('user.cci.export.email', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-envelope text-primary"></i> Send Email
                    </a>
                </li>
            </ul>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-bordered custom-report-table">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Address</th>
                    <th>Phone</th>
                    <th>Master Order</th>
                    <th>Job Notes</th>
                    <th>Work Type</th>
                    <th>Unit</th>
                    <th>Qty</th>
                    <th>W2</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Hours</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($CCI as $data)
                <tr>
                    <td>{{ $CCI->firstItem() + $loop->iteration - 1 }}</td>
                    <td>{{ $data->created_at->format('m/d/Y') }}</td>
                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                    <td>{{ $data->user->last_name ?? 'N/A' }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->phone }}</td>
                    <td>{{ $data->master_order }}</td>
                    <td>{{ $data->job_notes }}</td>
                    <td>{{ $data->work_type }}</td>
                    <td>{{ $data->unit }}</td>
                    <td>{{ $data->qty }}</td>
                    <td>{{ $data->w2 }}</td>
                    <td>{{ $data->in }}</td>
                    <td>{{ $data->out }}</td>
                    <td>{{ $data->hours }}</td>
                    <td>
                        <!-- Edit button -->
                        <a href="{{route('admin.cci.edit',$data->id)}}" class="btn btn-sm btn-warning">
                            Edit
                        </a>
                        <!-- Delete form -->
                        <form action="{{route('admin.cci.destroy',$data->id)}}" method="POST"
                            style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center mt-3">
            {{ $CCI->links() }}
        </div>
    </div>
</div>

@if(session('success'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif


<script>
    function calculateHours() {
        const inTime = document.getElementById('in').value;
        const outTime = document.getElementById('out').value;

        if (inTime && outTime) {
            const [inHours, inMinutes] = inTime.split(':').map(Number);
            const [outHours, outMinutes] = outTime.split(':').map(Number);

            const inDate = new Date(0, 0, 0, inHours, inMinutes);
            const outDate = new Date(0, 0, 0, outHours, outMinutes);

            let diff = (outDate - inDate) / (1000 * 60 * 60); // in hours

            // Handle next day
            if (diff < 0) diff += 24;

            document.getElementById('hours').value = diff.toFixed(2);
        }
    }
    document.getElementById('in').addEventListener('change', calculateHours);
    document.getElementById('out').addEventListener('change', calculateHours);
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@push('script')
<script src="{{asset('js/header.js')}}"></script>
@endpush

@endsection