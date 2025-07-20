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
@section('content')

<div>
<div class="card mt-4 profile-form-container">
    <h4 class="mb-4 text-primary">User Profile  Update Information </h4>

    <form method="POST" action="{{ route('userdata.update', $userdata->id) }}">
        @csrf
        @method('PUT')

        <div class="form-group-vertical">
            <!-- First Group of 4 Inputs -->
            <div class="input-group">
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
                        placeholder="Enter Install T.T. Soc TTC" value="{{ old('install_T_T_Soc_TTC', $userdata->install_T_T_Soc_TTC) }}">
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
                    <input type="text" name="comp_or_refer" class="form-control"
                        placeholder="Enter Comp or Refer" value="{{ old('comp_or_refer', $userdata->comp_or_refer) }}">
                    @error('comp_or_refer') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="input-field">
                    <label class="input-label">Billing Code</label>
                    <input type="text" name="billing_code" class="form-control" placeholder="Enter Billing Code"
                        value="{{ old('billing_code', $userdata->billing_code) }}">
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
                    <input type="text" name="description" class="form-control" placeholder="Enter Description"
                        value="{{ old('description', $userdata->description) }}">
                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="input-field">
                    <label class="input-label">Rate</label>
                    <input type="text" name="rate" class="form-control" placeholder="Enter Rate"
                        value="{{ old('rate', $userdata->rate) }}">
                    @error('rate') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="input-field">
                    <label class="input-label">Total Billed</label>
                    <input type="text" name="total_billed" class="form-control" placeholder="Enter Total Billed"
                        value="{{ old('total_billed', $userdata->total_billed) }}">
                    @error('total_billed') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Fourth Group of 4 Inputs -->
            <div class="input-group">
                <div class="input-field">
                    <label class="input-label">Aerial Buried</label>
                    <input type="text" name="aerial_buried" class="form-control"
                        placeholder="Enter Aerial Buried" value="{{ old('aerial_buried', $userdata->aerial_buried) }}">
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
                    <input type="text" name="closeout_notes" class="form-control"
                        placeholder="Enter Closeout Notes" value="{{ old('closeout_notes', $userdata->closeout_notes) }}">
                    @error('closeout_notes') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="input-field">
                    <label class="input-label">In Time</label>
                    <input type="text" name="in" class="form-control" placeholder="Enter In Time"
                        value="{{ old('in', $userdata->in) }}">
                    @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
            </div>

            <!-- Fifth Group (remaining fields) -->
            <div class="input-group">
                <div class="input-field">
                    <label class="input-label">Out Time</label>
                    <input type="text" name="out" class="form-control" placeholder="Enter Out Time"
                        value="{{ old('out', $userdata->out) }}">
                    @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                </div>
                <div class="input-field">
                    <label class="input-label">Total Hours</label>
                    <input type="number" name="hours" class="form-control" placeholder="Enter Total Hours"
                        value="{{ old('hours', $userdata->hours) }}">
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
@endsection
