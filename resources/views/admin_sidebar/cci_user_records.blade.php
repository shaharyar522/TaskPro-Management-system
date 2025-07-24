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
        
        <form action="" method="GET" class="d-flex gap-3 align-items-end flex-wrap">
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
                <a href="" class="btn btn-sm btn-secondary mt-2">Reset Date</a>
            </div>
        </form>

        <!-- Download Buttons -->
        <div class="download-buttons">
            <a href="{{route('admincci.export.excel')}}" class="btn btn-success">
                <i class="fas fa-file-excel"></i>📄 Download Excel File
            </a>

            <a href="{{route('admincci.export.csv')}}" class="btn btn-secondary">
                <i class="fas fa-file-csv"></i> 📄 Download CSV File
            </a>

            <a href="{{route('admincci.export.pdf')}}" class="btn btn-danger">
                <i class="fas fa-file-pdf"></i> 📄 Download PDF File
            </a>
        </div>
    </div>


    <div class="table-responsive">
        <table class="table table-striped table-bordered custom-report-table">
            <thead class="table-primary">
                <tr>
                    <th>ID</th>
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
                    <td>{{ $loop->iteration}}</td>
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
                        <form action="{{route('admin.cci.destroy',$data->id)}}" method="POST" style="display:inline-block;">
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

@endsection