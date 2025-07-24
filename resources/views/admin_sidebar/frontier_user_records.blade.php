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
            <i class="fas fa-user-check me-2"></i>User Frontier Task Management Record
        </h2>
    </div>

    <div class="filter-section">
        <form action="{{route('user.frontier')}}" method="GET" class="d-flex gap-3 align-items-end flex-wrap">
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
                <button type="submit" class="btn btn-sm btn-primary mt-2">
                    🔍 Search
                </button>
            </div>
           <div>
                <a href="{{ route('user.frontier') }}" class="btn btn-sm btn-secondary mt-2">Reset Date</a>
            </div> 
        </form>

        <!-- Download Buttons -->
        <div class="download-buttons">
            <a href="{{ route('adminfrontier.export.excel') }}" class="btn btn-success">
                <i class="fas fa-file-excel"></i>📄 Download Excel File
            </a>

            <a href="{{ route('adminfrontier.export.csv') }}" class="btn btn-secondary">
                <i class="fas fa-file-csv"></i> 📄 Download CSV File
            </a>

            <a href="{{ route('adminfrontier.export.pdf') }}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> 📄 Download PDF File
            </a>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-bordered custom-report-table">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
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
                    <td>{{ $loop->iteration }}</td>
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
                            <!-- Edit button -->
                            <a href="{{route('admin.frontier.edit',$data->id)}}" class="btn btn-sm btn-warning">
                                Edit
                            </a>
                            <!-- Delete form -->
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
            </tr>
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

@endsection