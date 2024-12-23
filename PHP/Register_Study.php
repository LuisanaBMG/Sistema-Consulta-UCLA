<?php
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
    <title>Registrar Tipo de Estudio</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Registration_Forms.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

</head>

<body>

    <header class="header">
        <div class="header_container">
            <img src="../Images/logo_UCLA.png" alt="" class="header_img">
            <a href="Dashboard.php" class="header_logo">UCLA</a>

            <div class="header_search">
                <input type="search" placeholder="Buscar" class="header_input">
                <i class="bx bx-search  header_icon" style="color: #012460;"></i>
            </div>

            <div class="header_toggle">
                <i class="bx bx-menu" id="header-toggle" style="color: #012460;"></i>
            </div>
        </div>
    </header>

    <div class="nav" id="navbar">
        <nav class="nav_container">

            <div>

                <a href="#" class="nav_link nav_logo">
                    <i class="bx bx-chevrons-right nav_icon" style="color: #012460;"></i>
                    <span class="nav_logo-name">UCLA</span>
                </a>


                <div class="nav_list">

                    <div class="nav_items">
                        <h3 class="nav_subtitle">MENÚ</h3>

                        <a href="Dashboard.php" class="nav_link">
                            <i class="bx bx-home-alt nav_icon" style="color: #012460;"></i>
                            <span class="nav_name">Panel Principal</span>
                        </a>

                        <div class="nav_dropdown">
                            <a href="#" class="nav_link active">
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

                    <div class="nav_items">
                        <h3 class="nav_subtitle">PERFIL</h3>

                        <a href="#" class="nav_link">
                            <i class="bx bx-user-plus nav_icon" style="color: #012460;"></i>
                            <span class="nav_name">Usuarios</span>
                        </a>

                        <a href="#" class="nav_link">
                            <i class="bx bx-cog nav_icon" style="color: #012460;"></i>
                            <span class="nav_name">Ajuste</span>
                        </a>
                    </div>
                </div>
            </div>

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

                <form form action="../Configuration/Register_Study.php" method="POST">
                    <div class="details personal">
                        <span class="title">Detalles de tipo de Estudio</span>
                        <div class="fields">

                            <div class="input-field">
                                <label for="">Tipo de Estudio</label>
                                <select id="Id_Study_Types" name="Id_Study_Types">
                                    <option value="" disabled selected>Seleccione el Tipo de Estudio</option>
                                    <?php
                                    $StudyType_query = "SELECT Id_Study_Types, Study_Type, Status FROM study_types WHERE Status='Active'";
                                    $getStudyType = mysqli_query($Connection, $StudyType_query);

                                    if ($getStudyType) {
                                        while ($row = mysqli_fetch_assoc($getStudyType)) {
                                            $Id_Study_Types = $row['Id_Study_Types'];
                                            $Study_Type = $row['Study_Type'];
                                    ?>
                                            <option value="<?php echo $Id_Study_Types; ?>"><?php echo $Study_Type; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getStudyType);
                                    } else {
                                        echo "Error al obtener los tipo de estudio: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Unidad Adscrita</label>
                                <select id="Id_Units" name="Id_Units">
                                    <option value="" disabled selected>Seleccione Unidad Adscrita</option>
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
                                <label for="">Cohorte</label>
                                <input type="text" placeholder="Ingrese Cohorte" id="Cohort" name="Cohort">
                            </div>

                            <div class="input-field">
                                <label for="">Año</label>
                                <input type="text" placeholder="Ingrese Año" id="Year" name="Year">
                            </div>

                            <div class="input-field">
                                <label for="">Academia</label>
                                <select id="Id_Academy" name="Id_Academy">
                                    <option value="" disabled selected>Seleccione Academia</option>
                                    <?php
                                    $Academy_query = "SELECT Id_Academy, Academy_Name, Status FROM academy WHERE Status='Active'";
                                    $getAcademy = mysqli_query($Connection, $Academy_query);

                                    if ($getAcademy) {
                                        while ($row = mysqli_fetch_assoc($getAcademy)) {
                                            $Id_Academy = $row['Id_Academy'];
                                            $Academy_Name = $row['Academy_Name'];
                                    ?>
                                            <option value="<?php echo $Id_Academy; ?>"><?php echo $Academy_Name; ?></option>
                                    <?php
                                        }
                                        mysqli_free_result($getAcademy);
                                    } else {
                                        echo "Error al obtener las academias: " . mysqli_error($Connection);
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Número Identificación</label>
                                <input type="text" placeholder="Ingrese Número de Identificación" id="Identification_Document" name="Identification_Document">
                            </div>

                            <div class="input-field">
                                <label for="">Nombre de Estudio</label>
                                <input type="text" placeholder="Ingrese Nombre de Estudio" id="Study_Name" name="Study_Name">
                            </div>

                            <div class="input-field">
                                <label for="">Responsable Asociado</label>
                                <select id="Id_RA" name="Id_RA">
                                    <option value="" disabled selected>Seleccione Responsable Asociado</option>

                                    <?php
                                    // Database connection check
                                    if (!mysqli_connect_errno()) {
                                        $responsibleA_query = "SELECT Id_RA, A_Name, Full_Name FROM responsible_associate";

                                        if ($result = mysqli_query($Connection, $responsibleA_query)) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $Id_RA = $row['Id_RA'];
                                                $A_Name = $row['A_Name'];
                                                $Full_Name = $row['Full_Name'] ?? '';

                                                echo "<option value='$Id_RA'>$A_Name - $Full_Name</option>";
                                            }

                                            mysqli_free_result($result);
                                        } else {
                                            echo "Error al obtener los responsables asociados: " . mysqli_error($Connection);
                                        }
                                    }
                                    ?>

                                </select>
                            </div>

                            <div class="input-field">
                                <label for="">Número de Horas</label>
                                <input type="text" placeholder="Ingrese Número de Horas" id="Number_Hours" name="Number_Hours">
                            </div>

                            <div class="input-field">
                                <label for="">Observación</label>
                                <input type="text" placeholder="Ingrese Observación" id="Comment_Studies" name="Comment_Studies">
                            </div>
                        </div>

                        <button type="button" class="btn btn-primary btn-save" data-bs-toggle="modal" data-bs-target="#SaveStudie">Guardar</button>

                    </div>

                    <div class="modal fade" id="SaveStudie" tabindex="-1" aria-labelledby="SaveStudieLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveStudieLabel">Confirmar Registro</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea registrar el tipo de estudio?
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

    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../JS/Sidebar.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <!-- Toastr JS -->
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