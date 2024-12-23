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

$Id_Studies = intval($_POST['Id_Studies']);
$Id_Study_Types = intval($_POST['Id_Study_Types']);
$Cohort = validate($_POST['Cohort']);
$Id_Academy = intval($_POST['Id_Academy']);
$Study_Name = strtoupper(validate($_POST['Study_Name']));;
$Number_Hours = validate($_POST['Number_Hours']);
$Id_Units = intval($_POST['Id_Units']);
$Year = validate($_POST['Year']);
$Identification_Document = validate($_POST['Identification_Document']);
$Id_RA = intval($_POST['Id_RA']);
$Comment_Studies = strtoupper(validate($_POST['Comment_Studies']));;

$Status = 'Inactive';
$Date = date("Y-m-d");


if (empty($action) || empty($Id_Study_Types) || empty($Cohort) || empty($Id_Academy) || empty($Study_Name) || empty($Number_Hours) || empty($Id_Units) || empty($Year) || empty($Identification_Document) || empty($Id_RA) || empty($Comment_Studies)) {
    header("Location: ../PHP/Study_Information.php?error=Datos_Vacios");
    exit();
} else {
    if ($action === 'action_edit') {
        //Update data on studies
        $QueryStudy = "UPDATE studies SET Id_Study_Types = ?, Id_Units = ?, Cohort = ?, Year = ?, Id_Academy = ?, Identification_Document = ?, Study_Name = ?, Id_RA = ?, Number_Hours = ?, Comment_Studies = ?, Date = ? WHERE Id_Studies = ?";
        $stmtStudy  = $Connection->prepare($QueryStudy);
        $stmtStudy->bind_param("iiiiiisiissi", $Id_Study_Types, $Id_Units, $Cohort, $Year, $Id_Academy, $Identification_Document, $Study_Name, $Id_RA, $Number_Hours, $Comment_Studies, $Date, $Id_Studies);
        $stmtStudy->execute();

        header("Location: ../PHP/Study_Information.php?success=Datos_Actualizados");

        if (!$stmtStudy->execute()) {
            header("Location: ../PHP/Study_Information.php?error=error_Actualizar");
        }
    } elseif ($action === 'action_delete') {
        $QueryStudy = "UPDATE studies SET  Status=? WHERE Id_Studies = ?";
        $stmtStudy  = $Connection->prepare($QueryStudy);
        $stmtStudy->bind_param("si", $Status,  $Id_Studies);
        $stmtStudy->execute();

        header("Location: ../PHP/Study_Information.php?success=Registro_Eliminado");

        if (!$stmtStudyType->execute()) {
            header("Location: ../PHP/Study_Information.php?error=error_Eliminar_Registro");
        }
    } else {
        echo "Error: Acción no válida";
    }
}
