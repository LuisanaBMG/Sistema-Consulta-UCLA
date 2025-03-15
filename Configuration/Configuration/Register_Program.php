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

$Id_Program_Types = intval(validate($_POST['Id_Program_Types']));
$Id_Units = intval(validate($_POST['Id_Units']));
$Year = strtoupper(validate($_POST['Year']));
$Id_Organization = intval(validate($_POST['Id_Organization']));
$Id_Resources= intval(validate($_POST['Id_Resources']));
$Program_Name = strtoupper(validate($_POST['Program_Name']));
$Number_Hours = strtoupper(validate($_POST['Number_Hours']));
$Approval_Date = validate($_POST['Approval_Date']);
$Comment_Programs = !empty($_POST['Comment_Programs']) ? strtoupper(validate($_POST['Comment_Programs'])) : '';


$Status = 'Active';


if (empty($Id_Program_Types) || empty($Id_Units) ||  empty($Year) || empty($Id_Organization)  || empty($Program_Name)  || empty($Number_Hours) ||  empty($Approval_Date) || empty($Comment_Programs)
|| empty($Id_Resources) ) {
    header("Location: ../PHP/Register_Program.php?error=Datos_Vacios");
    exit();
} else {

    // Prepare and execute INSERT query for programs
    $StudieRegistration = $Connection->prepare("INSERT INTO programs (Id_Program_Types, Id_Units, Year, Id_Organization, Id_Resources, Program_Name, Number_Hours, Approval_Date, Comment_Programs, Date, Status) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $StudieRegistration->bind_param("iiiiisisss", $Id_Program_Types, $Id_Units, $Year, $Id_Organization, $Id_Resources, $Program_Name,  $Number_Hours, $Approval_Date, $Comment_Programs, $Status);
    $StudieRegistration->execute();

    header("Location: ../PHP/Register_Program.php?success=Datos_Registrados");
}
