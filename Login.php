<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="CSS/Login.css">

</head>

<body>

    <header>
        <img class="logo" src="Images/logo_UCLA.png" alt="Logo-Ucla">
    </header>

    <div class="wrapper" id="wrapper">
        <div class="form-box login">
            <form action="Configuration/Login.php" method="POST">
                <h1>INICIO DE SESIÓN</h1>

                <div class="input-box">
                    <img src="Images/icon-user.png" class="icon">
                    <input type="text" id="User" name="User" required>
                    <label class="label">Usuario</label>
                </div>


                <div class="input-box">
                    <img src="Images/icon-padlock.png" class="icon">
                    <input type="password" id="Password" name="Password" required>
                    <label class="label">Contraseña</label>
                </div>


                <a href="#" class="forgot-password">¿Olvidar Contraseña?</a>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
        </div>
    </div>

    <div id="alerta" class="alert fade in mt-3 alerta"></div>
    

    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../JS/Alerts.js"></script>

</body>

</html>