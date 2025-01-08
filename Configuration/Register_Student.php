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

$Document_Type = validate($_POST['Document_Type']);
$Identification_Document = validate($_POST['Identification_Document']);
$First_Name = strtoupper(validate($_POST['First_Name']));
$Second_Name = !empty($_POST['Second_Name']) ? strtoupper(validate($_POST['Second_Name'])) : '';
$First_LastName = strtoupper(validate($_POST['First_LastName']));
$Second_LastName = !empty($_POST['Second_LastName']) ? strtoupper(validate($_POST['Second_LastName'])) : '';
$Date_Birth = validate($_POST['Date_Birth']);
$Phone_Number = validate($_POST['Phone_Number']);
$Email = strtoupper(validate($_POST['Email']));
$Gender = validate($_POST['Gender']);
$Comment_Student = !empty($_POST['Comment_Student']) ? strtoupper(validate($_POST['Comment_Student'])) : '';

$Id_Studies = intval($_POST['Id_Studies']);
$Book = validate($_POST['Book']);
$Folio = validate($_POST['Folio']);
$Line = validate($_POST['Line']);
$Start_Date = validate($_POST['Start_Date']);
$Termination_Date = validate($_POST['Termination_Date']);
$Comment_SS = !empty($_POST['Comment_SS']) ? strtoupper(validate($_POST['Comment_SS'])) : '';

 $Status = 'Active';

if (
    empty($Document_Type) || empty($Identification_Document) || empty($First_Name) || empty($First_LastName) || empty($Date_Birth) ||
    empty($Phone_Number) || empty($Email) || empty($Gender)  || empty($Id_Studies) || empty($Book) ||
    empty($Folio) || empty($Line) || empty($Start_Date) || empty($Termination_Date) ) {

    header("Location: ../PHP/Register_Student.php?error=Datos_Vacios");
    exit();
} else {

    $StudentRegistration = $Connection->prepare("INSERT INTO student (Document_Type, Identification_Document, First_Name, Second_Name, First_LastName, Second_LastName, Date_Birth, Phone_Number, Email, Gender, Comment_Student, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $StudentRegistration->bind_param("ssssssssssss", $Document_Type, $Identification_Document, $First_Name, $Second_Name, $First_LastName, $Second_LastName, $Date_Birth, $Phone_Number, $Email, $Gender, $Comment_Student, $Status);
    $StudentRegistration->execute();

    $Id_Student = $Connection->insert_id;

    $SSRegistration = $Connection->prepare("INSERT INTO student_studies (Id_Student, Id_Studies, Book, Folio, Line, Start_Date, Termination_Date, Comment_SS, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $SSRegistration->bind_param("iiiiissss", $Id_Student, $Id_Studies, $Book, $Folio, $Line, $Start_Date, $Termination_Date, $Comment_SS, $Status);
    $SSRegistration->execute();

    header("Location: ../PHP/Register_Student.php?success=Datos_Registrados");

}
