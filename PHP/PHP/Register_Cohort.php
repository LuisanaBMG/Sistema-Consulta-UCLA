<?php
// Initialize the session, include database connection settings, require program consultation config, and check user authentication
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
    <title>Registrar Programa de Educación Permanente</title>

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
                                <span class="nav_name">Programas</span>
                                <i class="bx bx-chevron-down nav_dropdown-icon" style="color: #012460;"></i>
                            </a>

                            <div class="nav_dropdown-collapse">
                                <div class="nav_dropdown-content">
                                    <a href="Program_Data.php" class="nav_dropdown-item">Registrar Datos de Programa</a>
                                    <a href="Program_Consultation.php" class="nav_dropdown-item">Consultar Datos de Programa</a>
                                    <a href="Register_Program.php" class="nav_dropdown-item">Registrar Programa de Educación Permanente</a>
                                    <a href="Register_Cohort.php" class="nav_dropdown-item">Registrar Cohorte</a>
                                    <a href="Program_Information.php" class="nav_dropdown-item">Consultar Programas</a>
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
                <header>Registrar Cohorte</header>

                <!-- Registration Form -->
                <form action="../Configuration/Register_Cohort.php" method="POST">
                    <div class="details ">
                        <span class="title">Detalles de Cohorte</span>
                        <div class="fields">
                            <div class="input-field">
                                <label for="">Programa</label>
                                <select id="Id_Program" name="Id_Program" onchange="showSelection()">
                                    <option value="" disabled selected>Seleccione el Programa</option>
                                    <?php
                                    $Program_query = "SELECT Id_Program, Program_Name, Cohort FROM cohort_consultation";
                                    $getProgram = mysqli_query($Connection, $Program_query);
                                    if ($getProgram) {
                                        while ($row = mysqli_fetch_assoc($getProgram)) {
                                            $Id_Program = $row['Id_Program'];
                                            $Program_Name = $row['Program_Name'];
                                            $Cohort = $row['Cohort'];
                                    ?>
                                            <!-- Create option element with program details
                                             Value stores the program ID
                                             Data attribute stores the cohort information
                                             Text displays the program name to the user -->
                                            <option value="<?php echo $Id_Program; ?>" data-cohort="<?php echo htmlspecialchars($Cohort); ?>"> <?php echo htmlspecialchars($Program_Name); ?> </option>
                                    <?php
                                        }
                                        mysqli_free_result($getProgram);
                                    } else {
                                        echo "Error al obtener los programas de educación permanente: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>

                                <script>
                                    function showSelection() {
                                        // Get reference to the select element
                                        var select = document.getElementById("Id_Program");
                                        // Get the selected option element
                                        var selection = select.options[select.selectedIndex];
                                        // Extract cohort value from data-cohort attribute
                                        var cohort = selection.getAttribute('data-cohort');
                                        // Convert cohort to number, add 1, and pad with leading zeros
                                        var nextCohort = String(parseInt(cohort) + 1).padStart(3, '0');
                                        // Update the Cohort input field with the incremented cohort
                                        document.getElementById("Cohort").value = nextCohort;
                                    }
                                </script>
                            </div>

                            <div class="input-field">
                                <label for="">Cohorte</label>
                                <input type="text" placeholder="Cohorte" id="Cohort" name="Cohort" readonly>
                            </div>

                            <div class="input-field">
                                <label for="">Cantidad de Estudiantes femeninas</label>
                                <input type="text" placeholder="Ingrese Número de estudiantes femeninos" id="Number_Females" name="Number_Females" required>
                            </div>

                            <div class="input-field">
                                <label for="">Cantidad de Estudiantes Masculinos</label>
                                <input type="text" placeholder="Ingrese Número de estudaintes masculinos" id="Number_Males" name="Number_Males" required>
                            </div>

                            <div class="input-field">
                                <label for="">Fecha de Inicio</label>
                                <input type="date" placeholder="Ingrese fecha de inicio" id="Start_Date" name="Start_Date">
                            </div>

                            <div class="input-field">
                                <label for="">Fecha de Culminación</label>
                                <input type="date" placeholder="Ingrese fecha de Culminación" id="Termination_Date" name="Termination_Date">
                            </div>

                            <div class="input-field">
                                <label for="">Observación</label>
                                <input type="text" placeholder="Ingrese Observación" id="Comment_Cohort" name="Comment_Cohort">
                            </div>

                        </div>

                        <button type="button" class="btn btn-primary btn-save" data-bs-toggle="modal" data-bs-target="#SaveCohort">Guardar</button>

                    </div>

                    <!-- Save Modal -->
                    <div class="modal fade" id="SaveCohort" tabindex="-1" aria-labelledby="SaveCohortLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveCohortLabel">Confirmar Registro</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea registrar el Cohorte?
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
                        message = 'Error al registrar Cohorte.';
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