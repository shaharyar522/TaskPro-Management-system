@extends('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
<link rel="stylesheet" href="{{asset('css/userpage/showmodal.css')}}">
<link rel="stylesheet" href="{{asset('css/SidebarFrontier/table.css')}}">


@section('content')
@include('layouts.header')
<link rel="stylesheet" href="{{asset('css/SidebarFrontier/button.css')}}">
<div class="dashboard-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="section-title">
            <i class="fas fa-user-check me-2"></i>User Frontier Task Management Record
        </h2>
    </div>

    <div class="filter-section">


        <!-- User Dropdown Filter -->
        <div class="mb-3">
            <label for="user_filter" class="form-label fw-bold">Select User:</label>
            <select id="user_filter" class="form-select w-auto" onchange="redirectToUser(this)">
                <!-- All Users Option -->
                <option value="{{ route('user.frontier') }}" {{ !isset($user) ? 'selected' : '' }}>
                    All Users
                </option>
                @foreach($users as $u)
                <option value="{{ route('frontier.show', $u->id) }}" {{ isset($user) && $user->id == $u->id ? 'selected'
                    : '' }}>
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

        {{-- =================================Start Searching start the and ending Date
        ================================= --}}
        <form action="{{ isset($user) ? route('frontier.show', $user->id) : route('user.frontier') }}" method="GET"
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
                <button type="submit" class="btn btn-sm btn-search mt-2">
                    <i class="fas fa-search"></i> Search
                </button>
            </div>
            <div>
                <a href="{{ isset($user) ? route('frontier.show', $user->id) : route('user.frontier') }}"
                    class="btn btn-sm btn-reset mt-2">
                    <i class="fas fa-undo"></i> Reset Date
                </a>
            </div>
        </form>


        <form action="{{ route('frontier.sendMail') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ isset($user) ? $user->id : '' }}">
            <button type="submit" class="btn btn-send-mail">
                <i class="fas fa-envelope"></i> Send Mail
            </button>
        </form>




        {{-- ================================= End Start Searching start the and ending Date
        ================================= --}}



        <!-- Download Buttons -->

        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="downloadDropdown"
                data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fas fa-download"></i> Download Records
            </button>

            <ul class="dropdown-menu" aria-labelledby="downloadDropdown">
                <li>
                    <a class="dropdown-item"
                        href="{{ route('adminfrontier.export.excel', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-file-excel text-success"></i> Excel File
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                        href="{{ route('adminfrontier.export.csv', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-file-csv text-secondary"></i> CSV File
                    </a>
                </li>
                <li>
                    <a class="dropdown-item"
                        href="{{ route('adminfrontier.export.pdf', array_merge(request()->all(), ['user_id' => isset($user) ? $user->id : null])) }}">
                        <i class="fas fa-file-pdf text-danger"></i> PDF File
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
                    <th>Corp ID</th>
                    <th>Address</th>
                    <th>Billing TN</th>
                    <th>Order Number</th>
                    <th>Install T.T. Soc TTC</th>
                    <th>ONT NTD</th>
                    <th>Comp/Refer</th>
                    <th>Billing Code</th>
                    <th>Qty</th>
                    <th>Description</th>
                    <th>Rate</th>
                    <th>Total Billed</th>
                    <th>Aerial Buried</th>
                    <th>Fiber</th>
                    <th>Closeout Notes</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Hours</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($frontiers as $data)
                <tr>
                    <td>{{ $frontiers->firstItem() + $loop->iteration - 1 }}</td>
                    <td>{{ $data->created_at->format('m/d/Y') }}</td>
                    <td>{{ $data->user->name ?? 'N/A' }}</td>
                    <td>{{ $data->user->last_name ?? 'N/A' }}</td>
                    <td>{{ $data->corp_id }}</td>
                    <td>{{ $data->address }}</td>
                    <td>{{ $data->billing_TN }}</td>
                    <td>{{ $data->order_number }}</td>
                    <td>{{ $data->install_T_T_Soc_TTC }}</td>
                    <td>{{ $data->ont_Ntd }}</td>
                    <td>{{ $data->comp_or_refer }}</td>
                    <td>{{ $data->billing_code }}</td>
                    <td>{{ $data->qty }}</td>
                    <td>{{ $data->description }}</td>
                    <td>{{ $data->rate }}</td>
                    <td>{{ $data->total_billed }}</td>
                    <td>{{ $data->aerial_buried }}</td>
                    <td>{{ $data->fiber }}</td>
                    <td>{{ $data->closeout_notes }}</td>
                    <td>{{ $data->in }}</td>
                    <td>{{ $data->out }}</td>
                    <td>{{ $data->hours }}</td>
                    <td>
                        <div class="d-flex align-items-center gap-2">
                            <a href="{{route('admin.frontier.edit',$data->id)}}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{route('admin.frontier.destroy',$data->id)}}" method="POST" class="m-0">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="pagination justify-content-center mt-3">
            {{ $frontiers->links() }}
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
    function showSection(sectionId) {
        document.getElementById('form-section').style.display = 'none';
        document.getElementById('report-section').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';
    }

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function () {
        @if(request()->has('page') || request()->has('start_date') || request()->has('end_date'))
            showSection('report-section');
        @else
            showSection('form-section');
        @endif
    });
</script>

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



@if(session('message'))
<script>
    Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('message') }}',
            confirmButtonColor: '#3085d6'
        });
</script>
@endif


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@push('script')
<script src="{{asset('js/header.js')}}"></script>
@endpush
@endsection