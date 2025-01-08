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
    <title>Registrar Estudiante</title>

    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Registration_Forms.css">
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

    <main>
        <section>
            <div class="container_form">
                <header>Registrar Estudiante</header>

                <!-- Registration Form -->
                <form action="../Configuration/Register_Student.php" method="POST">
                    <div class="details ">
                        <span class="title">Detalles Personales</span>
                        <div class="fields">

                            <div class="input-field">
                                <label for="Document_Type" class="form-label">Tipo de Documento</label>
                                <select id="Document_Type" name="Document_Type" class="form-select">
                                    <option value="" disabled selected>Seleccione un tipo de documento</option>
                                    <option value="V-">Venezolano</option>
                                    <option value="J-">Persona Jurídica</option>
                                    <option value="P-">Pasaporte</option>
                                    <option value="E-">Extranjero</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="Identification_Document" class="form-label">Documento de Identificación</label>
                                <input type="text" class="form-control" placeholder="Documento de Identificación" id="Identification_Document" name="Identification_Document" required>
                            </div>

                            <div class="input-field">
                                <label for="First_Name" class="form-label">Primer Nombre</label>
                                <input type="text" class="form-control" placeholder="Primer Nombre" id="First_Name" name="First_Name" required oninput="lettersOnly(this)">
                            </div>


                            <div class="input-field">
                                <label for="Second_Name" class="form-label">Segundo Nombre</label>
                                <input type="text" class="form-control" placeholder="Segundo Nombre" id="Second_Name" name="Second_Name" oninput="lettersOnly(this)">
                            </div>

                            <div class="input-field">
                                <label for="First_LastName" class="form-label">Primer Apellido</label>
                                <input type="text" class="form-control" placeholder="Primer Apellido" id="First_LastName" name="First_LastName" required oninput="lettersOnly(this)">
                            </div>

                            <div class="input-field">
                                <label for="Second_LastName" class="form-label">Segundo Apellido</label>
                                <input type="text" class="form-control" placeholder="Segundo Apellido" id="Second_LastName" name="Second_LastName" oninput="lettersOnly(this)">
                            </div>

                            <div class="input-field">
                                <label for="Date_Birth" class="form-label">Fecha de Nacimiento</label>
                                <input type="date" class="form-control" placeholder="Fecha de Nacimiento" id="Date_Birth" name="Date_Birth" required>
                            </div>

                            <div class="input-field">
                                <label for="Phone_Number" class="form-label">Número de Teléfono</label>
                                <input type="text" class="form-control" placeholder="Número de Teléfono" id="Phone_Number" name="Phone_Number" required oninput="validatePhone(this)">
                            </div>

                            <div class="input-field">
                                <label for="Email" class="form-label">Correo Eletrónico</label>
                                <input type="email" class="form-control" placeholder="Correo Eletrónico" id="Email" name="Email" required onblur="validateEmail(this)">
                            </div>

                            <div class="input-field">
                                <label for="Gender">Género</label>
                                <select id="Gender" name="Gender">
                                    <option value="" disabled selected>Seleccione un género</option>
                                    <option value="Female">Femenino</option>
                                    <option value="Male">Masculino</option>
                                    <option value="Other">Otro</option>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="Comment_Student" class="form-label">Observación de Estudiante</label>
                                <input type="text" class="form-control" placeholder="Observación de Estudiante" id="Comment_Student" name="Comment_Student">
                            </div>

                            <div class="input-field">
                                <input type="hidden">
                            </div>
                        </div>

                    </div>

                    <div class="details">
                        <span class="title">Detalles de estudios</span>
                        <div class="fields">


                            <div class="input-field">
                                <label for="Id_Studies">Estudio</label>
                                <select id="Id_Studies" name="Id_Studies">
                                    <option value="" disabled selected>Seleccione estudio</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $Studies_query = "SELECT Id_Studies, Study_Name, Status FROM studies WHERE Status='Active'";
                                    $getStudies = mysqli_query($Connection, $Studies_query);

                                    if ($getStudies) {
                                        while ($row = mysqli_fetch_assoc($getStudies)) {
                                            $Id_Studies = $row['Id_Studies'];
                                            $Study_Name = $row['Study_Name'];
                                    ?>
                                            <option value="<?php echo $Id_Studies; ?>"><?php echo $Study_Name; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getStudies);
                                    } else {
                                        echo "Error al obtener estudios: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="Book" class="form-label">Libro de Estudio</label>
                                <input type="text" class="form-control" placeholder="Libro de Estudio" id="Book" name="Book" oninput="numbersOnly(this)" required>
                            </div>

                            <div class="input-field">
                                <label for="Folio" class="form-label">Folio de Estudio</label>
                                <input type="text" class="form-control" placeholder="Folio de Estudio" id="Folio" name="Folio" oninput="numbersOnly(this)" required>
                            </div>

                            <div class="input-field">
                                <label for="Line" class="form-label">Linea de Estudio</label>
                                <input type="text" class="form-control" placeholder="Linea de Estudio" id="Line" name="Line" oninput="numbersOnly(this)" required>
                            </div>

                            <div class="input-field">
                                <label for="Start_Date" class="form-label">Fecha de Inicio</label>
                                <input type="date" class="form-control" placeholder="Fecha de Inicio" id="Start_Date" name="Start_Date" required>
                            </div>

                            <div class="input-field">
                                <label for="Termination_Date" class="form-label">Fecha de Culminación</label>
                                <input type="date" class="form-control" placeholder="Fecha de Culminación" id="Termination_Date" name="Termination_Date" required>
                            </div>

                            <div class="input-field">
                                <label for="Comment_SS" class="form-label">Observación de Estudio</label>
                                <input type="text" class="form-control" placeholder="Observación de Estudio" id="Comment_SS" name="Comment_SS">
                            </div>

                        </div>
                    </div>

                    <button type="button" class="btn btn-primary btn-save" data-bs-toggle="modal" data-bs-target="#SaveStudent">Guardar</button>

                    <!-- Save Modal -->
                    <div class="modal fade" id="SaveStudent" tabindex="-1" aria-labelledby="SaveStudentLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveStudentLabel">Confirmar Registro</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea registrar estudiante?
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
                    case 'Datos_Registrados':
                        message = 'Registro Exitoso';
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
                        message = 'Complete todos los campos.';
                        break;
                    case 'Error_Registro':
                        message = 'Error al registrar estudiante.';
                        break;
                    default:
                        message = 'Mensaje de error';

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