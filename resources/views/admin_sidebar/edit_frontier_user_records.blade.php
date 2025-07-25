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
        <h4 class="mb-4 text-primary">User Profile Update Frontier Information </h4>

        <form method="POST" action="{{ route('admin.frontier.update', $userdata->id) }}">
            @csrf
            @method('PUT')
            <div class="form-group-vertical">
                <!-- First Group of 4 Inputs -->
                <div class="input-group">
                    <!-- New Fields -->
                    <div class="input-group">
                        <div class="input-field">
                            <label class="input-label">Created Date</label>
                            <input type="date" name="created_at" class="form-control"
                                value="{{ old('created_at', $userdata->created_at ? $userdata->created_at->format('Y-m-d') : '') }}">
                            @error('created_at') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                      <div class="input-field">
            <label class="input-label">First Name</label>
            <input type="text" name="first_name" class="form-control"
                   value="{{ old('first_name', $userdata->user->name ?? '') }}">
        </div>

        <div class="input-field">
            <label class="input-label">Last Name</label>
            <input type="text" name="last_name" class="form-control"
                   value="{{ old('last_name', $userdata->user->last_name ?? '') }}">
        </div>
                    </div>

                    <div class="input-field">
                        <label class="input-label">Corp ID</label>
                        <input type="text" name="corp_id" class="form-control" placeholder="Enter Corp ID"
                            value="{{ old('corp_id', $userdata->corp_id) }}">
                        @error('corp_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Address</label>
                        <input type="text" name="address" class="form-control" placeholder="Enter Address"
                            value="{{ old('address', $userdata->address) }}">
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Billing TN</label>
                        <input type="text" name="billing_TN" class="form-control" placeholder="Enter Billing TN"
                            value="{{ old('billing_TN', $userdata->billing_TN) }}">
                        @error('billing_TN') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Order Number</label>
                        <input type="text" name="order_number" class="form-control" placeholder="Enter Order Number"
                            value="{{ old('order_number', $userdata->order_number) }}">
                        @error('order_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Second Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Install T.T. Soc TTC</label>
                        <input type="text" name="install_T_T_Soc_TTC" class="form-control"
                            placeholder="Enter Install T.T. Soc TTC"
                            value="{{ old('install_T_T_Soc_TTC', $userdata->install_T_T_Soc_TTC) }}">
                        @error('install_T_T_Soc_TTC') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">ONT NTD</label>
                        <input type="text" name="ont_Ntd" class="form-control" placeholder="Enter ONT NTD"
                            value="{{ old('ont_Ntd', $userdata->ont_Ntd) }}">
                        @error('ont_Ntd') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Comp or Refer</label>
                        <input type="text" name="comp_or_refer" class="form-control" placeholder="Enter Comp or Refer"
                            value="{{ old('comp_or_refer', $userdata->comp_or_refer) }}">
                        @error('comp_or_refer') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    @php
                    $codes = billingCodes();
                    @endphp

                    <div class="input-field">
                        <label class="input-label">Billing Code</label>
                        <select name="billing_code" id="billing_code" class="form-control">
                            <option value="">-- Select Billing Code --</option>
                            @foreach($codes as $code => $data)
                            <option value="{{ $code }}" {{ old('billing_code')==$code ? 'selected' : '' }}>
                                {{ $code }}
                            </option>
                            @endforeach
                        </select>
                        @error('billing_code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Third Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Quantity</label>
                        <input type="number" name="qty" class="form-control" placeholder="Enter Quantity"
                            value="{{ old('qty', $userdata->qty) }}">
                        @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control"
                            placeholder="Enter Description" value="{{ old('description') }}" readonly>
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Rate</label>
                        <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter Rate"
                            value="{{ old('rate') }}" readonly>
                        @error('rate') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Total Billed</label>
                        <input type="text" name="total_billed" id="total_billed" class="form-control"
                            placeholder="Enter Total Billed" value="{{ old('total_billed') }}" readonly>
                        @error('total_billed') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Fourth Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Aerial Buried</label>
                        <input type="text" name="aerial_buried" class="form-control" placeholder="Enter Aerial Buried"
                            value="{{ old('aerial_buried', $userdata->aerial_buried) }}">
                        @error('aerial_buried') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Fiber</label>
                        <input type="text" name="fiber" class="form-control" placeholder="Enter Fiber"
                            value="{{ old('fiber', $userdata->fiber) }}">
                        @error('fiber') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Closeout Notes</label>
                        <input type="text" name="closeout_notes" class="form-control" placeholder="Enter Closeout Notes"
                            value="{{ old('closeout_notes', $userdata->closeout_notes) }}">
                        @error('closeout_notes') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">In</label>
                        <input type="time" name="in" id="in" class="form-control" value="{{ old('in') }}">
                        @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                </div>
                <!-- Fifth Group (remaining fields) -->
                <div class="input-group">

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
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
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
    const billingData = @json(billingCodes());

    document.getElementById('billing_code').addEventListener('change', function () {
        const selected = this.value;
        const data = billingData[selected];

        if (data) {
            document.getElementById('description').value = data.description;
            document.getElementById('rate').value = data.rate;
            document.getElementById('total_billed').value = data.rate;
        } else {
            document.getElementById('description').value = '';
            document.getElementById('rate').value = '';
            document.getElementById('total_billed').value = '';
        }
    });

    // Trigger on load (if user selected something before error)
    window.addEventListener('DOMContentLoaded', () => {
        document.getElementById('billing_code').dispatchEvent(new Event('change'));
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