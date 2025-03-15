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

$action = $_POST['action_btn'] ?? '';

$Id_Program = intval(validate($_POST['Id_Program']));
$Id_Program_Types = intval(validate($_POST['Id_Program_Types']));
$Id_Organization = intval(validate($_POST['Id_Organization']));
$Id_Resources= intval(validate($_POST['Id_Resources']));
$Program_Name = strtoupper(validate($_POST['Program_Name']));;
$Number_Hours = validate($_POST['Number_Hours']);
$Approval_Date = validate($_POST['Approval_Date']);
$Id_Units = intval(validate($_POST['Id_Units']));
$Year = validate(validate($_POST['Year']));
$Comment_Programs = !empty($_POST['Comment_Programs']) ? strtoupper(validate($_POST['Comment_Programs'])) : '';

$Status = 'Inactive';
$Date = date("Y-m-d");


$Id_Cohort = intval(validate($_POST['Id_Cohort']));
$Number_Females = intval(validate($_POST['Number_Females']));
$Number_Males = intval(validate($_POST['Number_Males']));
$Start_Date = validate($_POST['Start_Date']);
$Termination_Date = validate($_POST['Termination_Date']);
$Comment_Cohort = !empty($_POST['Comment_Cohort']) ? strtoupper(validate($_POST['Comment_Cohort'])) : '';


if (empty($action) || empty($Id_Program_Types) || empty($Id_Organization) || empty($Id_Resources) || empty($Program_Name) || empty($Number_Hours) || empty($Approval_Date) || empty($Id_Units) || empty($Year) ||  empty($Comment_Programs) ||
empty($Id_Program) ||  empty($Number_Females) || empty($Number_Males) || empty($Start_Date) || empty($Termination_Date) || empty($Comment_Cohort)) {
    header("Location: ../PHP/Program_Information.php?error=Datos_Vacios");
    exit();
} else {
    if ($action === 'action_edit') {
        //Update data on programs
        $QueryProgram = "UPDATE programs SET Id_Program_Types = ?, Id_Units = ?, Year = ?, Id_Organization = ?, Id_Resources = ?, Program_Name = ?, Number_Hours = ?, Approval_Date = ?, Comment_Programs = ?, Date = ? WHERE Id_Program = ?";
        $stmtProgram  = $Connection->prepare($QueryProgram);
        $stmtProgram->bind_param("iiiiisisssi", $Id_Program_Types, $Id_Units, $Year, $Id_Organization, $Id_Resources,  $Program_Name,  $Number_Hours, $Approval_Date, $Comment_Programs, $Date, $Id_Program);
        $stmtProgram->execute();

        $QueryProgram = "UPDATE cohort SET  Number_Females = ?, Number_Males = ?, Start_Date = ?, Termination_Date = ?, Comment_Cohort = ?, Date = ? WHERE Id_Cohort  = ?";
        $stmtProgram  = $Connection->prepare($QueryProgram);
        $stmtProgram->bind_param("iissssi", $Number_Females, $Number_Males, $Start_Date, $Termination_Date, $Comment_Cohort,  $Date, $Id_Cohort);
        $stmtProgram->execute();

        /*$QueryProgram = "UPDATE student_programs SET Start_Date = ?, Termination_Date = ?, Date = ? WHERE Id_Program = ?";
        $stmtProgram  = $Connection->prepare($QueryProgram);
        $stmtProgram->bind_param("sssi", $Start_Date, $Termination_Date, $Date, $Id_Program);
        $stmtProgram->execute();*/

        header("Location: ../PHP/Program_Information.php?success=Datos_Actualizados");

        if (!$stmtProgram->execute()) {
            header("Location: ../PHP/Program_Information.php?error=error_Actualizar");
        }
    } elseif ($action === 'action_delete') {
        $QueryProgram = "UPDATE program SET  Status=? WHERE Id_Program = ?";
        $stmtProgram  = $Connection->prepare($QueryProgram);
        $stmtProgram->bind_param("si", $Status,  $Id_Program);
        $stmtProgram->execute();

        header("Location: ../PHP/Program_Information.php?success=Registro_Eliminado");

        if (!$stmtProgramType->execute()) {
            header("Location: ../PHP/Program_Information.php?error=error_Eliminar_Registro");
        }
    } else {
        echo "Error: Acción no válida";
    }
}
