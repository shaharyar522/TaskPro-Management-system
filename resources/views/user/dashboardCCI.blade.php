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

<link rel="stylesheet" href="{{asset('css/userdashbord/button.css')}}">

@section('content')

<!--<header class="dashboard-header">-->
<!--    <div class="header-left">-->

<!--        <h1 class="header-title" onclick="showSection('form-section')">Dashboard</h1>-->
<!--        <h1 class="header-title" onclick="showSection('report-section')">Report</h1>-->

<!--    </div>-->
<!--    <div class="header-right">-->
<!--        <div class="user-dropdown">-->
<!--            <div class="user-profile">-->
<!--                <img src="https://media.istockphoto.com/id/1321387967/vector/concept-of-project-closure-project-managment-life-cycle-3d-vector-illustration.jpg?s=612x612&w=0&k=20&c=ZLW7FtbJVoEZMvgErFn4ALa8wXntkEtLqCmPSiydN6c="-->
<!--                    alt="User" class="user-avatar">-->

<!--                <i class="fas fa-chevron-down"></i>-->
<!--            </div>-->
<!--            <div class="dropdown-menu">-->
<!--                <a href="#" class="dropdown-item"-->
<!--                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">-->
<!--                    <i class="fas fa-sign-out-alt"></i> Logout-->
<!--                </a>-->
<!--                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">-->
<!--                    @csrf-->
<!--                </form>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</header>-->

<header class="dashboard-header">
    <div class="header-left">
        <!-- Dashboard and Report Titles (aligned to the left) -->
        <h1 class="header-title" onclick="showSection('form-section')">Dashboard</h1>
        <h1 class="header-title" onclick="showSection('report-section')">Report</h1>
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

    @media (max-width: 576px) {
        .profile-form-container form.d-flex {
            flex-direction: column;
            align-items: stretch;
        }

        .profile-form-container .mt-4,
        .profile-form-container .form-control-sm,
        .profile-form-container .btn,
        .profile-form-container .btn-send-mail {
            width: 100% !important;
        }

        .profile-form-container .d-flex.gap-2 {
            flex-direction: column;
            align-items: stretch;
            gap: 0.5rem;
        }

        .profile-form-container table {
            font-size: 12px;
        }
    }


    /* Action buttons container */
    .action-cell .action-wrapper {
        display: flex;
        gap: 6px;
    }

    /* Responsive: stack buttons vertically on small screens */
    @media (max-width: 576px) {
        .action-cell .action-wrapper {
            flex-direction: column;
            align-items: stretch;
        }

        .action-cell .btn {
            font-size: 12px;
            padding: 6px 8px;
            width: 100%;
        }
    }
</style>


<div id="form-section">

    <div class="card mt-4 profile-form-container">
        <h4 class="mb-4 text-primary">Enter Your CCI Information </h4>

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
                    <div class="form-submit text-end">
                        <button type="submit" class="btn btn-primary px-4">
                            Save Information
                        </button>
                    </div>
                </div>
            </div>



        </form>


    </div>

</div>

{{-- end forom show --}}

<div class="card mt-4 profile-form-container">
    <div id="report-section" style="display: none;">
        <div class="d-flex flex-wrap gap-3 justify-content-between align-items-start mb-4">

        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="text-primary"> CCI Information Details</h4>

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
                    <a href="{{ route('user.dashboardCCI') }}" class="btn btn-sm"
                        style="background-color: #bb2d3b; color: white; border: none;"
                        onmouseover="this.style.backgroundColor='#a12733'"
                        onmouseout="this.style.backgroundColor='#bb2d3b'">
                        Reset Date
                    </a>
                </div>

            </form>

            <div class="d-flex gap-2">
                <form action="{{route('user.cci.send.excel')}}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="">
                    <button type="submit" class="btn-send-mail">
                        <i class="fas fa-envelope"></i> Send Mail
                    </button>
                </form>
                <a href="{{ route('usercci.export.excel') }}" class="btn btn-success">
                    </i> Download Excel File
                </a>

                <a href="{{ route('usercci.export.csv') }}" class="btn btn-secondary">
                    </i> Download CSV File
                </a>

                <a href="{{route('usercci.export.pdf')}}" class="btn btn-danger">
                    Download PDF File
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
                        <td class="action-cell">
                            <div class="action-wrapper">
                                <!-- Edit button -->
                                <a href="{{ route('usercci.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>

                                <!-- Delete form -->
                                <form id="delete-form-{{ $data->id }}"
                                    action="{{ route('usercci.destroy', $data->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-danger"
                                        onclick="confirmDelete({{ $data->id }})">
                                        Delete
                                    </button>
                                </form>
                            </div>
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


{{-- only for delte sweet alert message --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function confirmDelete(id) {
        Swal.fire({
          title: "Are you sure?",
text: "This CCI record will be permanently deleted.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>

@endsection