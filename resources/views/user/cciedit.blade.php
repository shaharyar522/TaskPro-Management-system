@extends('user.layouts.layoutsUser')
<header class="dashboard-header">
    <div class="header-left">
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <h1 class="header-title" onclick="showSection('form-section')">Dashboard</h1>
        <h1 class="header-title" onclick="showSection('report-section')">Report</h1>

    </div>
    <div class="header-right">
        <div class="user-dropdown">
            <div class="user-profile">
                <img src="https://media.istockphoto.com/id/1321387967/vector/concept-of-project-closure-project-managment-life-cycle-3d-vector-illustration.jpg?s=612x612&w=0&k=20&c=ZLW7FtbJVoEZMvgErFn4ALa8wXntkEtLqCmPSiydN6c=" alt="User" class="user-avatar">
             
                <i class="fas fa-chevron-down"></i>
            </div>
            <div class="dropdown-menu">
               
                <a href="#" class="dropdown-item"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</header>
@section('content')

<div>
    <div class="card mt-4 profile-form-container">
        <h4 class="mb-4 text-primary">User Profile Update Frontier Information </h4>


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

{{-- time in and out  --}}
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