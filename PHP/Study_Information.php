<?php
session_start();
include_once('../Configuration/Connection_DB.php');

require '../Configuration/Study_Consultation.php';

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
    <title>Consulta de Estudios</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-2.2.3/r-2.2.7/sp-1.2.2/sl-1.0.1/datatables.min.css" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Information_Query.css">
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
            <div class="container mt-5">
                <h2>Consultar Estudios</h2>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped data-table">
                        <thead>
                            <tr>
                                <th style="display:none;"> </th>
                                <th>CÓDIGO DE ESTUDIO</th>
                                <th>NOMBRE DE ESTUDIO</th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th style="display:none;"> </th>
                                <th>ACCIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($ResultStudy !== false && $ResultStudy->num_rows > 0) {
                                while ($Row = mysqli_fetch_assoc($ResultStudy)) {
                                    echo "<tr>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Studies"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Study_Code"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Study_Name"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Cohort"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Year"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Identification_Document"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Number_Hours"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Comment_Studies"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Study_Types"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Study_Type"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Units"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Attached_Unit"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Academy"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Academy_Name"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_RA"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Associate"]) . "</td>";
                                    echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#studyModal'><i class='bx bx-show-alt'></i></button> ";
                                    echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#studyModal'><i class='bx bx-edit'></i></button> ";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <form id="StudyForm" action="../Configuration/Process_Study.php" method="POST">
                    <div class="modal fade" id="studyModal" tabindex="-1" aria-labelledby="studyModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="studyModalLabel">Detalles del Estudio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <div class="row g-3">

                                        <input type="hidden" id="Id_Studies" name="Id_Studies">

                                        <div class="mb-3">
                                            <label for="Study_Code" class="form-label">Código de Estudio</label>
                                            <input type="text" class="form-control" id="Study_Code" name="Study_Code" readonly>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <input type="hidden" id="Id_Study_Types" name="Id_Study_Types">
                                                <label for="Study_Type" class="form-label">Tipo de Estudio</label>
                                                <input type="text" class="form-control input-st" id="Study_Type" name="Study_Type">

                                                <select id="Id_Study_Types" name="Id_Study_Types" class="form-select select-st">
                                                    <option value="" disabled selected>Seleccione Tipo de Estudio</option>
                                                    <?php
                                                    $Study_query = "SELECT Id_Study_Types, Study_Type, Status FROM  study_types WHERE Status='Active'";
                                                    $getStudy = mysqli_query($Connection, $Study_query);

                                                    if ($getStudy) {
                                                        while ($row = mysqli_fetch_assoc($getStudy)) {
                                                            $Id_Study_Types = $row['Id_Study_Types'];
                                                            $Study_Type = $row['Study_Type'];
                                                    ?>
                                                            <option value="<?php echo $Id_Study_Types; ?>"><?php echo $Study_Type; ?></option>
                                                    <?php
                                                        }
                                                        mysqli_free_result($getStudy);
                                                    } else {
                                                        echo "Error al obtener los tipo de estuio: " . mysqli_error($Connection);
                                                    }
                                                    ?>

                                                </select>

                                            </div>


                                            <div class="mb-3">
                                                <label for="Cohort" class="form-label">Cohorte</label>
                                                <input type="text" class="form-control" id="Cohort" name="Cohort">
                                            </div>

                                            <div class="mb-3">
                                                <input type="hidden" id="Id_Academy" name="Id_Academy">
                                                <label for="Academy_Name" class="form-label">Nombre de Academia</label>
                                                <input type="text" class="form-control input-ac" id="Academy_Name" name="Academy_Name">

                                                <select id="Id_Academy" name="Id_Academy" class="form-select select-ac">
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
                                                        echo "Error al obtener ls academias: " . mysqli_error($Connection);
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Study_Name" class="form-label">Nombre de Estudio</label>
                                                <input type="text" class="form-control" id="Study_Name" name="Study_Name">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Number_Hours" class="form-label">Número de Horas</label>
                                                <input type="text" class="form-control" id="Number_Hours" name="Number_Hours">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Date" class="form-label">Fecha de Registro</label>
                                                <input type="date" class="form-control" id="Date" name="Date" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <input type="hidden" id="Id_Units" name="Id_Units">
                                                <label for="Attached_Unit" class="form-label">Unidad Adscrita</label>
                                                <input type="text" class="form-control input-ut" id="Attached_Unit" name="Attached_Unit">

                                                <select id="Id_Units" name="Id_Units" class="form-select select-ut">
                                                    <option value="" disabled selected>Seleccione Unidad Adscrita</option>
                                                    <?php

                                                    $Units_query = "SELECT Id_Units, Attached_Unit, Status FROM  attached_units WHERE Status='Active'";
                                                    $getUnits = mysqli_query($Connection, $Units_query);

                                                    if ($getUnits) {
                                                        while ($row = mysqli_fetch_assoc($getUnits)) {
                                                            $Id_Units = $row['Id_Units'];
                                                            $Attached_Unit = $row['Attached_Unit'];
                                                    ?>
                                                            <option value="<?php echo $Id_Units; ?>"><?php echo $Attached_Unit; ?></option>
                                                    <?php
                                                        }
                                                        mysqli_free_result($getUnits);
                                                    } else {
                                                        echo "Error al obtener los tipo de estuio: " . mysqli_error($Connection);
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Year" class="form-label">Año</label>
                                                <input type="text" class="form-control" id="Year" name="Year">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Identification_Document" class="form-label">Número de Identificación</label>
                                                <input type="text" class="form-control" id="Identification_Document" name="Identification_Document">
                                            </div>

                                            <div class="mb-3">
                                                <input type="hidden" id="Id_RA" name="Id_RA">
                                                <label for="Associate" class="form-label">Asociado</label>
                                                <input type="text" class="form-control input-ra" id="Associate" name="Associate">


                                                <select id="Id_RA" name="Id_RA" class="form-select select-ra">
                                                    <option value="" disabled selected>Seleccione Responsable Asociado</option>
                                                    <?php

                                                    $RA_query = "SELECT Id_RA, A_Name, Full_Name FROM  responsible_associate";
                                                    $getRA = mysqli_query($Connection, $RA_query);

                                                    if ($getRA) {
                                                        while ($row = mysqli_fetch_assoc($getRA)) {
                                                            $Id_RA = $row['Id_RA'];
                                                            $A_Name = $row['A_Name'];
                                                            $Full_Name = $row['Full_Name'];
                                                    ?>
                                                            <option value="<?php echo $Id_RA; ?>"><?php echo $A_Name . ' - ' . $Full_Name; ?></option>
                                                    <?php
                                                        }
                                                        mysqli_free_result($getRA);
                                                    } else {
                                                        echo "Error al obtener los tipo de estuio: " . mysqli_error($Connection);
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Comment_Studies" class="form-label">Observación</label>
                                                <input type="text" class="form-control" id="Comment_Studies" name="Comment_Studies">
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-st" data-bs-toggle="modal" data-bs-target="#SaveStudy">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-st" data-bs-toggle="modal" data-bs-target="#DeleteStudy">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveStudy" tabindex="-1" aria-labelledby="SaveStudyLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveStudyLabel">Confirmar Registro</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea guadar los cambios realizados?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="action_btn" value="action_edit" id="action_edit" data-action="action_edit" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="DeleteStudy" tabindex="-1" aria-labelledby="DeleteStudyLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteStudyLabel">Confirmar Eliminación</h5>
                                </div>
                                <div class="modal-body">
                                    ¿Desea eliminar este registro?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" name="action_btn" value="action_delete" id="deleteBtn" data-action="action_delete" class="btn btn-primary">Confirmar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </main>

    <script src="../JS/Modal.js"></script>
    <script src="../JS/Sidebar.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/b-2.2.3/r-2.2.7/sp-1.2.2/sl-1.0.1/datatables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.data-table').DataTable({
                responsive: true,
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/2.1.8/i18n/es-ES.json'
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const params = new URLSearchParams(window.location.search);
            if (params.has('success')) {
                const success = params.get('success');
                let message = '';
                switch (success) {
                    case 'Datos_Actualizados':
                        message = 'Datos actualizados exitosamente';
                        break;
                    case 'Registro_Eliminado':
                        message = 'Registro eliminado exitosamente';
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
                    case 'Error_BaseDatos':
                        message = 'Error con la base de datos.';
                        break;
                    case 'Error_Ejecucion':
                        message = 'Error al ejecutar la consulta.';
                        break;
                    case 'Datos_Vacios':
                        message = 'Error, datos vacíos.';
                        break;
                    case 'error_Actualizar':
                        message = 'Error, al actualizar los datos.';
                        break;
                    case 'error_Eliminar_Registro':
                        message = 'Error el eliminar el registro.';
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