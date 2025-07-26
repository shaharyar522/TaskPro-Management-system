@extends('layouts.app')
@include('layouts.sidebar')
<link rel="stylesheet" href="{{asset('css/userpage/userpage.css')}}">
<link rel="stylesheet" href="{{asset('css/userpage/showmodal.css')}}">
<style>
    /* Main Form Container */
    #cci-form-container {
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        padding: 30px;
        margin: 20px auto;
        border: 1px solid #e0e6ed;
        max-width: 1200px;
    }

    /* Form Title */
    .form-main-title {
        color: #2c3e50;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 30px;
        padding-bottom: 15px;
        border-bottom: 2px solid #3498db;
        position: relative;
        text-align: center;
    }

    /* Form Group Layout */
    .form-vertical-group {
        display: flex;
        flex-direction: column;
        gap: 25px;
    }

    /* Input Groups - 4 columns */
    .form-input-row {
        display: grid;
        grid-template-columns: repeat(4, minmax(0, 1fr));
        gap: 20px;
        align-items: start;
    }

    /* Individual Input Fields */
    .form-field,
    .input-field {
        margin-bottom: 0;
        min-width: 0;
        display: flex;
        flex-direction: column;
    }

    .form-field-label,
    .input-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #2c3e50;
        font-size: 14px;
    }

    /* Form Controls - Equal width for all inputs */
    .form-control {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e0e6ed;
        border-radius: 6px;
        background-color: #f8fafc;
        transition: all 0.3s ease;
        font-size: 14px;
        color: #3c4858;
        height: 42px;
        box-sizing: border-box;
    }

    /* Special styling for date inputs */
    input[type="date"].form-control {
        appearance: none;
        -webkit-appearance: none;
    }

    /* Special styling for time inputs */
    input[type="time"].form-control {
        appearance: none;
        -webkit-appearance: none;
    }
    
    .form-control:focus {
        border-color: #3498db;
        box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        background-color: #ffffff;
        outline: none;
    }

    /* Readonly Fields */
    .form-readonly {
        background-color: #f1f5f9;
        color: #64748b;
        cursor: not-allowed;
    }

    /* Select Dropdowns */
    select.form-control {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='%2364748b' viewBox='0 0 16 16'%3E%3Cpath d='M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 15px center;
        background-size: 12px;
    }

    /* Error Messages */
    .text-danger {
        font-size: 12px;
        color: #ef4444;
        margin-top: 5px;
        display: block;
        font-weight: 500;
    }

    /* Submit Button */
    .form-submit {
        margin-top: 30px;
        text-align: center;
    }

    .btn-primary {
        background-color: #3498db;
        color: white;
        border: none;
        padding: 12px 25px;
        border-radius: 6px;
        font-weight: 600;
        font-size: 15px;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
    }

    .btn-primary:active {
        transform: translateY(0);
    }

    .btn-icon {
        margin-right: 8px;
        font-size: 14px;
    }

    /* Make address and job notes span 2 columns */
    #address-field,
    #job-notes-field {
        grid-column: span 2;
    }

    /* Responsive Adjustments */
    @media (max-width: 1200px) {
        .form-input-row {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
        
        #address-field,
        #job-notes-field {
            grid-column: span 1;
        }
    }

    @media (max-width: 768px) {
        .form-input-row {
            grid-template-columns: minmax(0, 1fr);
        }

        #cci-form-container {
            padding: 20px;
        }

        .form-main-title {
            font-size: 1.3rem;
        }
    }
</style>

@section('content')

@include('layouts.header')

<div id="cci-form-container">
    <h4 class="form-main-title">User Profile Update CCI Information</h4>

    <form method="POST" action="{{ route('admin.cci.update', $userCCI->id) }}" class="form-vertical-group">
        @csrf
        @method('PUT')

        <!-- Personal Information Section -->
        <div class="form-input-row">
            <div class="form-field">
                <label for="created_at" class="form-field-label">Created Date</label>
                <input type="date" id="created_at" name="created_at" class="form-control form-date-input"
                    value="{{ old('created_at', $userCCI->created_at ? $userCCI->created_at->format('Y-m-d') : '') }}">
                @error('created_at') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-field">
                <label for="first_name" class="form-field-label">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control"
                    value="{{ old('first_name', $userCCI->user->name ?? '') }}">
            </div>

            <div class="form-field">
                <label for="last_name" class="form-field-label">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control"
                    value="{{ old('last_name', $userCCI->user->last_name ?? '') }}">
            </div>

            <div class="form-field">
                <label for="phone" class="form-field-label">Phone</label>
                <input type="text" id="phone" name="phone" class="form-control"
                    value="{{ old('phone', $userCCI->phone) }}">
            </div>
        </div>

        <!-- Address and Job Information Section -->
        <div class="form-input-row">
            <div class="form-field">
                <label for="address" class="form-field-label">Address</label>
                <input type="text" id="address" name="address" class="form-control"
                    value="{{ old('address', $userCCI->address) }}">
            </div>

            <div class="form-field">
                <label for="master_order" class="form-field-label">Master Order</label>
                <input type="text" id="master_order" name="master_order" class="form-control"
                    value="{{ old('master_order', $userCCI->master_order) }}">
            </div>

            <div class="form-field">
                <label for="job_notes" class="form-field-label">Job Notes</label>
                <input type="text" id="job_notes" name="job_notes" class="form-control"
                    value="{{ old('job_notes', $userCCI->job_notes) }}">
            </div>
              @php
        $workTypes = WorkType(); // global helper
        @endphp
              <div class="form-field">
                <label for="work_type" class="form-field-label">Work Type</label>
                <select id="work_type" name="work_type" class="form-control form-select-control">
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
        </div>

      

        <!-- Work Information Section -->
        <div class="form-input-row">
            <div class="form-field">
                <label for="unit" class="form-field-label">Unit</label>
                <input type="text" id="unit" name="unit" class="form-control form-readonly"
                    value="{{ old('unit', $userCCI->unit) }}" readonly>
            </div>

            <div class="form-field">
                <label for="qty" class="form-field-label">Qty</label>
                <input type="number" id="qty" name="qty" class="form-control"
                    value="{{ old('qty', $userCCI->qty) }}">
            </div>

            <div class="form-field">
                <label for="w2" class="form-field-label">W2</label>
                <input type="text" id="w2" name="w2" class="form-control form-readonly"
                    value="{{ old('w2', $userCCI->w2) }}" readonly>
            </div>
            <div class="form-field">
                <label for="in" class="form-field-label">In</label>
                <input type="time" id="in" name="in" class="form-control form-time-input"
                    value="{{ old('in', $userCCI->in) }}">
                @error('in') <small class="text-danger">{{ $message }}</small> @enderror
            </div>
        </div>

        <!-- Time Tracking Section -->
        <div class="form-input-row">
            

            <div class="form-field">
                <label for="out" class="form-field-label">Out</label>
                <input type="time" id="out" name="out" class="form-control form-time-input"
                    value="{{ old('out',$userCCI->out) }}">
                @error('out') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <div class="form-field">
                <label for="hours" class="form-field-label">Hours</label>
                <input type="number" id="hours" name="hours" class="form-control form-readonly"
                    value="{{ old('out',$userCCI->hours) }}" step="0.1" readonly>
                @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
            </div>

            <input type="hidden" id="user_id" name="user_id" value="{{ $userCCI->user_id }}">
        </div>

        <div class="form-submit">
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save btn-icon"></i> Update Information
            </button>
        </div>
    </form>
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