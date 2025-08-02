@extends('user.layouts.layoutsUser')



<link rel="stylesheet" href="{{asset('css/userdashbord/button.css')}}">

@section('content')

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
        flex-direction: row; /* Keep layout as row to avoid stacking */
        padding: 0 10px;
        height: 70px; /* Maintain height */
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
        justify-content: flex-end; /* Ensure logout button is on the right */
        align-items: center;
        gap: 12px; /* Maintain space between elements */
        width: auto; /* Avoid taking full width */
        margin-left: auto; /* Push logout to the right */
    }

    .logout-button {
        align-items: center; /* Center align text and icon */
        text-align: right;
        /*display: inline-flex; */
        margin-top: 0; /* Remove any margin */
        padding: 0; /* Ensure no extra padding */
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
        <h4 class="mb-4 text-primary">User Profile Information Frontier</h4>

        <form method="POST" action="{{ route('userfrontier.store') }}" id="user-data-form">
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
                        <select name="install_T_T_Soc_TTC" id="install_T_T_Soc_TTC" class="form-control">
                            <option value="">-- Select Option --</option>
                            <option value="SOC" {{ old('install_T_T_Soc_TTC')=='SOC' ? 'selected' : '' }}>SOC</option>
                            <option value="TT" {{ old('install_T_T_Soc_TTC')=='TT' ? 'selected' : '' }}>TT</option>
                        </select>
                        @error('install_T_T_Soc_TTC') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">ONT NTD</label>
                        <select name="ont_Ntd" id="ont_Ntd" class="form-control">
                            <option value="">-- Select Option --</option>
                            <option value="YES" {{ old('ont_Ntd')=='YES' ? 'selected' : '' }}>YES</option>
                            <option value="NO" {{ old('ont_Ntd')=='NO' ? 'selected' : '' }}>NO</option>
                        </select>
                        @error('ont_Ntd') <small class="text-danger">{{ $message }}</small> @enderror
                    </div>

                    <div class="input-field">
                        <label class="input-label">Comp or Refer</label>
                        <select name="comp_or_refer" id="comp_or_refer" class="form-control">
                            <option value="">-- Select Option --</option>
                            <option value="COMP" {{ old('comp_or_refer')=='COMP' ? 'selected' : '' }}>COMP</option>
                            <option value="REFER" {{ old('comp_or_refer')=='REFER' ? 'selected' : '' }}>REFER</option>
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
                        <input type="number" name="qty" id="qty" class="form-control" placeholder="Enter Quantity"
                            value="{{ old('qty') }}">
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
            <h4 class="text-primary"> Frontier Information Details</h4>

            <form action="{{ route('user.dashboardFrontier') }}" method="GET" class="d-flex gap-2 align-items-center">
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
                    <a href="{{ route('user.dashboardFrontier') }}" class="btn btn-sm"
                        style="background-color: #bb2d3b; color: white; border: none;"
                        onmouseover="this.style.backgroundColor='#a12733'"
                        onmouseout="this.style.backgroundColor='#bb2d3b'">
                        Reset Date
                    </a>
                </div>
            </form>

            <div class="d-flex gap-2">

                <form action="{{route('user.frontier.send.excel')}}" method="POST">

                    @csrf
                    <button type="submit" class="btn-send-mail">
                        <i class="fas fa-envelope"></i> Send Mail
                    </button>

                </form>

                <a href="{{ route('userfrontier.export.excel') }}" class="btn btn-success">
                    </i> Download Excel File
                </a>
 
                <a href="{{ route('userfrontier.export.csv') }}" class="btn btn-secondary">
                    </i> Download CSV File
                </a>

                <a href="{{ route('userfrontier.export.pdf') }}" class="btn btn-danger">
                    Download PDF File
                </a>
            </div>

        </div>

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
                    @foreach($userfrontire as $data)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
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
                            <div class="d-flex align-items-center gap-2">
                                <!-- Edit button -->
                                <a href="{{ route('userfrontier.edit', $data->id) }}" class="btn btn-sm btn-warning">
                                    Edit
                                </a>
                                <!-- Delete form -->
                              
                                
                                 <form id="delete-form-{{ $data->id }}" action="{{ route('userfrontier.destroy', $data->id) }}"
                                method="POST" style="display:inline-block;">
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
                {{ $userfrontire->links() }}
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

{{-- for js pagintaion start data and end data --}}
<script>
    function showSection(sectionId) {
        document.getElementById('form-section').style.display = 'none';
        document.getElementById('report-section').style.display = 'none';
        document.getElementById(sectionId).style.display = 'block';
    }

    // Wait for DOM to be ready
    document.addEventListener('DOMContentLoaded', function () {
        @if(request()->has('page') || request()->has('start_date') || request()->has('end_date'))
            showSection('report-section');
        @else
            showSection('form-section');
        @endif
    });
</script>


{{-- for js pagintaion start data and end data --}}
{{-- autofill input field like descri rate totla_billed js --}}
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