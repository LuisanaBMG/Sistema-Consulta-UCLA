<?php
// Initialize the session, include database connection settings, require study consultation config, and check user authentication
session_start();
include_once('../Configuration/Connection_DB.php');

if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos Académicos</title>

    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Academic_Data.css">
    <link rel="icon" href="../images/favicon-16x16.png" type="image/x-icon">

</head>

<body>
    <!-- Header section -->
    <header class="header">
        <div class="header_container">
            <img src="../Images/logo_UCLA.png" alt="" class="header_img">
            <a href="Dashboard.php" class="header_logo">UNIVERSIDAD CENTROOCCIDENTAL LISANDRO ALVARADO</a>

            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle" style="color: #012460;"></i>
            </div>
        </div>
    </header>

    <!-- Navigation bar -->
    <div class="nav" id="navbar">
        <nav class="nav_container">

            <!-- Navigation items -->
            <div>

                <a href="#" class="nav_link nav_logo">
                    <i class="bx bx-chevrons-right nav_icon" style="color: #012460;"></i>
                    <span class="nav_logo-name">UCLA</span>
                </a>


                <div class="nav_list">

                    <div class="nav_items">
                        <h3 class="nav_subtitle">MENÚ</h3>
                        <!-- Navigation links -->
                        <a href="Dashboard.php" class="nav_link active">
                            <i class="bx bx-home-alt nav_icon" style="color: #012460;"></i>
                            <span class="nav_name">Panel Principal</span>
                        </a>

                        <div class="nav_dropdown">
                            <a href="#" class="nav_link">
                                <i class="bx bx-group nav_icon" style="color: #012460;"></i>
                                <span class="nav_name">Estudiantes</span>
                                <i class="bx bx-chevron-down nav_dropdown-icon" style="color: #012460;"></i>
                            </a>

                            <div class="nav_dropdown-collapse">
                                <div class="nav_dropdown-content">
                                    <a href="Register_Student.php" class="nav_dropdown-item">Registrar</a>
                                    <a href="Student_Information.php" class="nav_dropdown-item">Consultar</a>
                                </div>
                            </div>
                        </div>

                        <div class="nav_dropdown">
                            <a href="#" class="nav_link">
                                <i class="bx bx-book-bookmark nav_icon" style="color: #012460;"></i>
                                <span class="nav_name">Estudios</span>
                                <i class="bx bx-chevron-down nav_dropdown-icon" style="color: #012460;"></i>
                            </a>

                            <div class="nav_dropdown-collapse">
                                <div class="nav_dropdown-content">
                                    <a href="Academic_Data.php" class="nav_dropdown-item">Registrar Datos Académicos</a>
                                    <a href="Academic_Consultation.php" class="nav_dropdown-item">Consultar Datos Académicos</a>
                                    <a href="Register_Study.php" class="nav_dropdown-item">Registrar Tipo de Estudios</a>
                                    <a href="Study_Information.php" class="nav_dropdown-item">Consultar Estudios</a>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!-- <div class="nav_items">
                        <h3 class="nav_subtitle">PERFIL</h3>

                        <a href="#" class="nav_link">
                            <i class="bx bx-user-plus nav_icon" style="color: #012460;"></i>
                            <span class="nav_name">Usuarios</span>
                        </a>

                        <a href="#" class="nav_link">
                            <i class="bx bx-cog nav_icon" style="color: #012460;"></i>
                            <span class="nav_name">Ajuste</span>
                        </a>
                    </div> -->
                </div>
            </div>

            <!-- Logout link -->
            <a href="Sign_Out.php" class="nav_link nav_logout">
                <i class="bx bx-log-out nav_icon" style="color: #012460;"></i>
                <span class="nav_name">Cerrar Sesión</span>
            </a>

        </nav>
    </div>

    <!-- Main content -->
    <main>
        <section>
            <div class="container mt-5">
                <h2 class="mb-4">Registrar Datos Académicos</h2>

                <!-- Registration Form -->
                <form action="../Configuration/Academic_Data.php" id="study_form" method="POST">
                    <div class="mb-3">
                        <label for="Register_Type" class="form-label">Seleccione el tipo de registro</label>
                        <select id="Register_Type" name="Register_Type" class="form-select" required>
                            <option value="" disabled selected>Seleccionar</option>
                            <option value="section1">Tipo de Estudio</option>
                            <option value="section2">Unidades Adscritas</option>
                            <option value="section3">Número de Academia</option>
                            <option value="section4">Unidad Generadora de Recursos</option>
                            <option value="section5">Asociados</option>
                            <option value="section6">Responsable</option>
                            <option value="section7">Responsable a Asociados</option>
                        </select>
                    </div>

                    <div id="section1" class="mb-4">
                        <h3>Registrar Tipo de Estudio</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Study" class="form-label">Siglas</label>
                                <input type="text" placeholder="Ingrese Siglas" class="form-control" id="Register_Study" name="Acronyms_Study">
                            </div>
                            <div class="column">
                                <label for="Register_Study" class="form-label">Nombre del Tipo de Estudio</label>
                                <input type="text" placeholder="Ingrese Nombre" class="form-control" id="Register_Study" name="Study_Type">
                            </div>
                        </div>
                    </div>

                    <div id="section2" class="mb-4">
                        <h3>Registrar Unidad de Adscripción</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Unit" class="form-label">Siglas</label>
                                <input type="text" placeholder="Ingrese Siglas" class="form-control" id="Register_Unit" name="Acronyms_Unit">
                            </div>
                            <div class="column">
                                <label for="Register_Unit" class="form-label">Nombre de Unidad Adscripta</label>
                                <input type="text" placeholder="Ingrese Nombre" class="form-control" id="Register_Unit" name="Attached_Unit">
                            </div>
                        </div>
                    </div>

                    <div id="section3" class="mb-4">
                        <h3>Registrar Academia</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Academy" class="form-label">Número de Academia</label>
                                <input type="text" placeholder="Ingrese Número" class="form-control" id="Register_Academy" name="Academy_Number">
                            </div>
                            <div class="column">
                                <label for="Register_Academy" class="form-label">Nombre de la Academia</label>
                                <input type="text" placeholder="Ingrese Nombre" class="form-control" id="Register_Academy" name="Academy_Name">
                            </div>
                        </div>
                    </div>

                    <div id="section4" class="mb-4">
                        <h3>Registrar Unidad Generadora de Recursos</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Resource" class="form-label">Siglas</label>
                                <input type="text" placeholder="Ingrese Siglas" class="form-control" id="Register_Resource" name="Acronyms_Resource">
                            </div>
                            <div class="column">
                                <label for="Register_Resource" class="form-label">Nombre de Unidad de Recursos</label>
                                <input type="text" placeholder="Ingrese Nombre" class="form-control" id="Register_Resource" name="Resource_Name">
                            </div>
                        </div>
                    </div>

                    <div id="section5" class="mb-4">
                        <h3>Registrar Asociados</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Associate" class="form-label">Nombre de Asociado</label>
                                <input type="text" placeholder="Ingrese Asociado" class="form-control" id="Register_Associate" name="Associate_Name">
                            </div>
                            <div class="column">
                                <label for="Register_Associate" class="form-label">Observación</label>
                                <input type="text" placeholder="Ingrese Nombre" class="form-control" id="Register_Associate" name="Associate_Comment">
                            </div>
                        </div>
                    </div>

                    <div id="section6" class="mb-4">
                        <h3>Registrar Responsable</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Tipo de Documento</label>
                                <select id="Register_Responsible" name="Document_Type" class="form-select">
                                    <option value="" disabled selected>Seleccione un tipo de documento</option>
                                    <option value="V-">Venezolano</option>
                                    <option value="J-">Persona Jurídica</option>
                                    <option value="P-">Pasaporte</option>
                                    <option value="E-">Extranjero</option>
                                </select>
                            </div>
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Documento de Identidad</label>
                                <input type="text" placeholder="Ingrese Documento de Identidad" class="form-control" id="Register_Responsible" name="Identification_Document">
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" placeholder="Fecha de Nacimiento" class="form-control" id="Register_Responsible" name="Date_Birth">
                            </div>
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Primer Nombre</label>
                                <input type="text" placeholder="Ingrese Primer Nombre" class="form-control" id="Register_Responsible" name="First_Name" oninput="lettersOnly(this)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Segundo Nombre</label>
                                <input type="text" placeholder="Ingrese Segundo Nombre" class="form-control" id="Register_Responsible" name="Second_Name" oninput="lettersOnly(this)">
                            </div>
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Primer Apellido</label>
                                <input type="text" placeholder="Ingrese Primer Apellido" class="form-control" id="Register_Responsible" name="First_LastName" oninput="lettersOnly(this)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Segundo Apellido</label>
                                <input type="text" placeholder="Ingrese Segundo Apellido" class="form-control" id="Register_Responsible" name="Second_LastName" oninput="lettersOnly(this)">
                            </div>
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Número de Teléfono</label>
                                <input type="text" placeholder="Ingrese Número de Teléfono" class="form-control" id="Register_Responsible" name="Phone_Number" oninput="numbersOnly(this)">
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Correo Electrónico</label>
                                <input type="email" placeholder="Ingrese Correo" class="form-control" id="Register_Responsible" name="Email" onblur="validateEmail(this)">
                            </div>


                            <div class="column">
                                <label for="Register_Responsible" class="form-label">Género</label>
                                <select id="Register_Responsible" name="Gender" class="form-select">
                                    <option value="" disabled selected>Seleccione Género</option>
                                    <option value="Female">Femenino</option>
                                    <option value="Male">Masculino</option>
                                    <option value="Other">Otro</option>
                                </select>

                            </div>

                            <div class="row">
                                <div class="column">
                                    <label for="Register_Responsible" class="form-label">Observación</label>
                                    <input type="text" placeholder="Ingrese Observación" class="form-control" id="Register_Responsible" name="Comment_Responsible">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div id="section7" class="mb-4">
                        <h3>Responsable a Asociados</h3>
                        <div class="row">
                            <div class="column">
                                <label for="Associate" class="form-label">Nombre de Asociado</label>
                                <select class="form-select" id="Associate" name="Associate">
                                    <option value="" disabled selected>Seleccione un asociado</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $asociados_query = "SELECT Id_Associate, Associate_Name, Status FROM associates WHERE Status='Active'";
                                    $getAsociados = mysqli_query($Connection, $asociados_query);

                                    if ($getAsociados) {
                                        while ($row = mysqli_fetch_assoc($getAsociados)) {
                                            $Id_Associate = $row['Id_Associate'];
                                            $Associate_Name = $row['Associate_Name'];
                                    ?>
                                            <option value="<?php echo $Id_Associate; ?>"><?php echo $Associate_Name; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getAsociados);
                                    } else {
                                        echo "Error al obtener los asociados: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="column">
                                <label for="Responsible" class="form-label">Nombre del Responsable</label>
                                <select class="form-select" id="Responsible" name="Responsible">
                                    <option value="" disabled selected>Seleccione un responsable</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $responsibles_query = "SELECT Id_Responsible, First_Name, First_LastName, Status FROM responsibles WHERE Status='Active'";
                                    $getResponsibles = mysqli_query($Connection, $responsibles_query);

                                    if ($getResponsibles) {
                                        while ($row = mysqli_fetch_assoc($getResponsibles)) {
                                            $Id_Responsible = $row['Id_Responsible'];
                                            $FullName = $row['First_Name'] . ' ' . $row['First_LastName'];
                                    ?>
                                            <option value="<?php echo $Id_Responsible; ?>"><?php echo $FullName; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getResponsibles);
                                    } else {
                                        echo "Error al obtener los responsables: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <button type="button" class="btn btn-primary save-changes-gg" data-bs-toggle="modal" data-bs-target="#SaveData">Guardar</button>
                    </div>

                    <div class="modal fade" id="SaveData" tabindex="-1" aria-labelledby="SaveDataLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveDataLabel">Confirmar Registro</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea registrar estos datos?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </section>
    </main>

    <!-- Include external scripts -->
    <script src="../JS/Sidebar.js"></script>
    <script src="../JS/Confirmation.js"></script>
    <script src="../JS/Academic_Data.js"></script>
    <script src="../JS/Validation.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Handle success messages -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.has('success')) {
                const success = params.get('success');
                let message = '';
                switch (success) {
                    case 'Registro_Exitoso':
                        message = 'Registro exitoso';
                        break;
                    default:
                        message = 'Mensaje de éxito';
                }
                toastr.success(message, 'Éxito', {
                    closeButton: true,
                    progressBar: true,
                    positionClass: 'toast-top-right',
                    timeOut: 5000
                });
            }
        });
    </script>

    <!-- Handle error messages -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.has('error')) {
                const error = params.get('error');
                let message = '';
                switch (error) {
                    case 'Datos_Vacios':
                        message = 'Por favor, complete todos los campos.';
                        break;
                    default:
                        message = 'Mensaje de Error';
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