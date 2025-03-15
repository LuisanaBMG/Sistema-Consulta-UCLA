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
$Phone_Number = validate($_POST['Phone_Number']);
$Email = strtoupper(validate($_POST['Email']));
$Gender = validate($_POST['Gender']);
$Social_Network = !empty($_POST['Social_Network']) ? strtoupper(validate($_POST['Social_Network'])) : '';
$Comment_Student = !empty($_POST['Comment_Student']) ? strtoupper(validate($_POST['Comment_Student'])) : '';

$Id_Program = intval($_POST['Id_Program']);
$Book = validate($_POST['Book']);
$Folio = validate($_POST['Folio']);
$Line = validate($_POST['Line']);
$Comment_SS = !empty($_POST['Comment_SS']) ? strtoupper(validate($_POST['Comment_SS'])) : '';

 $Status = 'Active';

if (
    empty($Document_Type) || empty($Identification_Document) || empty($First_Name) || empty($First_LastName) ||
    empty($Phone_Number) || empty($Email) || empty($Gender) || empty($Social_Network)  || empty($Id_Program) || empty($Book) ||
    empty($Folio) || empty($Line) ) {

    header("Location: ../PHP/Register_Student.php?error=Datos_Vacios");
    exit();
} else {

    $StudentRegistration = $Connection->prepare("INSERT INTO student (Document_Type, Identification_Document, First_Name, Second_Name, First_LastName, Second_LastName,  Phone_Number, Email, Gender, Social_Network, Comment_Student, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $StudentRegistration->bind_param("ssssssssssss", $Document_Type, $Identification_Document, $First_Name, $Second_Name, $First_LastName, $Second_LastName, $Phone_Number, $Email, $Gender, $Social_Network, $Comment_Student, $Status);
    $StudentRegistration->execute();

    $Id_Student = $Connection->insert_id;

    $SSRegistration = $Connection->prepare("INSERT INTO student_programs (Id_Student, Id_Program, Book, Folio, Line, Comment_SS, Date, Status) VALUES ( ?, ?, ?, ?, ?, ?, NOW(), ?)");
    $SSRegistration->bind_param("iiiiiss", $Id_Student, $Id_Program, $Book, $Folio, $Line, $Comment_SS, $Status);
    $SSRegistration->execute();

    header("Location: ../PHP/Register_Student.php?success=Datos_Registrados");

}
