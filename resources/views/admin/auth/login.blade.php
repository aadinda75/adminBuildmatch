<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - BuildMatch</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/login.css') }}">
</head>
<body>

    <div class="login-container">
        <div class="login-card">
            <div class="brand-header">
                <div class="brand-logo">Build<span>Match</span></div>
                <div class="brand-subtitle">Admin Control Center</div>
            </div>

            <form action="{{ route('login') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="username" class="form-label">Username or Email</label>
                    <div class="input-wrapper">
                        <input type="text" 
                               name="username" 
                               id="username" 
                               class="form-control" 
                               placeholder="Enter admin username" 
                               value="{{ old('username') }}" 
                               required 
                               autocomplete="username" 
                               autofocus>
                        <i class='bx bx-user'></i>
                    </div>
                    @error('username')
                        <div class="error-message">
                            <i class='bx bx-error-circle'></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <div class="input-wrapper">
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="form-control" 
                               placeholder="••••••••" 
                               required 
                               autocomplete="current-password">
                        <i class='bx bx-lock-alt'></i>
                    </div>
                    @error('password')
                        <div class="error-message">
                            <i class='bx bx-error-circle'></i>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-options">
                    <label class="remember-me">
                        <input type="checkbox" name="remember" id="remember">
                        Remember session
                    </label>
                </div>

                <button type="submit" class="btn-submit">Sign In</button>
            </form>
        </div>
    </div>

</body>
</html>
