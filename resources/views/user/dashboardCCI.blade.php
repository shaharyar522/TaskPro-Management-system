@extends('user.layouts.layoutsUser')

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



@section('content')

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
                <a href="#" class="dropdown-item">
                    <i class="fas fa-user"></i> Profile
                </a>
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


<div id="form-section">

    <div class="card mt-4 profile-form-container">
        <h4 class="mb-4 text-primary">User Profile CCI Information </h4>

        <form method="POST" action="{{route('usercci.store')}}" id="user-data-form">
            @csrf
            {{-- <input type="hidden" name="id" id="edit-id">
            <input type="hidden" name="_method" value="POST" id="form-method"> --}}

            <div class="form-group-vertical">
                <!-- First Row -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control" placeholder="Enter Phone"
                            value="{{ old('phone') }}">
                        @error('phone') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Address / City</label>
                        <input type="text" name="address" id="address" class="form-control"
                            placeholder="Enter Address or City" value="{{ old('address') }}">
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Master Order #</label>
                        <input type="text" name="master_order" id="master_order" class="form-control"
                            placeholder="Enter Master Order #" value="{{ old('master_order') }}">
                        @error('master_order') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Job Notes</label>
                        <input type="text" name="job_notes" id="job_notes" class="form-control"
                            placeholder="Enter Job Notes" value="{{ old('job_notes') }}">
                        @error('job_notes') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>


                <!-- Second Row -->

                <div class="input-group">

                    @php
                    $workTypes = WorkType(); // global helper
                    @endphp

                    <div class="input-field">
                        <label class="input-label">Work Type</label>
                        <select name="work_type" id="work_type" class="form-control">
                            <option value="">-- Select Work Type --</option>
                            @foreach($workTypes as $code => $data)
                            <option value="{{ $code }}" data-unit="{{ $data['unit'] ?? '' }}"
                                data-w2="{{ $data['w2'] ?? '' }}" {{ old('work_type')==$code ? 'selected' : '' }}>
                                {{ $code }}
                            </option>
                            @endforeach
                        </select>
                        @error('work_type') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Unit</label>
                        <input type="text" name="unit" id="unit" class="form-control" placeholder="Enter Unit"
                            value="{{ old('unit') }}" readonly>
                        @error('unit') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Qty</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter Quantity"
                            value="{{ old('qty') }}">
                        @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">W2</label>
                        <input type="text" name="w2" id="w2" class="form-control" placeholder="Enter W2"
                            value="{{ old('w2') }}" readonly>
                        @error('w2') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Third Row -->
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

                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                </div>
            </div>

            <div class="form-submit">
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i> <span id="form-button-text">Save Information</span>
                </button>
            </div>
        </form>


    </div>

</div>

{{-- end forom show --}}
<div class="card mt-4 profile-form-container">
    <div id="report-section" style="display: none;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary">User Report CCI Information</h4>

            <form action="{{route('user.dashboardCCI')}}" method="GET" class="d-flex gap-2 align-items-center">
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
                <div class="mt-4">
                    <button type="submit" class="btn btn-sm btn-primary">Search</button>
                </div>
                <div class="mt-4">
                    <a href="{{ route('user.dashboardCCI') }}" class="btn btn-sm btn-secondary">Reset Date</a>
                </div>
            </form>


            <div class="d-flex gap-2">
                <a href="{{ route('usercci.export.excel') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i>📄 Download Excel File
                </a>

                <a href="{{ route('usercci.export.csv') }}" class="btn btn-secondary">
                    <i class="fas fa-file-csv"></i> 📄 Download CSV File
                </a>
                <a href="{{ route('usercci.export.pdf') }}" class="btn btn-danger">
                    📄 Download PDF File
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
                    @foreach($userCCI as $data)
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
                            <a href="{{route('usercci.edit',$data->id)}}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <!-- Delete form -->
                            <form action="{{route('usercci.destroy',$data->id)}}" method="POST"
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
                {{ $userCCI->links() }}
            </div>
        </div>

    </div>
</div>



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

<script>
    function editUserData(userData) {
        const form = document.getElementById('user-data-form');
        const methodInput = document.getElementById('form-method');
        const idInput = document.getElementById('edit-id');
        const submitText = document.getElementById('form-button-text');

        // Set form action to update route
        form.action = `/userdata/${userData.id}`; // OR use route helper if you pass it via blade
        methodInput.value = 'PUT'; // Override POST with PUT
        idInput.value = userData.id;

        // Change button text
        submitText.innerText = 'Update Information';

        // Now populate all fields
        document.getElementById('corp_id').value = userData.corp_id ?? '';
        document.getElementById('address').value = userData.address ?? '';
        document.getElementById('billing_TN').value = userData.billing_TN ?? '';
        document.getElementById('order_number').value = userData.order_number ?? '';
        document.getElementById('install_T_T_Soc_TTC').value = userData.install_T_T_Soc_TTC ?? '';
        document.getElementById('ont_Ntd').value = userData.ont_Ntd ?? '';
        document.getElementById('comp_or_refer').value = userData.comp_or_refer ?? '';
        document.getElementById('billing_code').value = userData.billing_code ?? '';
        document.getElementById('qty').value = userData.qty ?? '';
        document.getElementById('description').value = userData.description ?? '';
        document.getElementById('rate').value = userData.rate ?? '';
        document.getElementById('total_billed').value = userData.total_billed ?? '';
        document.getElementById('aerial_buried').value = userData.aerial_buried ?? '';
        document.getElementById('fiber').value = userData.fiber ?? '';
        document.getElementById('closeout_notes').value = userData.closeout_notes ?? '';
        document.getElementById('in').value = userData.in ?? '';
        document.getElementById('out').value = userData.out ?? '';
        document.getElementById('hours').value = userData.hours ?? '';
    }
</script>

{{-- for js pagintaion --}}
<script>
    function showSection(sectionId) {
        document.getElementById('form-section').style.display = 'none';
        document.getElementById('report-section').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Check if user manually searched
        @if(request()->filled('start_date') || request()->filled('end_date'))
            showSection('report-section');
        @else
            showSection('form-section');
        @endif
    });
</script>




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