<?php
// Initialize the session, include database connection settings, require program consultation config, and check user authentication
session_start();
include_once('../Configuration/Connection_DB.php');

require '../Configuration/Program_Consultation.php';

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
    <title>Consultar Datos de Programa</title>

    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-2.2.3/r-2.2.7/sp-1.2.2/sl-1.0.1/datatables.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Program_Consultation.css">
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

    <!-- Main content -->
    <main>
        <section>
            <div class="container mt-5">
                <h2 class="mb-4">Consultar Datos de Programa</h2>

                <div class="mb-3">
                    <label for="Consult_Data" class="form-label">Seleccione el tipo de consulta</label>
                    <select id="Consult_Data" name="Consult_Data" class="form-select" required>
                        <option value="" disabled selected>Seleccionar</option>
                        <option value="section1">Programa de Educación Permanente</option>
                        <option value="section2">Unidades Adscritas</option>
                        <option value="section3">Organización Externa</option>
                        <option value="section4">Unidad Generadora de Recursos</option>
                        <option value="section5">Responsable</option>
                    </select>
                </div>

                <div id="section1" class="mb-4">
                    <h3>Consultar Programa de Educación Permanente</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table1">
                            <thead>
                                <tr>
                                    <!-- Table headers -->
                                    <th> </th>
                                    <th>SIGLAS DE PROGRAMA</th>
                                    <th>NOMBRE DE PROGRAMA</th>
                                    <th> </th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display data from database
                                if ($ResultProgramType !== false && $ResultProgramType->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultProgramType)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($Row["Id_Program_Types"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Acronyms_Program"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Program_Type"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#programTypeModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#programTypeModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="programTypeForm" action="../Configuration/Process_Program_Data.php" method="POST">
                    <div class="modal fade" id="programTypeModal" tabindex="-1" aria-labelledby="programTypeModalLabel" aria-hidden="true">
                        <div class="modal-dialog  modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="programTypeModalLabel">Detalles del Programa de Educación Permanente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <div class="modal-body">
                                    <input type="hidden" id="Id_Program_Types" name="Id_Program_Types">
                                    <div class="mb-3">
                                        <label for="Acronyms_Program" class="form-label">Siglas del Programa de Educación Permanente</label>
                                        <input type="text" class="form-control" id="Acronyms_Program" name="Acronyms_Program">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Program_Type" class="form-label">Nombre del Programa de Educación Permanente</label>
                                        <input type="text" class="form-control" id="Program_Type" name="Program_Type">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Date" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Date_Program" name="Date_Program" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-btn" data-bs-toggle="modal" data-bs-target="#SaveType">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#DeleteType">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Save Modal -->
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

                    <!-- Delete  Modal -->
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
                                    <!-- Table headers -->
                                    <th>ID</th>
                                    <th>SIGLAS DE UNIDAD</th>
                                    <th>NOMBRE DE UNIDAD</th>
                                    <th>FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display data from database
                                if ($ResultUnits !== false && $ResultUnits->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultUnits)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($Row["Id_Units"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Acronyms_Unit"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Attached_Unit"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#unitModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#unitModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <form id="unitForm" action="../Configuration/Process_Program_Data.php" method="POST">
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
                                        <label for="Acronyms_Unit" class="form-label">Siglas de la Unidad Adscrita</label>
                                        <input type="text" class="form-control" id="Acronyms_Unit" name="Acronyms_Unit">
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
                                    <button type="button" class="btn btn-primary save-changes-unit" data-bs-toggle="modal" data-bs-target="#SaveUnit">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-unit" data-bs-toggle="modal" data-bs-target="#DeleteUnit">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Save Modal -->
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

                    <!-- Delete  Modal -->
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
                    <h3>Consultar Organización Externa</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table3">
                            <thead>
                                <tr>
                                    <!-- Table headers -->
                                    <th>ID</th>
                                    <th>NÚMERO DE ORGANIZACIÓN EXTERNA</th>
                                    <th>NOMBRE DE ORGANIZACIÓN EXTERNA</th>
                                    <th>ID RESPONSABLE</th>
                                    <th>FECHA</th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display data from database
                                if ($ResultOrganization !== false && $ResultOrganization->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultOrganization)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($Row["Id_Organization"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Organization_Number"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Organization_Name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Id_Responsible"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
                                        echo "<td>";
                                        echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#organizationModal'><i class='bx bx-show-alt'></i></button> ";
                                        echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#organizationModal'><i class='bx bx-edit'></i></button> ";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <form id="organizationForm" action="../Configuration/Process_Program_Data.php" method="POST">
                    <div class="modal fade" id="organizationModal" tabindex="-1" aria-labelledby="organizationModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="organizationModalLabel">Detalles de la Organización Externa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <input type="hidden" id="Id_Organization" name="Id_Organization">

                                    <div class="mb-3">
                                        <label for="Organization_Number" class="form-label">Código de Organización Externa</label>
                                        <input type="text" class="form-control" id="Organization_Number" name="Organization_Number">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Organization_Name" class="form-label">Nombre de Organización Externa</label>
                                        <input type="text" class="form-control" id="Organization_Name" name="Organization_Name">
                                    </div>

                                    <div class="mb-3">
                                        <label for="Responsible_Id" class="form-label">Nombre de Responsable</label>
                                        <select id="Responsible_Id" name="Responsible_Id" class="form-select select-id">
                                            <option value="" disabled selected>Seleccione un Responsable</option>
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
                                        <input type="text" class="form-control input-id" id="Responsible" name="Responsible" value="<?php echo htmlspecialchars($FullName); ?>">
                                    </div>


                                    <div class="mb-3">
                                        <label for="Organization_Date" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Organization_Date" name="Organization_Date" readonly>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-ac" data-bs-toggle="modal" data-bs-target="#SaveAc">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-ac" data-bs-toggle="modal" data-bs-target="#DeleteAc">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Save Modal -->
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

                    <!-- Delete  Modal -->
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
                                    <!-- Table headers -->
                                    <th> </th>
                                    <th>SIGLAS DE UNIDAD GENERADORA DE RECURSO</th>
                                    <th>NOMBRE DE UNIDAD GENERADORA DE RECURSO</th>
                                    <th> </th>
                                    <th> </th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display data from database
                                if ($ResultUnitResources !== false && $ResultUnitResources->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultUnitResources)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($Row["Id_Resources"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Acronyms_Resource"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Resource_Name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Approval_Date"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
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

                <form id="resourcesForm" action="../Configuration/Process_Program_Data.php" method="POST">
                    <div class="modal fade" id="resourceModal" tabindex="-1" aria-labelledby="resourceModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="resourceModalLabel">Detalles de la Unidad Generadora de Recursos</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    <input type="hidden" id="Id_Resources" name="Id_Resources">

                                    <div class="mb-3">
                                        <label for="Acronyms_Resource" class="form-label">Siglas de la Unidad Generadora de Recursos</label>
                                        <select id="Acronyms_Resource" name="Acronyms_Resource" class="form-select">
                                            <option value="" disabled selected>Seleccione tipo de unidad de recusos</option>
                                            <option value="UGR">UGR-Unidad Generadora de Recursos</option>
                                            <option value="NGR">NGR-Unidad No Generadora de Recursos</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="Resource_Name" class="form-label">Nombre de la Unidad Generadora de Recursos</label>
                                        <input type="text" class="form-control" id="Resource_Name" name="Resource_Name">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Approval_Date" class="form-label">Fecha de Aprobación</label>
                                        <input type="date" class="form-control" id="Approval_Date" name="Approval_Date">
                                    </div>
                                    <div class="mb-3">
                                        <label for="Date_Resource" class="form-label">Fecha de Registro</label>
                                        <input type="date" class="form-control" id="Date_Resource" name="Date_Resource" readonly>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-ur" data-bs-toggle="modal" data-bs-target="#SaveUr">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-ur" data-bs-toggle="modal" data-bs-target="#DeleteUr">Eliminar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Save Modal -->
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

                    <!-- Delete  Modal -->
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
                    <h3>Consultar Responsables</h3>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-striped data-table table5">
                            <thead>
                                <tr>
                                    <!-- Table headers -->
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th>IDENTIFICACIÓN</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th>NOMBRE</th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th> </th>
                                    <th>ACCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Display data from database
                                if ($ResultResponsibles !== false && $ResultResponsibles->num_rows > 0) {
                                    while ($Row = mysqli_fetch_assoc($ResultResponsibles)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($Row["Id_Responsible"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Document_Type"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Identification_Document"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Document_Type"] . " " . $Row["Identification_Document"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["First_Name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Second_Name"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["First_LastName"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Second_LastName"]) . "</td>";
                                        $combinedName = '';
                                        if (isset($Row['First_Name'])) $combinedName .= $Row['First_Name'];
                                        if (isset($Row['Second_Name'])) $combinedName .= ' ' . $Row['Second_Name'];
                                        if (isset($Row['First_LastName'])) $combinedName .= ' ' . $Row['First_LastName'];
                                        if (isset($Row['Second_LastName'])) $combinedName .= ' ' . $Row['Second_LastName'];
                                        $combinedName = rtrim($combinedName, ' ');
                                        echo "<td>" . htmlspecialchars($combinedName) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Phone_Number"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Email"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Gender"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Type_Responsible"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Status_Responsible"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Comment_Responsible"]) . "</td>";
                                        echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
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

                <form id="responsibleForm" action="../Configuration/Process_Program_Data.php" method="POST">
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
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="First_Name" class="form-label">Primer Nombre</label>
                                                <input type="text" class="form-control" id="First_Name" name="First_Name" oninput="lettersOnly(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="First_LastName" class="form-label">Primer Apellido</label>
                                                <input type="text" class="form-control" id="First_LastName" name="First_LastName" oninput="lettersOnly(this)">
                                            </div>


                                            <div class="mb-3">
                                                <label for="Email" class="form-label">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="Email" name="Email" onblur="validateEmail(this)">
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
                                                <label for="Status_Responsible" class="form-label">Estado del Responsable</label>
                                                <input type="text" class="form-control" id="Status_Responsible" name="Status_Responsible">
                                            </div>


                                            <div class="mb-3">
                                                <label for="Date_Responsible" class="form-label">Fecha de Registro</label>
                                                <input type="date" class="form-control" id="Date_Responsible" name="Date_Responsible" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="Identification_Document" class="form-label">Número de Identificación</label>
                                                <input type="text" class="form-control" id="Identification_Document" name="Identification_Document">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Second_Name" class="form-label">Segundo Nombre</label>
                                                <input type="text" class="form-control" id="Second_Name" name="Second_Name" oninput="lettersOnly(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Second_LastName" class="form-label">Segundo Apellido</label>
                                                <input type="text" class="form-control" id="Second_LastName" name="Second_LastName" oninput="lettersOnly(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Phone_Number" class="form-label">Número de Teléfono</label>
                                                <input type="text" class="form-control" id="Phone_Number" name="Phone_Number" oninput="validatePhone(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Register_Responsible" class="form-label">Tipo de responsable</label>
                                                <input type="text" class="form-control" id="Type_Responsible" name="Type_Responsible">
                                            </div>


                                            <div class="mb-3">
                                                <label for="Comment_Responsible" class="form-label">Observación del Responsable</label>
                                                <input type="text" class="form-control" id="Comment_Responsible" name="Comment_Responsible">
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

                    <!-- Save Modal -->
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

                    <!-- Delete  Modal -->
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

            </div>
        </section>
    </main>

    <!-- Include external scripts -->
    <script src="../JS/Sidebar.js"></script>
    <script src="../JS/Validation.js"></script>
    <script src="../JS/Modal.js"></script>
    <script src="../JS/Program_Consultation.js"></script>
    <script src="../bootstrap/js/jquery.min.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-2.1.8/datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.24/b-2.2.3/r-2.2.7/sp-1.2.2/sl-1.0.1/datatables.min.js"></script>

    <!-- Initialize DataTables plugin -->
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

    <!-- Handle success messages -->
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

    <!-- Handle error messages -->
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
                    case 'acronimo_existe':
                        message = 'Las siglas ya existen para otro programa.';
                        break;
                    case 'documento_existe':
                        message = 'El documento de identificación ya existen para otro reponsable.';
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