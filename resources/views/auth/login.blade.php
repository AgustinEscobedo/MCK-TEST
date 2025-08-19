<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        body {
            background: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            font-family: Arial, sans-serif;
        }

        .auth-container {
            display: flex;
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            max-width: 850px;
            width: 100%;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        .auth-container.register-active {
            height: 450px;
        }

        .auth-image {
            flex: 1;
            background: #0d6efd;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3%0px;
        }

        .auth-image img {
            width: 255px;
            height: 255px;
            border-radius: 50%;
            border: 3px solid #fff;
        }

        .auth-forms {
            flex: 1;
            position: relative;
            overflow: hidden;
            background: #fff;
        }

        form {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 40px;
            box-sizing: border-box;
            transition: all 0.5s ease;
        }

        #login-form.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }

        #login-form.inactive {
            opacity: 0;
            transform: translateX(-100%);
            pointer-events: none;
        }

        #register-form {
            opacity: 0;
            transform: translateX(100%);
            pointer-events: none;
        }

        #register-form.active {
            opacity: 1;
            transform: translateX(0);
            pointer-events: all;
        }

        .form-toggle {
            cursor: pointer;
            color: #0d6efd;
            text-decoration: underline;
        }

        .social-links a {
            margin: 0 10px;
            color: #0d6efd;
            transition: color 0.3s ease;
        }

        .social-links a:hover {
            color: #0056b3;
        }

        @media (max-width: 768px) {
            .auth-container {
                flex-direction: column;
                max-width: 95%;
            }

            .auth-image,
            .auth-forms {
                flex: unset;
                width: 100%;
                text-align: center;
            }

            form {
                position: relative !important;
                transform: none !important;
                opacity: 1 !important;
                pointer-events: all !important;
                padding: 20px;
            }
        }

        .alert-fixed {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 9999;
            max-width: 400px;
            width: 90%;
            text-align: center;
        }
    </style>
</head>

<body>
    @if(session('success'))
        <div class="alert alert-success alert-fixed">
            {{ session('success') }}
        </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger alert-fixed">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="auth-container">
        <div class="auth-image">
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQQCeOYEZXBHDcBum4AkFhCdEJVbUWkuLO8aA&s"
                alt="Logo">
        </div>
        <div class="auth-forms">
            <form id="login-form" class="active" method="POST" action="{{ route('login') }}">
                @csrf
                <h3 class="mb-3">Inicia Sesión</h3>

                <input type="email" name="email" class="form-control mb-2" placeholder="Email"
                    value="{{ old('email') }}" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                <button type="submit" class="btn btn-primary w-100 mb-2">Login</button>

                <small>¿No tienes cuenta? <span class="form-toggle" onclick="toggleForms()">Regístrate</span></small>

                <div class="social-links mt-3">
                    <a href="https://www.facebook.com/MCK.digital.agency/" target="_blank"><i
                            class="fab fa-facebook fa-lg"></i></a>
                    <a href="https://www.instagram.com/mck.agency/" target="_blank"><i
                            class="fab fa-instagram fa-lg"></i></a>
                </div>
            </form>


            <form id="register-form" method="POST" action="{{ route('register') }}">
                @csrf
                <h3 class="mb-3">Regístrate</h3>
                <input type="text" name="name" class="form-control mb-2" placeholder="Nombre" required>
                <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                <input type="password" name="password" class="form-control mb-2" placeholder="Password" required>
                <input type="password" name="password_confirmation" class="form-control mb-2"
                    placeholder="Confirmar Password" required>
                <button type="submit" class="btn btn-success w-100 mb-2">Registrar</button>
                <small>¿Ya tienes cuenta? <span class="form-toggle" onclick="toggleForms()">Login</span></small>
                <div class="social-links mt-3">
                    <a href="https://www.facebook.com/MCK.digital.agency/" target="_blank"><i
                            class="fab fa-facebook fa-lg"></i></a>
                    <a href="https://www.instagram.com/mck.agency/" target="_blank"><i
                            class="fab fa-instagram fa-lg"></i></a>
                </div>
            </form>

        </div>
    </div>

    <script>
        function toggleForms() {
            const login = document.getElementById('login-form');
            const register = document.getElementById('register-form');
            const container = document.querySelector('.auth-container');

            login.classList.toggle('active');
            login.classList.toggle('inactive');
            register.classList.toggle('active');

            if (register.classList.contains('active')) {
                container.classList.add('register-active');
            } else {
                container.classList.remove('register-active');
            }
        }
        setTimeout(() => {
            const alert = document.querySelector('.alert-fixed');
            if (alert) alert.style.display = 'none';
        }, 6000);

    </script>

</body>

</html>