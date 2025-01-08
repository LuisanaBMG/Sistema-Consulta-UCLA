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

$Id_Student = intval($_POST['Id_Student']);
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

$Status = 'Inactive';
$Date = date("Y-m-d");

if (
    empty($Document_Type) || empty($Identification_Document) || empty($First_Name) || empty($First_LastName) || empty($Date_Birth) ||
    empty($Phone_Number) || empty($Email) || empty($Gender)  || empty($Id_Studies) || empty($Book) ||
    empty($Folio) || empty($Line) || empty($Start_Date) || empty($Termination_Date) || empty($action) || empty($Id_Student)
) {

    header("Location: ../PHP/Student_Information.php?error=Datos_Vacios");
    exit();
} else {
    if ($action === 'action_edit') {

        $QueryStudent = "UPDATE student SET Document_Type = ?, Identification_Document = ?, First_Name = ?, Second_Name = ?, First_LastName = ?, 	Second_LastName = ?, Date_Birth = ?, Email = ?, Phone_Number = ?, Gender = ?, Comment_Student = ?, Date = ? WHERE Id_Student = ?";
        $stmtStudent = $Connection->prepare($QueryStudent);
        $stmtStudent->bind_param("ssssssssssssi", $Document_Type, $Identification_Document, $First_Name, $Second_Name, $First_LastName, $Second_LastName, $Date_Birth, $Email, $Phone_Number, $Gender, $Comment_Student, $Date, $Id_Student);
        $stmtStudent->execute();

        if (!$stmtStudent->execute()) {
            header("Location: ../PHP/Student_Information.php?error=error_Actualizar");
        }

        $QuerySS = "UPDATE student_studies SET Id_Studies = ?, Book = ?, Folio = ?, Line = ?, Start_Date = ?, Termination_Date = ?, Comment_SS = ?, Date = ? WHERE Id_Student = ?";
        $stmtSS = $Connection->prepare($QuerySS);
        $stmtSS->bind_param("iiiissssi", $Id_Studies, $Book, $Folio, $Line, $Start_Date, $Termination_Date, $Comment_SS, $Date, $Id_Student);
        $stmtSS->execute();

        if (!$stmtSS->execute()) {
            header("Location: ../PHP/Student_Information.php?error=error_Actualizar");
        }

        header("Location: ../PHP/Student_Information.php?success=Datos_Actualizados");
    } elseif ($action === 'action_delete') {

        $QueryStudent = "UPDATE student SET Status=? WHERE Id_Student = ?";
        $stmtStudent  = $Connection->prepare($QueryStudent);
        $stmtStudent->bind_param("si", $Status,  $Id_Student);
        $stmtStudent->execute();

        if (!$stmtStudent->execute()) {
            header("Location: ../PHP/Student_Information.php?error=error_Eliminar_Registro");
        }

        $QuerySS = "UPDATE student_studies SET Status=? WHERE Id_Student = ?";
        $stmtSS  = $Connection->prepare($QuerySS);
        $stmtSS->bind_param("si", $Status,  $Id_Student);
        $stmtSS->execute();

        if (!$stmtSS->execute()) {
            header("Location: ../PHP/Student_Information.php?error=error_Eliminar_Registro");
        }


        header("Location: ../PHP/Student_Information.php?success=Registro_Eliminado");
    } else {
        echo "Error: Acción no válida";
    }
}
