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
    /* Main container styling */
    .profile-form-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin-bottom: 30px;
    }

    /* Form header styling */
    .profile-form-container h4 {
        color: #2c3e50;
        font-weight: 600;
        border-bottom: 2px solid #3498db;
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    /* Input group container */
    .form-group-vertical {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* Each row of inputs */
    .input-group {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 20px;
    }

    /* Responsive adjustment for smaller screens */
    @media (max-width: 1200px) {
        .input-group {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 768px) {
        .input-group {
            grid-template-columns: 1fr;
        }
    }

    /* Input field styling */
    .input-field {
        margin-bottom: 0;
    }
 
    .input-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #34495e;
        font-size: 14px;
    }

    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #dfe6e9;
        border-radius: 6px;
        background-color: #f8f9fa;
        transition: all 0.3s ease;
        font-size: 14px;
    }

    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        background-color: #ffffff;
    }

    /* Readonly fields styling */
    .form-control[readonly] {
        background-color: #ecf0f1;
        color: #7f8c8d;
    }

    /* Error message styling */
    .text-danger {
        font-size: 12px;
        margin-top: 5px;
        display: block;
    }

    /* Submit button styling */
    .form-submit {
        margin-top: 30px;
        text-align: right;
    }

    .btn-primary {
        background-color: #3498db;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-weight: 500;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    /* Select dropdown styling */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%23333' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 12px;
    }

    /* Custom spacing for report table columns */
    .custom-report-table th,
    .custom-report-table td {
        padding: 12px 20px;
        white-space: nowrap;
    }

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
@section('content')
@include('layouts.header') 


<div>
    <div class="card mt-4 profile-form-container">
        <h4 class="mb-4 text-primary">User Profile Update CCI Information </h4>
        
          <form method="POST" action="{{ route('admin.cci.update', $userCCI->id) }}">
            @csrf
            @method('PUT')

            <div class="input-group">
                <div class="input-field">
                    <label class="input-label">Phone</label>
                    <input type="text" name="phone" id="phone" class="form-control"
                        value="{{ old('phone', $userCCI->phone) }}">
                </div>

                <div class="input-field">
                    <label class="input-label">Address</label>
                    <input type="text" name="address" id="address" class="form-control"
                        value="{{ old('address', $userCCI->address) }}">
                </div>

                <div class="input-field">
                    <label class="input-label">Master Order</label>
                    <input type="text" name="master_order" class="form-control"
                        value="{{ old('master_order', $userCCI->master_order) }}">
                </div>

                <div class="input-field">
                    <label class="input-label">Job Notes</label>
                    <input type="text" name="job_notes" class="form-control"
                        value="{{ old('job_notes', $userCCI->job_notes) }}">
                </div>
            </div>
            @php
            $workTypes = WorkType(); // global helper
            @endphp

            <div class="input-group">
                <div class="input-field">
                    <label class="input-label">Work Type</label>
                    <select name="work_type" id="work_type" class="form-control">
                        <option value="">-- Select Work Type --</option>
                        @foreach($workTypes as $code => $data)
                        <option value="{{ $code }}" data-unit="{{ $data['unit'] ?? '' }}"
                            data-w2="{{ $data['w2'] ?? '' }}" {{ old('work_type', $userCCI->work_type) == $code ?
                            'selected' : '' }}>
                            {{ $code }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="input-field">
                    <label class="input-label">Unit</label>
                    <input type="text" name="unit" id="unit" class="form-control"
                        value="{{ old('unit', $userCCI->unit) }}" readonly>
                </div>

                <div class="input-field">
                    <label class="input-label">Qty</label>
                    <input type="number" name="qty" class="form-control" value="{{ old('qty', $userCCI->qty) }}">
                </div>

                <div class="input-field">
                    <label class="input-label">W2</label>
                    <input type="text" name="w2" id="w2" class="form-control" value="{{ old('w2', $userCCI->w2) }}"
                        readonly>
                </div>
            </div>

            <div class="input-group">
                <div class="input-field">
                    <label class="input-label">In</label>
                    <input type="time" name="in" id="in" class="form-control" value="{{ old('in') }}">
                    @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="input-field">
                    <label class="input-label">Out</label>
                    <input type="time" name="out" id="out" class="form-control" value="{{ old('out') }}">
                    @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="input-field">
                    <label class="input-label">Hours</label>
                    <input type="number" name="hours" id="hours" class="form-control" step="0.1" readonly>
                    @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <input type="hidden" name="user_id" value="{{ $userCCI->user_id }}">
            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> Update Information
                </button>
            </div>
        </form>
    </div>

</div>

@if(session('redirect_to_report'))
<script>
    window.onload = function () {
            // 👇 this line is same as if you clicked the Report tab manually
            showSection('report-section');

            // ✅ Show SweetAlert
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('update_success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        };
</script>
@endif

<script>
    const workTypeData = @json(WorkType());

    document.getElementById('work_type').addEventListener('change', function () {
        const selected = this.value;
        const data = workTypeData[selected];

        if (data) {
            document.getElementById('unit').value = data.unit ?? '';
            document.getElementById('w2').value = data.w2 ?? '';
        } else {
            document.getElementById('unit').value = '';
            document.getElementById('w2').value = '';
        }
    });

    // Auto-trigger on page load to restore values after validation error
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('work_type').dispatchEvent(new Event('change'));
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
@endsection