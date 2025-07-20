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
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="User" class="user-avatar">
                <span class="user-name">John Doe</span>
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
        <h4 class="mb-4 text-primary">User Profile Information</h4>

        <form method="POST" action="{{ route('userdata.store') }}" id="user-data-form">
            @csrf

            <!-- Hidden input for update mode -->
            <input type="hidden" name="id" id="edit-id">
            <input type="hidden" name="_method" value="POST" id="form-method">

            <div class="form-group-vertical">
                <!-- First Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Corp ID</label>
                        <input type="text" name="corp_id" id="corp_id" class="form-control" placeholder="Enter Corp ID"
                            value="{{ old('corp_id') }}">
                        @error('corp_id') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Address</label>
                        <input type="text" name="address" id="address" class="form-control" placeholder="Enter Address"
                            value="{{ old('address') }}">
                        @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Billing TN</label>
                        <input type="text" name="billing_TN" id="billing_TN" class="form-control"
                            placeholder="Enter Billing TN" value="{{ old('billing_TN') }}">
                        @error('billing_TN') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Order Number</label>
                        <input type="text" name="order_number" id="order_number" class="form-control"
                            placeholder="Enter Order Number" value="{{ old('order_number') }}">
                        @error('order_number') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Second Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Install T.T. Soc TTC</label>
                        <input type="text" name="install_T_T_Soc_TTC" id="install_T_T_Soc_TTC" class="form-control"
                            placeholder="Enter Install T.T. Soc TTC" value="{{ old('install_T_T_Soc_TTC') }}">
                        @error('install_T_T_Soc_TTC') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">ONT NTD</label>
                        <input type="text" name="ont_Ntd" id="ont_Ntd" class="form-control" placeholder="Enter ONT NTD"
                            value="{{ old('ont_Ntd') }}">
                        @error('ont_Ntd') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Comp or Refer</label>
                        <input type="text" name="comp_or_refer" id="comp_or_refer" class="form-control"
                            placeholder="Enter Comp or Refer" value="{{ old('comp_or_refer') }}">
                        @error('comp_or_refer') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Billing Code</label>
                        <input type="text" name="billing_code" id="billing_code" class="form-control"
                            placeholder="Enter Billing Code" value="{{ old('billing_code') }}">
                        @error('billing_code') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Third Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Quantity</label>
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter Quantity"
                            value="{{ old('qty') }}">
                        @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Description</label>
                        <input type="text" name="description" id="description" class="form-control"
                            placeholder="Enter Description" value="{{ old('description') }}">
                        @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Rate</label>
                        <input type="text" name="rate" id="rate" class="form-control" placeholder="Enter Rate"
                            value="{{ old('rate') }}">
                        @error('rate') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Total Billed</label>
                        <input type="text" name="total_billed" id="total_billed" class="form-control"
                            placeholder="Enter Total Billed" value="{{ old('total_billed') }}">
                        @error('total_billed') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Fourth Group of 4 Inputs -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Aerial Buried</label>
                        <input type="text" name="aerial_buried" id="aerial_buried" class="form-control"
                            placeholder="Enter Aerial Buried" value="{{ old('aerial_buried') }}">
                        @error('aerial_buried') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Fiber</label>
                        <input type="text" name="fiber" id="fiber" class="form-control" placeholder="Enter Fiber"
                            value="{{ old('fiber') }}">
                        @error('fiber') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Closeout Notes</label>
                        <input type="text" name="closeout_notes" id="closeout_notes" class="form-control"
                            placeholder="Enter Closeout Notes" value="{{ old('closeout_notes') }}">
                        @error('closeout_notes') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">In Time</label>
                        <input type="text" name="in" id="in" class="form-control" placeholder="Enter In Time"
                            value="{{ old('in') }}">
                        @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                </div>

                <!-- Fifth Group (remaining fields) -->
                <div class="input-group">
                    <div class="input-field">
                        <label class="input-label">Out Time</label>
                        <input type="text" name="out" id="out" class="form-control" placeholder="Enter Out Time"
                            value="{{ old('out') }}">
                        @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Total Hours</label>
                        <input type="number" name="hours" id="hours" class="form-control"
                            placeholder="Enter Total Hours" value="{{ old('hours') }}">
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




<div id="report-section" style="display: none;">
    <div class="card mt-4 profile-form-container">
        <h4 class="mb-4 text-primary">User Report Information</h4>

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
                    @forelse($userData as $data)
                    <tr>
                        <td>{{ $data->id }}</td>
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
                            <!-- Edit button -->
                            <a href="{{ route('userdata.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                Edit
                            </a>

                            <!-- Delete form -->
                            <form action="{{ route('userdata.destroy', $data->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="20" class="text-center">No records found for this user.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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


@endsection