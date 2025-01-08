<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>

    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="CSS/Login.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="icon" href="images/favicon-16x16.png" type="image/x-icon">
</head>

<body>
    <!-- Header section with logo -->
    <header>
        <img class="logo" src="Images/logo_UCLA.png" alt="Logo-Ucla">
    </header>
    <!-- Main content wrapper -->
    <div class="wrapper" id="wrapper">
        <div class="form-box login">
            <!-- Login form -->
            <form action="Configuration/Login.php" method="POST">
                <h1>INICIO DE SESIÓN</h1>

                <!-- Username input field -->
                <div class="input-box">
                    <span class="icon"><i class='bx bx-user'></i></span>
                    <input type="text" id="User" name="User" required>
                    <label class="label">Usuario</label>
                </div>

                <!-- Password input field -->
                <div class="input-box">
                    <span class="icon"><i class='bx bx-lock-alt'></i></span>
                    <input type="password" id="Password" name="Password" required>
                    <label class="label">Contraseña</label>
                </div>


             <!--   <div class="forgot">
                    <a href="#" class="forgot-password">¿Olvidar Contraseña?</a>
                </div> -->

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <!-- Script tags for external libraries -->
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Custom JavaScript for handling errors -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.has('error')) {
                const error = params.get('error');
                let message = '';
                switch (error) {
                    case 'campo_vacio':
                        message = 'Por favor, complete todos los campos.';
                        break;
                    case 'contrasena_incorrecta':
                        message = 'Contraseña incorrecta. Intente nuevamente.';
                        break;
                    case 'usuario_no_existe':
                        message = 'El usuario no existe. Verifique sus credenciales.';
                        break;
                    case 'error_acceso':
                        message = 'Debe Iniciar sesión para acceder.';
                        break;
                }
                toastr.error(message, 'Error', {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-top-right",
                    "timeOut": "5000"
                });
            }
        });
    </script>
</body>

</html>
