<?php
session_start();
include_once('../Configuration/Connection_DB.php');

if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

$Id_User = $_SESSION['Id_User'];

function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$Id_Program = intval(validate($_POST['Id_Program']));
$Number_Females = intval(validate($_POST['Number_Females']));
$Number_Males = intval(validate($_POST['Number_Males']));
$Start_Date = validate($_POST['Start_Date']);
$Termination_Date = validate($_POST['Termination_Date']);
$Comment_Cohort = !empty($_POST['Comment_Cohort']) ? strtoupper(validate($_POST['Comment_Cohort'])) : '';
$Status = 'Active';

// Validación de campos requeridos
if (empty($Id_Program) || empty($Number_Females) || empty($Number_Males) || empty($Start_Date) || empty($Termination_Date)) {
    header("Location: ../PHP/Register_Cohort.php?error=Datos_Vacios");
    exit();
}

// Obtener el siguiente número de cohorte para el programa
$NextCohortQuery = "SELECT IFNULL(MAX(Cohort), 0) as LastCohort 
                    FROM Cohort 
                    WHERE Id_Program = ?";
$NextCohortStmt = $Connection->prepare($NextCohortQuery);
$NextCohortStmt->bind_param("i", $Id_Program);
$NextCohortStmt->execute();
$NextCohortResult = $NextCohortStmt->get_result();
$NextCohortRow = $NextCohortResult->fetch_assoc();

// Generar el nuevo número de cohorte
$Cohort = str_pad(($NextCohortRow['LastCohort'] + 1), 3, '0', STR_PAD_LEFT);

// Insertar el nuevo registro de cohorte
$CohortRegistration = $Connection->prepare("INSERT INTO Cohort (Id_Program, Cohort, Number_Females, Number_Males, Start_Date, Termination_Date, Comment_Cohort, Date, Status) VALUES ( ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
$CohortRegistration->bind_param("isiissss", $Id_Program, $Cohort, $Number_Females, $Number_Males, $Start_Date, $Termination_Date, $Comment_Cohort, $Status);

if ($CohortRegistration->execute()) {
    header("Location: ../PHP/Register_Cohort.php?success=Datos_Registrados");
} else {
    header("Location: ../PHP/Register_Cohort.php?error=error_Registro");
}
