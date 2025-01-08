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
    <title>Panel Principal</title>

    <!-- External stylesheet links -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="../CSS/Sidebar.css">
    <link rel="stylesheet" href="../CSS/Dashboard.css">
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
            <h1>UNIVERSIDAD CENTROOCCIDENTAL LISANDRO ALVARADO</h1>

            <!-- Display current date and time -->
            <div class="wrap">
                <div class="widget">

                    <div class="date">
                        <p id="day-week" class="day-week"></p>
                        <p id="day" class="day"></p>
                        <p> de </p>
                        <p id="month" class="month"></p>
                        <p> del </p>
                        <p id="year" class="year"></p>
                    </div>

                    <div class="clock">
                        <p id="hours" class="hours"></p>
                        <p>:</p>
                        <p id="minutes" class="minutes"></p>
                        <p>:</p>
                        <div id="second-box" class="second-box">
                            <p id="ampm" class="ampm"></p>
                            <p id="seconds" class="seconds"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Display statistics cards for users, students, and studies -->
            <div class="container mt-5">
                <div class="row">

                    <div class="col-md-4 ">
                        <div class="card mb-4 text-center bg-white">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <i class="bx bx-user-circle" style="color: #ffc800; font-size: 80px;"></i>
                                    </div>

                                    <div class="col">
                                        <!-- User count display -->
                                        <?php
                                        $sqlUser = "SELECT COUNT(*) AS total_User FROM users WHERE Status = 'Active'";
                                        $resultUser  = $Connection->query($sqlUser);

                                        $total_User = 0;
                                        if ($resultUser->num_rows > 0) {
                                            $row = $resultUser->fetch_assoc();
                                            $total_User = $row['total_User'];
                                        }

                                        $formatted_User = sprintf('%02d', $total_User);
                                        ?>
                                        <h3 class="display-3"><?php echo $formatted_User; ?></h3>
                                        <h6>USUARIOS</h6>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-center align-items-center">
                                <a href="#" class="d-flex align-items-center">
                                    <span>Ver Más </span>
                                    <i class='bx bx-chevron-right'></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-4 text-center bg-white">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <i class="bx bx-user" style="color:#8B0000; font-size: 80px;"></i>
                                    </div>

                                    <div class="col">
                                        <!-- User count display -->
                                        <?php
                                        $sqlStudent = "SELECT COUNT(*) AS total_Student FROM student WHERE Status = 'Active'";
                                        $resultStudent  = $Connection->query($sqlStudent);

                                        $total_Student = 0;
                                        if ($resultStudent->num_rows > 0) {
                                            $row = $resultStudent->fetch_assoc();
                                            $total_Student = $row['total_Student'];
                                        }

                                        $formatted_Student = sprintf('%02d', $total_Student);
                                        ?>
                                        <h3 class="display-3"><?php echo $formatted_Student; ?></h3>
                                        <h6>ESTUDIANTES</h6>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-center align-items-center">
                                <a href="Student_Information.php" class="d-flex align-items-center">
                                    <span>Ver Más </span>
                                    <i class='bx bx-chevron-right'></i>
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-4">
                        <div class="card mb-4 text-center bg-white">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <i class="bx bx-book" style="color:#006400; font-size: 80px;"></i>
                                    </div>

                                    <div class="col">
                                        <!-- User count display -->
                                        <?php
                                        $sqlStudies = "SELECT COUNT(*) AS total_Studies FROM studies WHERE Status = 'Active'";
                                        $resultStudies = $Connection->query($sqlStudies);

                                        $total_Studies = 0;
                                        if ($resultStudies->num_rows > 0) {
                                            $row = $resultStudies->fetch_assoc();
                                            $total_Studies = $row['total_Studies'];
                                        }

                                        $formatted_Studies = sprintf('%02d', $total_Studies);
                                        ?>
                                        <h3 class="display-3"><?php echo $formatted_Studies; ?></h3>
                                        <h6>ESTUDIOS</h6>
                                    </div>

                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-center align-items-center">
                                <a href="Study_Information.php" class="d-flex align-items-center">
                                    <span>Ver Más </span>
                                    <i class='bx bx-chevron-right'></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </section>
    </main>

    <!-- Include external scripts -->
    <script src="../JS/Sidebar.js"></script>
    <script src="../JS/Dashboard.js"></script>
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
                    case 'Inicie_Sesion':
                        message = 'Inicio de Sesión Exitoso';
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

</body>

</html>