@extends('user.layouts.layoutsUser')

@section('content')
<header class="dashboard-header">
    <div class="header-left">
        <!-- Dashboard and Report Titles (aligned to the left) -->
        <h1 class="header-title" onclick="window.location.href='{{ route('user.dashboardCCI') }}'">Dashboard</h1>

    </div>

    <div class="header-right">
        <!-- Logout button with text inside -->
        <button class="logout-button"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="fas fa-sign-out-alt"></i><br>
            <span class="logout-text">Logout</span>
        </button>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>
</header>


<style>
    /* Global Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
    }

    /* Dashboard Header */
    .dashboard-header {
        background-color: #ffffff;
        padding: 0 20px;
        height: 70px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    /* Header Left */
    .header-left {
        display: flex;
        justify-content: flex-start;
        gap: 30px;
        flex: 1;
    }

    .header-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #4e73df;
        margin: 0;
        cursor: pointer;
        text-overflow: ellipsis;
        white-space: nowrap;
        overflow: hidden;
    }

    /* Header Right (Logout Button) */
    .header-right {
        display: flex;
        justify-content: flex-end;
        align-items: center;
        position: relative;
    }

    /* Logout button styling */
    .logout-button {
        background: none;
        border: none;
        color: #333;
        font-size: 14px;
        cursor: pointer;
        text-align: center;
        flex-direction: column;
        align-items: center;
    }

    .logout-button i {
        font-size: 1.5rem;
    }

    .logout-text {
        font-size: 0.8rem;
        color: #6c757d;
        display: block;
    }

    /* Hover effect for Logout button */
    .logout-button:hover {
        color: #224abe;
    }

    .logout-button:hover i {
        transform: scale(1.1);
    }

    /* Responsive Styles */

    /* Extra small devices (phones, less than 576px) */
    @media (max-width: 576px) {
        .dashboard-header {
            flex-direction: row;
            /* Keep layout as row to avoid stacking */
            padding: 0 10px;
            height: 70px;
            /* Maintain height */
        }

        .form-group-vertical input {
            width: 100% !important;
        }

        .header-left {
            flex: 1;
            justify-content: flex-start;
        }

        .header-title {
            font-size: 1.1rem;
        }

        .header-right {
            display: flex;
            justify-content: flex-end;
            /* Ensure logout button is on the right */
            align-items: center;
            gap: 12px;
            /* Maintain space between elements */
            width: auto;
            /* Avoid taking full width */
            margin-left: auto;
            /* Push logout to the right */
        }

        .logout-button {
            align-items: center;
            /* Center align text and icon */
            text-align: right;
            /*display: inline-flex; */
            margin-top: 0;
            /* Remove any margin */
            padding: 0;
            /* Ensure no extra padding */
        }

        .logout-text {
            font-size: 0.75rem;
        }
    }

    /* Additional Styles for other screen sizes */
    @media (max-width: 768px) {
        .dashboard-header {
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            padding: 0 10px;
        }

        .header-left {
            flex: 1;
            justify-content: flex-start;
        }

        .header-right {
            flex-shrink: 0;
            justify-content: flex-end;
        }

        .header-title {
            font-size: 1.1rem;
        }

        .logout-button {
            font-size: 1rem;
            width: 100%;
        }
    }

    @media (max-width: 992px) {
        .header-left {
            gap: 20px;
        }

        .header-title {
            font-size: 1.3rem;
        }

        .logout-button {
            font-size: 1rem;
        }
    }

    @media (max-width: 1200px) {
        .header-left {
            gap: 20px;
        }

        .header-title {
            font-size: 1.3rem;
        }

        .logout-button {
            font-size: 1rem;
        }
    }

    @media (min-width: 1200px) {
        .header-left {
            gap: 30px;
        }

        .header-title {
            font-size: 1.5rem;
        }

        .logout-button {
            font-size: 1.2rem;
        }
    }
</style>


<div>
    <div class="card mt-4 profile-form-container">
        <h4 class="mb-4 text-primary"> Update CCI Information </h4>


        <form method="POST" action="{{ route('usercci.update', $userCCI->id) }}">
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
                    <input type="time" name="in" id="in" class="form-control" value="{{ old('in',$userCCI->in) }}">
                    @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="input-field">
                    <label class="input-label">Out</label>
                    <input type="time" name="out" id="out" class="form-control" value="{{ old('out',$userCCI->out) }}">
                    @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <div class="input-field">
                    <label class="input-label">Hours</label>
                    <input type="number" name="hours" id="hours" value="{{ old('out',$userCCI->hours) }}"
                        class="form-control" step="0.1" readonly>
                    @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
                </div>

                <input type="hidden" name="user_id" value="{{ $userCCI->user_id }}">

                  <div class="form-submit text-end">
    <button type="submit" class="btn btn-primary px-4">
        Update Information
    </button>
</div>
            </div>






    </div>
    </form>
</div>
</div>

@if(session('redirect_to_report'))
<script>
    window.onload = function () {
            // ðŸ‘‡ this line is same as if you clicked the Report tab manually
            showSection('report-section');

            // âœ… Show SweetAlert
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
    document.addEventListener("DOMContentLoaded", function () {
        const userDropdown = document.querySelector(".user-dropdown");

        if (userDropdown) {
            userDropdown.addEventListener("click", function (e) {
                e.stopPropagation(); // Prevent clicking from bubbling
                userDropdown.classList.toggle("active");
            });

            // Hide dropdown when clicking outside
            document.addEventListener("click", function () {
                userDropdown.classList.remove("active");
            });
        }
    });
</script>

{{-- time in and out --}}
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