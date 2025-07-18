<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TaskMaster | Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
</head>

<body>


    <!-- Floating background shapes -->
    <div class="floating-shapes">
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="login-container">
                    <div class="login-header">
                        <i class="fas fa-tasks"></i>
                        <h2>TaskMaster Pro</h2>
                        <p>Sign in to your account</p>
                    </div>

                    @if(session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-4 position-relative">
                            <label for="email" class="form-label">Email Address</label>
                            <div class="position-relative">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                <input id="email" type="email"
                                    class="form-control ps-45 @error('email') is-invalid @enderror" name="email"
                                    value="{{ old('email') }}" required autofocus placeholder="Enter your email">
                            </div>
                            @error('email')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="mb-4 position-relative">
                            <label for="password" class="form-label">Password</label>
                            <div class="position-relative">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                <input id="password" type="password"
                                    class="form-control ps-45 @error('password') is-invalid @enderror" name="password"
                                    required placeholder="Enter your password">
                            </div>
                            @error('password')
                            <div class="invalid-feedback d-block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-login">
                                <i class="fas fa-sign-in-alt me-2"></i> Login
                            </button>
                        </div>

                        <div class="text-center pt-3 border-top">
                            <p class="mb-0">Don't have an account?
                                <a href="{{ route('register') }}" class="register-link">Register here</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
</body>

</html>