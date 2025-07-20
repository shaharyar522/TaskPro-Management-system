<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    <link rel="stylesheet" href="{{asset('css/userdashbord/dashboard.css')}}">
    <link rel="stylesheet" href="{{asset('css/userdashbord/userform.css')}}">
    <title>User_dashbaod</title>
    <style>
        .user-dropdown {
    position: relative;
    cursor: pointer;
}

.dropdown-menu {
    position: absolute;
    right: 0;
    top: 100%;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 5px;
    display: none;
    z-index: 999;
    min-width: 160px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.dropdown-menu .dropdown-item {
    padding: 10px 15px;
    color: #333;
    text-decoration: none;
    display: block;
}

.dropdown-menu .dropdown-item:hover {
    background-color: #f5f5f5;
}

.user-dropdown.active .dropdown-menu {
    display: block;
}

    </style>

</head>

<body>
    <!-- Main Dashboard Container -->
    <div class="dashboard-main-container">
        <!-- Dashboard Header -->

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

        <!-- Dashboard Content -->
        <div class="dashboard-content">
            <!-- Welcome Banner -->
            <div class="welcome-banner">
                <div class="welcome-text">
                    <h2>Task Management User Dashboard</h2>
                </div>
                <div class="welcome-illustration">
                    <img src="https://illustrations.popsy.co/amber/achievement.svg" alt="Welcome Illustration">
                </div>
            </div>
            {{-- users forom show --}}

            <div id="form-section">

                <div class="card mt-4 profile-form-container">
                    <h4 class="mb-4 text-primary">User Profile Information</h4>
                    <form method="POST" action="{{route('userdata.store')}}">
                        @csrf
                        <div class="form-group-vertical">
                            <!-- First Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Corp ID</label>
                                    <input type="text" name="corp_id" class="form-control" placeholder="Enter Corp ID"
                                        value="{{ old('corp_id') }}">
                                    @error('corp_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                        value="{{ old('address') }}">
                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Billing TN</label>
                                    <input type="text" name="billing_TN" class="form-control"
                                        placeholder="Enter Billing TN" value="{{ old('billing_TN') }}">
                                    @error('billing_TN') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Order Number</label>
                                    <input type="text" name="order_number" class="form-control"
                                        placeholder="Enter Order Number" value="{{ old('order_number') }}">
                                    @error('order_number') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Second Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Install T.T. Soc TTC</label>
                                    <input type="text" name="install_T_T_Soc_TTC" class="form-control"
                                        placeholder="Enter Install T.T. Soc TTC"
                                        value="{{ old('install_T_T_Soc_TTC') }}">
                                    @error('install_T_T_Soc_TTC') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">ONT NTD</label>
                                    <input type="text" name="ont_Ntd" class="form-control" placeholder="Enter ONT NTD"
                                        value="{{ old('ont_Ntd') }}">
                                    @error('ont_Ntd') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Comp or Refer</label>
                                    <input type="text" name="comp_or_refer" class="form-control"
                                        placeholder="Enter Comp or Refer" value="{{ old('comp_or_refer') }}">
                                    @error('comp_or_refer') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Billing Code</label>
                                    <input type="text" name="billing_code" class="form-control"
                                        placeholder="Enter Billing Code" value="{{ old('billing_code') }}">
                                    @error('billing_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Third Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Quantity</label>
                                    <input type="number" name="qty" class="form-control" placeholder="Enter Quantity"
                                        value="{{ old('qty') }}">
                                    @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Description</label>
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Enter Description" value="{{ old('description') }}">
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Rate</label>
                                    <input type="text" name="rate" class="form-control" placeholder="Enter Rate"
                                        value="{{ old('rate') }}">
                                    @error('rate') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Total Billed</label>
                                    <input type="text" name="total_billed" class="form-control"
                                        placeholder="Enter Total Billed" value="{{ old('total_billed') }}">
                                    @error('total_billed') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Fourth Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Aerial Buried</label>
                                    <input type="text" name="aerial_buried" class="form-control"
                                        placeholder="Enter Aerial Buried" value="{{ old('aerial_buried') }}">
                                    @error('aerial_buried') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Fiber</label>
                                    <input type="text" name="fiber" class="form-control" placeholder="Enter Fiber"
                                        value="{{ old('fiber') }}">
                                    @error('fiber') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Closeout Notes</label>
                                    <input type="text" name="closeout_notes" class="form-control"
                                        placeholder="Enter Closeout Notes" value="{{ old('closeout_notes') }}">
                                    @error('closeout_notes') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">In Time</label>
                                    <input type="text" name="in" class="form-control" placeholder="Enter In Time"
                                        value="{{ old('in') }}">
                                    @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Fifth Group (remaining fields) -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Out Time</label>
                                    <input type="text" name="out" class="form-control" placeholder="Enter Out Time"
                                        value="{{ old('out') }}">
                                    @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Total Hours</label>
                                    <input type="number" name="hours" class="form-control"
                                        placeholder="Enter Total Hours" value="{{ old('hours') }}">
                                    @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            </div>
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Save Information
                            </button>
                        </div>
                    </form>
                </div>

            </div>

            {{-- end forom show --}}




            <div id="report-section" style="display: none;">
                <div class="card mt-4 profile-form-container">
                    <h4 class="mb-4 text-primary">User Report Information</h4>
                    @if ($userData)
                    <form method="POST" action="{{ route('userdata.update', $userData->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="form-group-vertical">
                            <!-- First Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Corp ID</label>
                                    <input type="text" name="corp_id" class="form-control" placeholder="Enter Corp ID"
                                        value="{{ old('corp_id', $userData->corp_id ?? '') }}">
                                    @error('corp_id') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Address</label>
                                    <input type="text" name="address" class="form-control" placeholder="Enter Address"
                                        value="{{ old('address', $userData->address ?? '') }}">
                                    @error('address') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Billing TN</label>
                                    <input type="text" name="billing_TN" class="form-control"
                                        placeholder="Enter Billing TN"
                                        value="{{ old('billing_TN', $userData->billing_TN ?? '') }}">
                                    @error('billing_TN') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Order Number</label>
                                    <input type="text" name="order_number" class="form-control"
                                        placeholder="Enter Order Number"
                                        value="{{ old('order_number', $userData->order_number ?? '') }}">
                                    @error('order_number') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Second Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Install T.T. Soc TTC</label>
                                    <input type="text" name="install_T_T_Soc_TTC" class="form-control"
                                        placeholder="Enter Install T.T. Soc TTC"
                                        value="{{ old('install_T_T_Soc_TTC', $userData->install_T_T_Soc_TTC ?? '') }}">
                                    @error('install_T_T_Soc_TTC') <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">ONT NTD</label>
                                    <input type="text" name="ont_Ntd" class="form-control" placeholder="Enter ONT NTD"
                                        value="{{ old('ont_Ntd', $userData->ont_Ntd ?? '') }}">
                                    @error('ont_Ntd') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Comp or Refer</label>
                                    <input type="text" name="comp_or_refer" class="form-control"
                                        placeholder="Enter Comp or Refer"
                                        value="{{ old('comp_or_refer', $userData->comp_or_refer ?? '') }}">
                                    @error('comp_or_refer') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Billing Code</label>
                                    <input type="text" name="billing_code" class="form-control"
                                        placeholder="Enter Billing Code"
                                        value="{{ old('billing_code', $userData->billing_code ?? '') }}">
                                    @error('billing_code') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Third Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Quantity</label>
                                    <input type="number" name="qty" class="form-control" placeholder="Enter Quantity"
                                        value="{{ old('qty', $userData->qty ?? '') }}">
                                    @error('qty') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Description</label>
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Enter Description"
                                        value="{{ old('description', $userData->description ?? '') }}">
                                    @error('description') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Rate</label>
                                    <input type="text" name="rate" class="form-control" placeholder="Enter Rate"
                                        value="{{ old('rate', $userData->rate ?? '') }}">
                                    @error('rate') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Total Billed</label>
                                    <input type="text" name="total_billed" class="form-control"
                                        placeholder="Enter Total Billed"
                                        value="{{ old('total_billed', $userData->total_billed ?? '') }}">
                                    @error('total_billed') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Fourth Group of 4 Inputs -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Aerial Buried</label>
                                    <input type="text" name="aerial_buried" class="form-control"
                                        placeholder="Enter Aerial Buried"
                                        value="{{ old('aerial_buried', $userData->aerial_buried ?? '') }}">
                                    @error('aerial_buried') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Fiber</label>
                                    <input type="text" name="fiber" class="form-control" placeholder="Enter Fiber"
                                        value="{{ old('fiber', $userData->fiber ?? '') }}">
                                    @error('fiber') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Closeout Notes</label>
                                    <input type="text" name="closeout_notes" class="form-control"
                                        placeholder="Enter Closeout Notes"
                                        value="{{ old('closeout_notes', $userData->closeout_notes ?? '') }}">
                                    @error('closeout_notes') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">In Time</label>
                                    <input type="text" name="in" class="form-control" placeholder="Enter In Time"
                                        value="{{ old('in', $userData->in ?? '') }}">
                                    @error('in') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                            </div>

                            <!-- Fifth Group (remaining fields) -->
                            <div class="input-group">
                                <div class="input-field">
                                    <label class="input-label">Out Time</label>
                                    <input type="text" name="out" class="form-control" placeholder="Enter Out Time"
                                        value="{{ old('out', $userData->out ?? '') }}">
                                    @error('out') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="input-field">
                                    <label class="input-label">Total Hours</label>
                                    <input type="number" name="hours" class="form-control"
                                        placeholder="Enter Total Hours"
                                        value="{{ old('hours', $userData->hours ?? '') }}">
                                    @error('hours') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                            </div>
                        </div>

                        <div class="form-submit  justify-content-right">
                            <!-- Save Button -->
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i> Update
                            </button>
                        </div>
                    </form>
                    @else
                    <script>
                        Swal.fire({
            icon: 'warning',
            title: 'No Data Found',
            text: 'You have not submitted your data yet. Please create a new entry first.',
        }).then(() => {
            window.location.href = "{{ route('user.dashboard') }}";
        });
                    </script>
                    @endif

                    <form action="{{ route('userdata.destroy') }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete your data?');"
                        style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>


                </div>
            </div>




            {{-- sweet alert message --}}
            <!-- SweetAlert2 JS -->
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            @if(session('success'))
            <script>
                Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false
        });
            </script>
            @endif
            {{-- FOR ERROR --}}
            @if (session('success'))
            <script>
                Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
        });
            </script>
            @endif

            @if (session('error'))
            <script>
                Swal.fire({
            icon: 'error',
            title: 'Oops!',
            text: '{{ session('error') }}',
        });
            </script>
            @endif



            <script>
                function showSection(sectionId) {
                  document.getElementById('form-section').style.display = 'none';
                document.getElementById('report-section').style.display = 'none';
               document.getElementById(sectionId).style.display = 'block';
                }
            </script>

            {{-- bootstrap --}}
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

{{--  --}}
</body>
</html>