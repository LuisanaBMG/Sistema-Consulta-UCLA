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
                <header>Registrar Programa</header>

                <!-- Registration Form -->
                <form action="../Configuration/Register_Program.php" method="POST">
                    <div class="details ">
                        <span class="title">Detalles de Programa de Educación Permanente</span>
                        <div class="fields">

                            <div class="input-field">
                                <label for="">Programa de Educación Permanente</label>
                                <select id="Id_Program_Types" name="Id_Program_Types">
                                    <option value="" disabled selected>Seleccione el Programa de Educación Permanente</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $ProgramType_query = "SELECT Id_Program_Types, Program_Type, Status FROM program_types WHERE Status='Active'";
                                    $getProgramType = mysqli_query($Connection, $ProgramType_query);

                                    if ($getProgramType) {
                                        while ($row = mysqli_fetch_assoc($getProgramType)) {
                                            $Id_Program_Types = $row['Id_Program_Types'];
                                            $Program_Type = $row['Program_Type'];
                                    ?>
                                            <option value="<?php echo $Id_Program_Types; ?>"><?php echo $Program_Type; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getProgramType);
                                    } else {
                                        echo "Error al obtener los programas de educación permanente: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Unidad Adscrita</label>
                                <select id="Id_Units" name="Id_Units">
                                    <option value="" disabled selected>Seleccione Unidad Adscrita</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $Unit_query = "SELECT Id_Units, Attached_Unit, Status FROM attached_units WHERE Status='Active'";
                                    $getUnit = mysqli_query($Connection, $Unit_query);

                                    if ($getUnit) {
                                        while ($row = mysqli_fetch_assoc($getUnit)) {
                                            $Id_Units = $row['Id_Units'];
                                            $Attached_Unit = $row['Attached_Unit'];
                                    ?>
                                            <option value="<?php echo $Id_Units; ?>"><?php echo $Attached_Unit; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getUnit);
                                    } else {
                                        echo "Error al obtener unidades adscritas: " . mysqli_error($Connection);
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Año</label>
                                <input type="text" placeholder="Ingrese Año" id="Year" name="Year" required oninput="numbersOnly(this)">
                            </div>

                            <div class="input-field">
                                <label for="">Organización Externa</label>
                                <select id="Id_Organization" name="Id_Organization">
                                    <option value="" disabled selected>Seleccione Orgnización Externa</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $Organization_query = "SELECT Id_Organization, Organization_Name, Status FROM organization WHERE Status='Active'";
                                    $getOrganization = mysqli_query($Connection, $Organization_query);

                                    if ($getOrganization) {
                                        while ($row = mysqli_fetch_assoc($getOrganization)) {
                                            $Id_Organization = $row['Id_Organization'];
                                            $Organization_Name = $row['Organization_Name'];
                                    ?>
                                            <option value="<?php echo $Id_Organization; ?>"><?php echo $Organization_Name; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getOrganization);
                                    } else {
                                        echo "Error al obtener las Organizaciones: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Unidad Generadora de Recursos</label>
                                <select id="Id_Resources" name="Id_Resources">
                                    <option value="" disabled selected>Seleccione Unidad</option>
                                    <!-- The options will be filled in dynamically  -->
                                    <?php
                                    $Resources_query = "SELECT Id_Resources, Acronyms_Resource, Resource_Name, Status FROM unit_resources WHERE Status='Active'";
                                    $getResources = mysqli_query($Connection, $Resources_query);

                                    if ($getResources) {
                                        while ($row = mysqli_fetch_assoc($getResources)) {
                                            $Id_Resources = $row['Id_Resources'];
                                            $Acronyms_Resource = $row['Acronyms_Resource'];
                                            $Resource_Name = $row['Resource_Name'];
                                    ?>
                                            <option value="<?php echo $Id_Resources; ?>"><?php echo  "$Acronyms_Resource - $Resource_Name"; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getResources);
                                    } else {
                                        echo "Error al obtener las unidades generadoras: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>


                            <div class="input-field">
                                <label for="">Nombre de Programa</label>
                                <input type="text" placeholder="Ingrese Nombre de Programa" id="Program_Name" name="Program_Name" required>
                            </div>

                            <div class="input-field">
                                <label for="">Número de Horas</label>
                                <input type="text" placeholder="Ingrese Número de Horas" id="Number_Hours" name="Number_Hours" required oninput="numbersOnly(this)">
                            </div>

                            <div class="input-field">
                                <label for="Approval_Date" class="form-label">Fecha de aprobación</label>
                                <input type="date" class="form-control" placeholder="Fecha de Aprobación" id="Approval_Date" name="Approval_Date" required>
                            </div>

                            <div class="input-field">
                                <label for="">Observación</label>
                                <input type="text" placeholder="Ingrese Observación" id="Comment_Programs" name="Comment_Programs">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-save" data-bs-toggle="modal" data-bs-target="#SaveStudie">Guardar</button>

                    </div>

                    <!-- Save Modal -->
                    <div class="modal fade" id="SaveStudie" tabindex="-1" aria-labelledby="SaveStudieLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveStudieLabel">Confirmar Registro</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea registrar el programa de educación permanente?
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