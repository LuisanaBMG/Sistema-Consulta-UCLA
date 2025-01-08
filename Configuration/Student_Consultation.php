<?php
if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

try {
    $QueryStudent = "SELECT Id_Student, Document_Type, Identification_Document, First_Name, Second_Name, First_LastName, Second_LastName, Date_Birth, Email, Phone_Number, Gender, Comment_Student, Id_Student_Studies, Id_Studies,  Study_Name, Book, Folio, Line, Start_Date, Termination_Date, Comment_SS, Date FROM student_consultation";
    $StatementStudent = $Connection->prepare($QueryStudent);
    if ($StatementStudent === false) {
        header("Location: ../PHP/Student_Information.php?error=Error_BaseDatos");
    }
    if (!$StatementStudent->execute()) {
        header("Location: ../PHP/Student_Information.php?error=Error_Ejecucion");
    }
    $ResultStudent = $StatementStudent->get_result();

    return [
        'Student' => $ResultStudent
    ];
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
