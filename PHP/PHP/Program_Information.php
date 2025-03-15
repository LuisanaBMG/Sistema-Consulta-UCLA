<?php
// Initialize the session, include database connection settings, require program consultation config, and check user authentication
session_start();

include_once('../Configuration/Connection_DB.php');
require '../Configuration/Program_Table_Consultation.php';

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
    <title>Consultar Progama</title>

    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.24/b-2.2.3/r-2.2.7/sp-1.2.2/sl-1.0.1/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Information_Query.css">
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
                <h2>Consultar Programas</h2>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped data-table table1">
                        <thead>
                            <tr>
                                <!-- Table headers -->
                                <th> </th>
                                <th>CÓDIGO DE PROGRAMA</th>
                                <th>NOMBRE DE PROGRAMA</th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th>COHORTE</th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
                                <th> </th>
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
                            if ($ResultProgram !== false && $ResultProgram->num_rows > 0) {
                                while ($Row = mysqli_fetch_assoc($ResultProgram)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Program"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Program_Code"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Program_Name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Year"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Comment_Programs"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Number_Hours"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Approval_Date"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Cohort"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Cohort"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Number_Females"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Number_Males"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Start_Date"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Termination_Date"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Comment_Cohort"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Program_Types"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Program_Type"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Units"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Attached_Unit"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Organization"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Organization_Name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Resources"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Acronyms_Resource"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#programModal'><i class='bx bx-show-alt'></i></button> ";
                                    echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#programModal'><i class='bx bx-edit'></i></button> ";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Modal form details -->
                <form id="ProgramForm" action="../Configuration/Process_Program.php" method="POST">
                    <!-- Modal content -->
                    <div class="modal fade" id="programModal" tabindex="-1" aria-labelledby="programModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="programModalLabel">Detalles del Programa</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row g-3">

                                        <input type="hidden" id="Id_Program" name="Id_Program">
                                        <input type="hidden" id="Id_Cohort" name="Id_Cohort">
                                        <input type="hidden" id="Id_Program_Types" name="Id_Program_Types">
                                        <input type="hidden" id="Id_Units" name="Id_Units">
                                        <input type="hidden" id="Id_Organization" name="Id_Organization">


                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label for="Program_Code" class="form-label">Código de Programa</label>
                                                <input type="text" class="form-control" id="Program_Code" name="Program_Code" readonly>
                                            </div>


                                            <div class="mb-3">
                                                <label for="Number_Hours" class="form-label">Número de Horas</label>
                                                <input type="text" class="form-control" id="Number_Hours" name="Number_Hours" required oninput="numbersOnly(this)">
                                            </div>


                                            <div class="mb-3">
                                                <label for="Comment_Programs" class="form-label">Observación de programa</label>
                                                <input type="text" class="form-control" id="Comment_Programs" name="Comment_Programs">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Number_Females" class="form-label">Cantidad de Estudiantes femeninas</label>
                                                <input type="text" class="form-control" id="Number_Females" name="Number_Females" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Cohort" class="form-label">Cohorte</label>
                                                <input type="text" class="form-control" id="Cohort" name="Cohort" readonly>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Termination_Date" class="form-label">Fecha de Culminación de Cohorte</label>
                                                <input type="date" class="form-control" id="Termination_Date" name="Termination_Date" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Comment_Cohort" class="form-label">Observación de Cohorte</label>
                                                <input type="text" class="form-control" id="Comment_Cohort" name="Comment_Cohort">
                                            </div>

                                            <div class="mb-3">

                                                <label for="Attached_Unit" class="form-label">Unidad Adscrita</label>
                                                <input type="text" class="form-control input-ut" id="Attached_Unit" name="Attached_Unit">
                                                <!-- The options will be filled in dynamically  -->
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
                                                        echo "Error al obtener unidades adscriptas: " . mysqli_error($Connection);
                                                    }
                                                    ?>

                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Date" class="form-label">Fecha de Registro</label>
                                                <input type="date" class="form-control" id="Date" name="Date" readonly>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="Program_Name" class="form-label">Nombre de Programa</label>
                                                <input type="text" class="form-control" id="Program_Name" name="Program_Name" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Year" class="form-label">Año</label>
                                                <input type="text" class="form-control" id="Year" name="Year" required oninput="numbersOnly(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Approval_Date" class="form-label">Fecha de Aprobación</label>
                                                <input type="date" class="form-control" id="Approval_Date" name="Approval_Date" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Number_Males" class="form-label">Cantidad de Estudiantes Masculinos</label>
                                                <input type="text" class="form-control" id="Number_Males" name="Number_Males" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Start_Date" class="form-label">Fecha de Inicio de Cohorte</label>
                                                <input type="date" class="form-control" id="Start_Date" name="Start_Date" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Program_Type" class="form-label">Programa de Educación Permanente</label>
                                                <input type="text" class="form-control input-st" id="Program_Type" name="Program_Type">
                                                <!-- The options will be filled in dynamically  -->
                                                <select id="Id_Program_Types" name="Id_Program_Types" class="form-select select-st">
                                                    <option value="" disabled selected>Seleccione el Programa de Educación Permanente</option>
                                                    <?php
                                                    $Program_query = "SELECT Id_Program_Types, Program_Type, Status FROM  program_types WHERE Status='Active'";
                                                    $getProgram = mysqli_query($Connection, $Program_query);

                                                    if ($getProgram) {
                                                        while ($row = mysqli_fetch_assoc($getProgram)) {
                                                            $Id_Program_Types = $row['Id_Program_Types'];
                                                            $Program_Type = $row['Program_Type'];
                                                    ?>
                                                            <option value="<?php echo $Id_Program_Types; ?>"><?php echo $Program_Type; ?></option>
                                                    <?php
                                                        }
                                                        mysqli_free_result($getProgram);
                                                    } else {
                                                        echo "Error al obtener los programas de educación permanente: " . mysqli_error($Connection);
                                                    }
                                                    ?>

                                                </select>

                                            </div>

                                            <div class="mb-3">

                                                <label for="Organization_Name" class="form-label">Nombre de Organización externa</label>
                                                <input type="text" class="form-control input-ac" id="Organization_Name" name="Organization_Name" required>

                                                <select id="Id_Organization" name="Id_Organization" class="form-select select-ac">
                                                    <option value="" disabled selected>Seleccione Organización externa</option>
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
                                                        echo "Error al obtener ls academias: " . mysqli_error($Connection);
                                                    }
                                                    ?>
                                                </select>
                                            </div>

                                            <div class="mb-3">

                                                <label for="Acronyms_Resource" class="form-label">Unidad Generadora de Recursos</label>
                                                <input type="text" class="form-control input-ar" id="Acronyms_Resource" name="Acronyms_Resource">
                                                <!-- The options will be filled in dynamically  -->
                                                <select id="Id_Resources" name="Id_Resources" class="form-select select-ar">
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



                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-st" data-bs-toggle="modal" data-bs-target="#SaveProgram">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-st" data-bs-toggle="modal" data-bs-target="#DeleteProgram">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Save Modal -->
                    <div class="modal fade" id="SaveProgram" tabindex="-1" aria-labelledby="SaveProgramLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveProgramLabel">Confirmar Registro</h5>
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
                    <div class="modal fade" id="DeleteProgram" tabindex="-1" aria-labelledby="DeleteProgramLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteProgramLabel">Confirmar Eliminación</h5>
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
    <script src="../JS/Modal.js"></script>
    <script src="../JS/Validation.js"></script>
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

    <!-- Handle error messages -->
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