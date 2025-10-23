<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Iuran Warga</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root {
            --primary-color: #4361ee;
            --secondary-color: #3f37c9;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url('https://images.unsplash.com/photo-1509822929063-6b6cfc9b42f2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            min-height: 100vh;
            align-items: center;
            position: relative;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 0;
        }
        .login-container {
            max-width: 450px;
            width: 100%;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }
        .login-card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            color: white;
        }
        .login-header {
            padding: 1.5rem;
            text-align: center;
        }
        .login-body {
            padding: 2rem;
        }
        .form-control {
            height: 50px;
            border-radius: 8px;
            padding-left: 45px;
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        .form-control:focus {
            background-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 0.25rem rgba(67, 97, 238, 0.25);
            border-color: var(--primary-color);
            color: white;
        }
        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }
        .btn-login {
            background-color: var(--primary-color);
            border: none;
            height: 50px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-login:hover {
            background-color: var(--secondary-color);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-card">
                <div class="login-header">
                    <h3><i class="fas fa-hand-holding-usd me-2"></i> SIM IURAN WARGA</h3>
                    <p class="mb-0 text-white-50">Masuk ke sistem pengelolaan iuran</p>
                </div>

                <div class="login-body">

                    {{-- PERUBAHAN 1: Form action diarahkan ke RUTE 'login.store' --}}
                    <form action="{{ route('login.store') }}" method="POST">

                        {{-- PERUBAHAN 2: Tambahkan @csrf (WAJIB untuk keamanan Laravel) --}}
                        @csrf

                        {{-- PERUBAHAN 3: Menampilkan error jika login gagal (dari LoginController) --}}
                        @if ($errors->any())
                            <div class="alert alert-danger" role="alert">
                                {{ $errors->first('username') }}
                            </div>
                        @endif

                        <div class="mb-4 position-relative">
                            <i class="fas fa-user input-icon"></i>
                            {{-- Tambahkan value="old('username')" agar username tidak hilang jika login gagal --}}
                            <input type="text" class="form-control" placeholder="Username" name="username" value="{{ old('username') }}" required>
                        </div>

                        <div class="mb-4 position-relative">
                            <i class="fas fa-lock input-icon"></i>
                            <input type="password" class="form-control" placeholder="Password" name="password" required>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-login">
                            <i class="fas fa-sign-in-alt me-2"></i> MASUK
                        </button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                {{-- Mengganti sintaks PHP lama dengan Blade --}}
                <p class="mb-0 text-white-50 small">Aplikasi Sistem Iuran Warga &copy; {{ date('Y') }}</p>
            </div>
        </div>
    </div>
</body>
</html>
