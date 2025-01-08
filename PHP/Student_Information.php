<?php
// Initialize the session, include database connection settings, require study consultation config, and check user authentication
session_start();

include_once('../Configuration/Connection_DB.php');
require '../Configuration/Student_Consultation.php';

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
    <title>Consulta de Estudiantes</title>

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
                <h2>Consultar Estudiantes</h2>
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped data-table table2">
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
                                <th>NOMBRE DE ESTUDIANTE</th>
                                <th>NOMBRE DE ESTUDIO</th>
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
                            if ($ResultStudent !== false && $ResultStudent->num_rows > 0) {
                                while ($Row = mysqli_fetch_assoc($ResultStudent)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Student"]) . "</td>";
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
                                    echo "<td>" . htmlspecialchars($Row["Study_Name"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Date_Birth"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Email"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Phone_Number"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Gender"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Comment_Student"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Student_Studies"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Id_Studies"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Book"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Folio"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Line"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Start_Date"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Termination_Date"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Comment_SS"]) . "</td>";
                                    echo "<td>" . htmlspecialchars($Row["Date"]) . "</td>";
                                    echo "<td>";
                                    echo "<button class='btn btn-sm btn-primary view-btn' data-bs-toggle='modal' data-bs-target='#studentModal'><i class='bx bx-show-alt'></i></button> ";
                                    echo "<button class='btn btn-sm btn-secondary edit-btn' data-bs-toggle='modal' data-bs-target='#studentModal'><i class='bx bx-edit'></i></button> ";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <!-- Modal form details -->
                <form id="StudentForm" action="../Configuration/Process_Student.php" method="POST">
                    <!-- Modal content -->
                    <div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <!-- Modal header -->
                                <div class="modal-header">
                                    <h5 class="modal-title" id="studentModalLabel">Detalles del Estudiante</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>

                                <!-- Modal body -->
                                <div class="modal-body">
                                    <div class="row g-3">

                                        <div class="col-md-6">
                                            <input type="hidden" id="Id_Student" name="Id_Student">
                                            <input type="hidden" id="Id_Student_Studies" name="Id_Student_Studies">
                                            <input type="hidden" id="Id_Studies" name="Id_Studies">

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
                                                <input type="text" class="form-control" id="First_Name" name="First_Name" required oninput="lettersOnly(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="First_LastName" class="form-label">Primer Apellido</label>
                                                <input type="text" class="form-control" id="First_LastName" name="First_LastName" required oninput="lettersOnly(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Phone_Number" class="form-label">Número de Teléfono</label>
                                                <input type="text" class="form-control" id="Phone_Number" name="Phone_Number" required oninput="validatePhone(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Date_Birth" class="form-label">Fecha de Nacimiento</label>
                                                <input type="date" class="form-control" id="Date_Birth" name="Date_Birth" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Comment_Student" class="form-label">Observación de Estudiante</label>
                                                <input type="text" class="form-control" id="Comment_Student" name="Comment_Student">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Study_Name" class="form-label">Nombre de Estudio</label>
                                                <input type="text" class="form-control input-sd" id="Study_Name" name="Study_Name">
                                            </div>

                                            <select id="Id_Studies" name="Id_Studies" class="form-select select-sd">
                                                <option value="" disabled selected>Seleccione Estudio</option>
                                                <!-- The options will be filled in dynamically  -->
                                                <?php
                                                $Study_query = "SELECT Id_Studies, Study_Name, Status FROM studies WHERE Status='Active'";
                                                $getStudy = mysqli_query($Connection, $Study_query);

                                                if ($getStudy) {
                                                    while ($row = mysqli_fetch_assoc($getStudy)) {
                                                        $Id_Studies = $row['Id_Studies'];
                                                        $Study_Name = $row['Study_Name'];
                                                ?>
                                                        <option value="<?php echo $Id_Studies; ?>"><?php echo $Study_Name; ?></option>
                                                <?php
                                                    }
                                                    mysqli_free_result($getStudy);
                                                } else {
                                                    echo "Error al obtener los tipo de estuio: " . mysqli_error($Connection);
                                                }
                                                ?>
                                            </select>

                                            <div class="mb-3">
                                                <label for="Folio" class="form-label">Folio de Estudio</label>
                                                <input type="text" class="form-control" id="Folio" name="Folio" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Termination_Date" class="form-label">Fecha de Culminación</label>
                                                <input type="date" class="form-control" id="Termination_Date" name="Termination_Date" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Date" class="form-label">Fecha de Registro</label>
                                                <input type="date" class="form-control" id="Date" name="Date" readonly>
                                            </div>

                                        </div>

                                        <div class="col-md-6">

                                            <div class="mb-3">
                                                <label for="Identification_Document" class="form-label">Documento de Identificación</label>
                                                <input type="text" class="form-control" id="Identification_Document" name="Identification_Document" required>
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
                                                <label for="Email" class="form-label">Correo Eletrónico</label>
                                                <input type="email" class="form-control" id="Email" name="Email" required onblur="validateEmail(this)">
                                            </div>

                                            <div class="mb-3">
                                                <label for="Gender" class="form-label">Género de Estudiante</label>
                                                <select id="Gender" name="Gender" class="form-select">
                                                    <option value="" disabled selected>Seleccione Género</option>
                                                    <option value="Female">Femenino</option>
                                                    <option value="Male">Masculino</option>
                                                    <option value="Other">Otro</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Book" class="form-label">Libro de Estudio</label>
                                                <input type="text" class="form-control" id="Book" name="Book" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Line" class="form-label">Linea de Estudio</label>
                                                <input type="text" class="form-control" id="Line" name="Line" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Start_Date" class="form-label">Fecha de Inicio</label>
                                                <input type="date" class="form-control" id="Start_Date" name="Start_Date" required>
                                            </div>

                                            <div class="mb-3">
                                                <label for="Comment_SS" class="form-label">Observación de Estudio</label>
                                                <input type="text" class="form-control" id="Comment_SS" name="Comment_SS">
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!-- Modal footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary save-changes-sd" data-bs-toggle="modal" data-bs-target="#SaveStudent">Guardar Cambios</button>
                                    <button type="button" class="btn btn-danger delete-btn-sd" data-bs-toggle="modal" data-bs-target="#DeleteStudent">Eliminar</button>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Save Modal -->
                    <div class="modal fade" id="SaveStudent" tabindex="-1" aria-labelledby="SaveStudentLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="SaveStudentLabel">Confirmar Registro</h5>
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
                    <div class="modal fade" id="DeleteStudent" tabindex="-1" aria-labelledby="DeleteStudentLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="DeleteStudentLabel">Confirmar Eliminación</h5>
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