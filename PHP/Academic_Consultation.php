<?php
session_start();
include_once('../Configuration/Connection_DB.php');

require '../Configuration/Academic_Consultation.php';

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
    <title>Consultar Datos Académicos</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-2.2.3/r-2.2.7/sp-1.2.2/sl-1.0.1/datatables.min.css" />
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Academic_Consultation.css">
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
                <h2 class="mb-4">Consultar Datos Académicos</h2>

                <div class="mb-3">
                    <label for="Consult_Data" class="form-label">Seleccione el tipo de consulta</label>
                    <select id="Consult_Data" name="Consult_Data" class="form-select" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="section1">Tipo de Estudio</option>
                        <option value="section2">Unidades Adscritas</option>
                        <option value="section3">Número de Academia</option>
                        <option value="section4">Unidad Generadora de Recursos</option>
                        <option value="section5">Asociados</option>
                        <option value="section6">Responsable</option>
                        <option value="section7">Asociados Responsables</option>
                    </select>
                </div>

                <div id="section1" class="mb-4">
                    <h3>Consultar Tipos de Estudios</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table1">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>DIMINUTIVO DE ESTUDIO</th>
                                    <th>NOMBRE DE ESTUDIO</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultStudyType !== false && $ResultStudyType->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultStudyType)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Study_Types"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Diminutive_Study"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Study_Type"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#studyTypeModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#studyTypeModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="studyTypeForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                    <div class="modal fade" id="studyTypeModal" tabindex="-1" aria-labelledby="studyTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="studyTypeModalLabel">Detalles del Tipo de Estudio</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" id="Id_Study_Types" name="Id_Study_Types">
                                    <div class="mb-3">
                                        <label for="Diminutive_Study" class="form-label">Diminutivo del Tipo de Estudio</label>
                                        <input type="text" class="form-control" id="Diminutive_Study" name="Diminutive_Study">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Study_Type" class="form-label">Nombre del Tipo de Estudio</label>
                                        <input type="text" class="form-control" id="Study_Type" name="Study_Type">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Date" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Date_Study" name="Date_Study" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-btn" data-bs-toggle="modal" data-bs-target="#SaveType">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#DeleteType">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveType" tabindex="-1" aria-labelledby="SaveTypeLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveTypeLabel">Confirmar Guardado</h5>
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

                    <div class="modal fade" id="DeleteType" tabindex="-1" aria-labelledby="DeleteTypeLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteTypeLabel">Confirmar Eliminación</h5>
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


                <div id="section2" class="mb-4">
                    <h3>Consultar Unidades Adscritas</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table2">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>DIMINUTIVO DE UNIDAD</th>
                                    <th>NOMBRE DE UNIDAD</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultUnits !== false && $ResultUnits->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultUnits)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Units"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Diminutive_Unit"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Attached_Unit"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#unitModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#unitModal'><i class='bx bx-edit'></i></button> ";
                                        //echo "<button class='btn btn-sm btn-danger delete-btn'><i class='bx bx-trash'></i></button>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form id="unitForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                    <div class="modal fade" id="unitModal" tabindex="-1" aria-labelledby="unitModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="unitModalLabel">Detalles de la Unidad Adscrita</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" id="Id_Units" name="Id_Units">
                                    <div class="mb-3">
                                        <label for="Diminutive_Unit" class="form-label">Diminutivo de la Unidad Adscrita</label>
                                        <input type="text" class="form-control" id="Diminutive_Unit" name="Diminutive_Unit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Attached_Unit" class="form-label">Nombre de la Unidad Adscrita</label>
                                        <input type="text" class="form-control" id="Attached_Unit" name="Attached_Unit">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Date_Unit" class="form-label">Fecha de Registro</label>
                                        <input type="Date" class="form-control" id="Date_Unit" name="Date_Unit" readonly>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <!--<button type="button" class="btn btn-secondary close" data-bs-dismiss="modal">Cerrar</button>-->
                                    <button type="button" class="btn btn-primary save-changes-unit" data-bs-toggle="modal" data-bs-target="#SaveUnit">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-unit" data-bs-toggle="modal" data-bs-target="#DeleteUnit">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveUnit" tabindex="-1" aria-labelledby="SaveUnitLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveUnitLabel">Confirmar Guardado</h5>
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

                    <div class="modal fade" id="DeleteUnit" tabindex="-1" aria-labelledby="DeleteUnitLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteUnitLabel">Confirmar Eliminación</h5>
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

                <div id="section3" class="mb-4">
                    <h3>Consultar Academia</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table3">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>NÚMERO DE ACADEMIA</th>
                                    <th>NOMBRE DE ACADEMIA</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultAcademy !== false && $ResultAcademy->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultAcademy)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Academy"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Academy_Number"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Academy_Name"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#academyModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#academyModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="academyForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                    <div class="modal fade" id="academyModal" tabindex="-1" aria-labelledby="academyModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="academyModalLabel">Detalles de la Academia</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="Id_Academy" name="Id_Academy">

                                    <div class="mb-3">
                                        <label for="Academy_Number" class="form-label">Número de Academia</label>
                                        <input type="text" class="form-control" id="Academy_Number" name="Academy_Number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Academy_Name" class="form-label">Nombre de la Academia</label>
                                        <input type="text" class="form-control" id="Academy_Name" name="Academy_Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Academy_Date" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Academy_Date" name="Academy_Date" readonly>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-ac" data-bs-toggle="modal" data-bs-target="#SaveAc">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-ac" data-bs-toggle="modal" data-bs-target="#DeleteAc">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveAc" tabindex="-1" aria-labelledby="SaveAcLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveAcLabel">Confirmar Guardado</h5>
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

                    <div class="modal fade" id="DeleteAc" tabindex="-1" aria-labelledby="DeleteAcLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteAcLabel">Confirmar Eliminación</h5>
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



                <div id="section4" class="mb-4">
                    <h3>Consultar Unidad de Recursos</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table4">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>DIMINUTIVO DE UNIDAD DE RECURSO</th>
                                    <th>NOMBRE DE UNIDAD DE RECURSO</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultUnitResources !== false && $ResultUnitResources->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultUnitResources)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Resources"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Diminutive_Resource"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Resource_Name"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#resourceModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#resourceModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="resourcesForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                    <div class="modal fade" id="resourceModal" tabindex="-1" aria-labelledby="resourceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="resourceModalLabel">Detalles de la Unidad de Recursos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" id="Id_Resources" name="Id_Resources">

                                    <div class="mb-3">
                                        <label for="Diminutive_Resource" class="form-label">Diminutivo de la Unidad de Recursos</label>
                                        <input type="text" class="form-control" id="Diminutive_Resource" name="Diminutive_Resource">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Resource_Name" class="form-label">Nombre de la Unidad de Recursos</label>
                                        <input type="text" class="form-control" id="Resource_Name" name="Resource_Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Date_Resource" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Date_Resource" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-ur" data-bs-toggle="modal" data-bs-target="#SaveUr">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-ur" data-bs-toggle="modal" data-bs-target="#DeleteUr">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveUr" tabindex="-1" aria-labelledby="SaveUrLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveUrLabel">Confirmar Guardado</h5>
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

                    <div class="modal fade" id="DeleteUr" tabindex="-1" aria-labelledby="DeleteUrLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteUrLabel">Confirmar Eliminación</h5>
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


                <div id="section5" class="mb-4">
                    <h3>Consultar Asociados</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table5">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>NOMBRE DE ASOCIADO</th>
                                    <th>OBSERVACIÓN</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultAssociate !== false && $ResultAssociate->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultAssociate)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Associate"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Associate_Name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Associate_Comment"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#associateModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#associateModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="associateForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                    <div class="modal fade" id="associateModal" tabindex="-1" aria-labelledby="associateModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="associateModalLabel">Detalles del Asociado</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" id="Id_Associate" name="Id_Associate">

                                    <div class="mb-3">
                                        <label for="Associate_Name" class="form-label">Nombre del Asociado</label>
                                        <input type="text" class="form-control" id="Associate_Name" name="Associate_Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Associate_Comment" class="form-label">Observación</label>
                                        <input type="text" class="form-control" id="Associate_Comment" name="Associate_Comment">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Associate_Date" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Associate_Date" name="Associate_Date" readonly>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-as" data-bs-toggle="modal" data-bs-target="#SaveAs">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-as" data-bs-toggle="modal" data-bs-target="#DeleteAs">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveAs" tabindex="-1" aria-labelledby="SaveAsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveAsLabel">Confirmar Guardado</h5>
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

                    <div class="modal fade" id="DeleteAs" tabindex="-1" aria-labelledby="DeleteAsLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteAsLabel">Confirmar Eliminación</h5>
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


                <div id="section6" class="mb-4">
                    <h3>Consultar Responsables</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table6">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th style="display:none;">ID</th>
                                    <th style="display:none;">ID</th>
                                    <th style="display:none;">TIPO DE IDENTIFICACIÓN</th>
                                    <th>IDENTIFICACIÓN</th>
                                    <th style="display:none;">FECHA DE CUMPLEAÑOS</th>
                                    <th>NOMBRE</th>
                                    <th style="display:none;">SEGUNDO NOMBRE</th>
                                    <th style="display:none;">PRIMER APELLIDO</th>
                                    <th style="display:none;">SEGUNDO APELLIDO</th>
                                    <th style="display:none;">TELÉFONO</th>
                                    <th style="display:none;">CORREO</th>
                                    <th style="display:none;">GENERO</th>
                                    <th style="display:none;">OBSERVACION</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultResponsibles !== false && $ResultResponsibles->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultResponsibles)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_Responsible"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Document_Type"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Identification_Document"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Document_Type"] . " " . $Row["Identification_Document"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date_Birth"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Firts_Name"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Second_Name"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["First_LastName"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Second_LastName"]) . "</td>";
                                        $combinedName = '';
                                        if (isset($Row['Firts_Name'])) $combinedName .= $Row['Firts_Name'];
                                        if (isset($Row['Second_Name'])) $combinedName .= ' ' . $Row['Second_Name'];
                                        if (isset($Row['First_LastName'])) $combinedName .= ' ' . $Row['First_LastName'];
                                        if (isset($Row['Second_LastName'])) $combinedName .= ' ' . $Row['Second_LastName'];
                                        $combinedName = rtrim($combinedName, ' ');
                                        echo "<td>" . htmlspecialchars($combinedName) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Phone_Number"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Email"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Gender"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Comment_Responsible"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#responsibleModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#responsibleModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="responsibleForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                    <div class="modal fade" id="responsibleModal" tabindex="-1" aria-labelledby="responsibleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="responsibleModalLabel">Detalles del Responsable</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="Id_Responsible" name="Id_Responsible">

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="Document_Type" class="form-label">Tipo de Documento</label>
                                                <select id="Document_Type" name="Document_Type" class="form-select">
                                                    <option value="" disabled selected>Seleccione un tipo de documento</option>
                                                    <option value="V-">Venezolano</option>
                                                    <option value="J-">Persona Jurídica</option>
                                                    <option value="P-">Pasaporte</option>
                                                    <option value="E-">Extranjero</option>
                                                    <option value="G-">Entidad Gubernamental</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Firts_Name" class="form-label">Primer Nombre</label>
                                                <input type="text" class="form-control" id="Firts_Name" name="Firts_Name">
                                            </div>

                                            <div class="mb-3">
                                                <label for="First_LastName" class="form-label">Primer Apellido</label>
                                                <input type="text" class="form-control" id="First_LastName" name="First_LastName">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Date_Birth" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="Date_Birth" name="Date_Birth">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Email" class="form-label">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="Email" name="Email">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Date_Responsible" class="form-label">Fecha de Registro</label>
                                                <input type="date" class="form-control" id="Date_Responsible" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="Identification_Document" class="form-label">Número de Identificación</label>
                                                <input type="text" class="form-control" id="Identification_Document" name="Identification_Document" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Second_Name" class="form-label">Segundo Nombre</label>
                                                <input type="text" class="form-control" id="Second_Name" name="Second_Name">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Second_LastName" class="form-label">Segundo Apellido</label>
                                                <input type="text" class="form-control" id="Second_LastName" name="Second_LastName">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Phone_Number" class="form-label">Número de Teléfono</label>
                                                <input type="text" class="form-control" id="Phone_Number" name="Phone_Number">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Gender" class="form-label">Género</label>
                                                <select id="Gender" name="Gender" class="form-select">
                                                    <option value="" disabled selected>Seleccione Género</option>
                                                    <option value="Female">Femenino</option>
                                                    <option value="Male">Masculino</option>
                                                    <option value="Other">Otro</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Comment_Responsible" class="form-label">Observación del Responsable</label>
                                                <input type="text" class="form-control" id="Comment_Responsible">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-rp" data-bs-toggle="modal" data-bs-target="#SaveRp">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-rp" data-bs-toggle="modal" data-bs-target="#DeleteRp">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="SaveRp" tabindex="-1" aria-labelledby="SaveRpLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveRpLabel">Confirmar Guardado</h5>
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

                    <div class="modal fade" id="DeleteRp" tabindex="-1" aria-labelledby="DeleteRpLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteRpLabel">Confirmar Eliminación</h5>
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


                <div id="section7" class="mb-4">
                    <h3>Consultar Asociados Responsables</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table7">
                            <thead>
                                <tr>
                                    <th style="display:none;">ID</th>
                                    <th>NOMBRE DE ASOCIADO</th>
                                    <th>NOMBRE DE RESPONSABLE</th>
                                    <th style="display:none;">FECHA</th>
                                    <th>ACCIÓN</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if ($ResultResponsibleAssociate !== false && $ResultResponsibleAssociate->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultResponsibleAssociate)) {
                                        echo "<tr>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Id_RA"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["A_Name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Full_Name"]) . "</td>";
                                        echo "<td style='display:none;'>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#ARModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal fade" id="ARModal" tabindex="-1" aria-labelledby="ARModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="ARModalLabel">Detalles del Asociado Responsable</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form id="ARForm" action="../Configuration/Process_Academic_Data.php" method="POST">
                                <div class="modal-body">
                                    <input type="hidden" class="form-control" id="Id_RA" name="Id_RA">

                                    <div class="mb-3 input">
                                        <label for="A_Name" class="form-label">Nombre del Asociado</label>
                                        <input type="text" class="form-control custom-input" id="A_Name" name="A_Name">
                                        <label for="A_Name" class="form-label">Nombre del Responsable</label>
                                        <input type="text" class="form-control custom-input" id="Full_Name" name="Full_Name">
                                    </div>

                                    <div class="select">
                                        <div class="mb-3">
                                            <label for="A_Name" class="form-label">Nombre del Asociado</label>
                                            <select id="A_Name" name="A_Name" class="form-select custom-select">
                                                <option value="" disabled selected>Seleccione un Asociado</option>
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

                                        <div class="mb-3">
                                            <label for="Responsible_ID" class="form-label">Nombre del Responsable</label>
                                            <select id="Responsible_ID" name="Responsible_ID" class="form-select custom-select">
                                                <option value="" disabled selected>Seleccione un Responsable</option>
                                                <?php
                                                $responsibles_query = "SELECT Id_Responsible, Firts_Name, First_LastName, Status FROM responsibles WHERE Status='Active'";
                                                $getResponsibles = mysqli_query($Connection, $responsibles_query);

                                                if ($getResponsibles) {
                                                    while ($row = mysqli_fetch_assoc($getResponsibles)) {
                                                        $Id_Responsible = $row['Id_Responsible'];
                                                        $FullName = $row['Firts_Name'] . ' ' . $row['First_LastName'];
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

                                    <div class="mb-3">
                                        <label for="Date_AR" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Date_AR" name="Date_AR" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="action_edit" value="action_edit" class="btn btn-primary save-changes-asr" style="display: none;">Guardar Cambios</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </main>

    <script src="../JS/Modal.js"></script>
    <script src="../JS/Sidebar.js"></script>
    <script src="../JS/Academic_Consultation.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
                        message = 'Datos actualizados con éxito.';
                        break;
                    case 'Registro_Eliminado':
                        message = 'Registro eliminado con éxito.';
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
                    case 'error_Actualizar':
                        message = 'Error al actualizar los datos.';
                        break;
                    case 'error_Eliminar_Registro':
                        message = 'Error al eliminar el registro.';
                        break;
                    case 'error_preparar_consulta':
                        message = 'Error al preparar la consulta de socios responsables.';
                        break;
                    case 'error_ejecutar_consulta':
                        message = 'Error al ejecutar la consulta de socios responsables.';
                        break;
                    case 'error_Ejecucion':
                        message = 'Error al ejecutar las consultas.';
                        break;
                    case 'Error_BaseDatos':
                        message = 'Error con la base de datos.';
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