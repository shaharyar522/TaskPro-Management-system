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
        <h4 class="mb-4 text-primary">User Profile Update Frontier Information </h4>

        <form method="POST" action="{{ route('userfrontier.update', $userdata->id) }}">
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
                        <select name="install_T_T_Soc_TTC" id="install_T_T_Soc_TTC" class="form-control">
                            <option value="">-- Select Option --</option>
                            <option value="SOC" {{ old('install_T_T_Soc_TTC',$userdata->install_T_T_Soc_TTC)=='SOC' ?
                                'selected' : '' }}>SOC</option>
                            <option value="TT" {{ old('install_T_T_Soc_TTC',$userdata->install_T_T_Soc_TTC)=='TT' ?
                                'selected' : '' }}>TT</option>
                        </select>
                        @error('install_T_T_Soc_TTC') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">ONT NTD</label>
                        <select name="ont_Ntd" id="ont_Ntd" class="form-control">
                            <option value="">-- Select Option --</option>
                            <option value="YES" {{ old('ont_Ntd',$userdata->ont_Ntd)=='YES' ? 'selected' : '' }}>YES
                            </option>
                            <option value="NO" {{ old('ont_Ntd',$userdata->ont_Ntd)=='NO' ? 'selected' : '' }}>NO
                            </option>
                        </select>
                        @error('ont_Ntd') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Comp or Refer</label>
                        <select name="comp_or_refer" id="comp_or_refer" class="form-control">
                            <option value="">-- Select Option --</option>
                            <option value="COMP" {{ old('comp_or_refer', $userdata->comp_or_refer)=='COMP' ? 'selected'
                                : '' }}>COMP</option>
                            <option value="REFER" {{ old('comp_or_refer',$userdata->comp_or_refer)=='REFER' ? 'selected'
                                : '' }}>REFER</option>
                        </select>
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
                            <option value="{{ $code }}" {{ old('billing_code', $userdata->billing_code)==$code ?
                                'selected' : '' }}>
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
                        <input type="time" name="in" id="in" class="form-control" value="{{ old('in',$userdata->in) }}">
                        @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                </div>
                <!-- Fifth Group (remaining fields) -->
                <div class="input-group">

                    <div class="input-field">
                        <label class="input-label">Out</label>
                        <input type="time" name="out" id="out" class="form-control"
                            value="{{ old('out',$userdata->out) }}">
                        @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <div class="input-field">
                        <label class="input-label">Hours</label>
                        <input type="number" name="hours" id="hours" value="{{ old('out',$userdata->hours) }}"
                            class="form-control" step="0.1" readonly>
                        @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>
                    <input type="hidden" name="user_id" value="{{ Auth::id() }}">

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



@push('script')
<script>
    function showSection(sectionId) {
       document.querySelectorAll('.section').forEach(sec => sec.style.display = 'none');
       document.getElementById(sectionId).style.display = 'block';
   }
</script>
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const userProfile = document.querySelector('.user-profile');
    const dropdownMenu = document.querySelector('.dropdown-menu');

    if (userProfile) {
        userProfile.addEventListener('click', function (e) {
            e.stopPropagation();
            dropdownMenu.classList.toggle('show');
        });
    }

    // Close dropdown if clicked outside
    document.addEventListener('click', function () {
        if (dropdownMenu) dropdownMenu.classList.remove('show');
    });
});

</script>

@endsection