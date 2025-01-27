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

$Id_Study_Types = intval(validate($_POST['Id_Study_Types']));
$Id_Units = intval(validate($_POST['Id_Units']));
$Cohort = strtoupper(validate($_POST['Cohort']));
$Year = strtoupper(validate($_POST['Year']));
$Id_Academy = intval(validate($_POST['Id_Academy']));
$Identification_Document = strtoupper(validate($_POST['Identification_Document']));
$Study_Name = strtoupper(validate($_POST['Study_Name']));
$Id_RA = intval(validate($_POST['Id_RA']));
$Number_Hours = strtoupper(validate($_POST['Number_Hours']));
$Comment_Studies = !empty($_POST['Comment_Studies']) ? strtoupper(validate($_POST['Comment_Studies'])) : '';
$Start_Date = validate($_POST['Start_Date']);
$Termination_Date = validate($_POST['Termination_Date']);

$Status = 'Active';


if (empty($Id_Study_Types) || empty($Id_Units) || empty($Cohort) || empty($Year) || empty($Id_Academy) || empty($Identification_Document) || empty($Study_Name) || empty($Id_RA) || empty($Number_Hours) || empty($Comment_Studies) || empty($Start_Date) || empty($Termination_Date)) {
    header("Location: ../PHP/Register_Study.php?error=Datos_Vacios");
    exit();
} else {

    // Prepare and execute INSERT query for studies
    $StudieRegistration = $Connection->prepare("INSERT INTO studies (Id_Study_Types, Id_Units, Cohort, Year, Id_Academy, Identification_Document, Study_Name, Id_RA, Number_Hours, Start_Date, Termination_Date, Comment_Studies, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $StudieRegistration->bind_param("iiiiiisiissss", $Id_Study_Types, $Id_Units, $Cohort, $Year, $Id_Academy, $Identification_Document, $Study_Name, $Id_RA, $Number_Hours, $Start_Date, $Termination_Date, $Comment_Studies, $Status);
    $StudieRegistration->execute();

    header("Location: ../PHP/Register_Study.php?success=Datos_Registrados");
}
