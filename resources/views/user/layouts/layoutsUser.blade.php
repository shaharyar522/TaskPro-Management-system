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
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
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

        <div class="dashboard-content">
            <!-- Dashboard Content -->
            @yield('content')

        </div>























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

     





       @if(session('redirect_to_report') && session('success_type') && session('success'))
    <script>
        window.onload = function () {
            // Show the Report tab
            showSection('report-section');

            // Show SweetAlert
            Swal.fire({
                icon: 'success',
                title: '{{ session('success_type') }}', // "Updated!" or "Deleted!"
                text: '{{ session('success') }}',
                confirmButtonText: 'OK',
                confirmButtonColor: '#3085d6',
                showConfirmButton: true,
                background: '#f0f8ff',
                customClass: {
                    popup: 'animated fadeIn faster'
                }
            });
        };
    </script>
@endif



</body>

</html>