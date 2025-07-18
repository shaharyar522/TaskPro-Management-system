<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMaster | Register</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4361ee;
            --primary-dark: #3a56d4;
            --primary-light: #eef2ff;
            --success-color: #1aa179;
            --dark-color: #4a4c5a;
            --light-color: #f8f9fc;
            --white: #ffffff;
            --transition: all 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            background-image: url('https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            position: relative;
            overflow: hidden;
            margin: 0;
            padding: 20px;
        }
        
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(67, 97, 238, 0.85);
            z-index: 0;
        }
        
        .register-wrapper {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            position: relative;
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 25px;
            max-height: 90vh;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }
        
        .register-header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 15px;
            flex-shrink: 0;
        }
        
        .register-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-color);
            border-radius: 3px;
        }
        
        .register-header h2 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 10px;
            font-size: 1.6rem;
        }
        
        .register-header i {
            font-size: 1.8rem;
            color: var(--primary-color);
            margin-bottom: 10px;
            display: inline-block;
            background: var(--primary-light);
            width: 50px;
            height: 50px;
            line-height: 50px;
            border-radius: 50%;
            text-align: center;
        }
        
        .form-content {
            flex: 1;
            overflow-y: auto;
            padding-right: 5px;
            margin-bottom: 15px;
        }
        
        /* Custom scrollbar */
        .form-content::-webkit-scrollbar {
            width: 5px;
        }
        
        .form-content::-webkit-scrollbar-track {
            background: transparent;
        }
        
        .form-content::-webkit-scrollbar-thumb {
            background: rgba(67, 97, 238, 0.3);
            border-radius: 10px;
        }
        
        .form-group {
            margin-bottom: 15px;
            position: relative;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: 500;
            color: var(--dark-color);
            font-size: 0.85rem;
        }
        
        .form-control {
            height: 40px;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            padding-left: 40px;
            transition: var(--transition);
            font-size: 0.85rem;
            width: 100%;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.2rem rgba(67, 97, 238, 0.25);
            border-color: var(--primary-color);
        }
        
        .input-group-text {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 4;
            background: transparent;
            border: none;
            color: #a0a0a0;
            font-size: 0.9rem;
        }
        
        .btn-register {
            background-color: var(--primary-color);
            color: var(--white);
            font-weight: 600;
            height: 40px;
            border-radius: 8px;
            border: none;
            transition: var(--transition);
            width: 100%;
            font-size: 0.9rem;
            margin-top: 10px;
        }
        
        .btn-register:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        
        .login-link {
            color: var(--dark-color);
            transition: var(--transition);
            text-decoration: none;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
        }
        
        .login-link:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            padding-top: 15px;
            border-top: 1px solid #eee;
            flex-shrink: 0;
        }
        
        .text-danger {
            font-size: 0.75rem;
            margin-top: 0.2rem;
            display: block;
        }
        
        .form-row {
            display: flex;
            gap: 15px;
            margin-bottom: 15px;
        }
        
        .form-row > div {
            flex: 1;
        }
        
        @media (max-width: 576px) {
            .register-container {
                padding: 20px;
            }
            
            .form-row {
                flex-direction: column;
                gap: 15px;
            }
            
            .register-header h2 {
                font-size: 1.4rem;
            }
            
            .register-header i {
                width: 45px;
                height: 45px;
                line-height: 45px;
                font-size: 1.5rem;
            }
            
            body {
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="register-wrapper">
        <div class="register-container">
            <div class="register-header">
                <i class="fas fa-user-plus"></i>
                <h2>Create Account</h2>
                <p>Join TaskMaster Pro</p>
            </div>

            <div class="form-content">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="first_name">First Name</label>
                            <div class="position-relative">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" required autofocus
                                       placeholder="First name">
                            </div>
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="last_name">Last Name</label>
                            <div class="position-relative">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                <input id="last_name" type="text"
                                       class="form-control @error('last_name') is-invalid @enderror"
                                       name="last_name" value="{{ old('last_name') }}" required
                                       placeholder="Last name">
                            </div>
                            @error('last_name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="copy_id">Copy ID</label>
                        <div class="position-relative">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input id="copy_id" type="text"
                                   class="form-control @error('copy_id') is-invalid @enderror"
                                   name="copy_id" value="{{ old('copy_id') }}" required
                                   placeholder="Your copy ID">
                        </div>
                        @error('copy_id')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="registration_date">Registration Date</label>
                        <div class="position-relative">
                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                            <input id="registration_date" type="date"
                                   class="form-control @error('registration_date') is-invalid @enderror"
                                   name="registration_date" value="{{ old('registration_date', date('Y-m-d')) }}" required
                                   placeholder="Registration date">
                        </div>
                        @error('registration_date')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <div class="position-relative">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input id="email" type="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   name="email" value="{{ old('email') }}" required
                                   placeholder="Enter your email">
                        </div>
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="password">Password</label>
                            <div class="position-relative">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror"
                                       name="password" required 
                                       placeholder="Create password">
                            </div>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Confirm Password</label>
                            <div class="position-relative">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password_confirmation" type="password"
                                       class="form-control"
                                       name="password_confirmation" required
                                       placeholder="Confirm password">
                            </div>
                        </div>
                    </div>

                    <!-- Hidden fields for status and blocked -->
                    <input type="hidden" name="status" value="0">
                    <input type="hidden" name="blocked" value="0">

                    <button type="submit" class="btn btn-register">
                        <i class="fas fa-user-plus me-2"></i> Register
                    </button>
                </form>
            </div>

            <div class="footer-links">
                <a href="{{ route('login') }}" class="login-link">
                    <i class="fas fa-sign-in-alt me-1"></i> Already have an account?
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Add animation to form inputs on focus
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.querySelector('.input-group-text').style.color = '#4361ee';
                this.parentElement.parentElement.querySelector('label').style.color = '#4361ee';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.querySelector('.input-group-text').style.color = '#a0a0a0';
                this.parentElement.parentElement.querySelector('label').style.color = '#495057';
            });
        });
    </script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session("success") }}'
        });
    </script>
@endif

@if(session('warning'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Notice!',
            text: '{{ session("warning") }}'
        });
    </script>
@endif

</body>
</html>