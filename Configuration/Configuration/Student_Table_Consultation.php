<?php
if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

try {
    $QueryStudent = "SELECT Id_Student, Document_Type, Identification_Document, First_Name, Second_Name, First_LastName, Second_LastName, Email, Phone_Number, Gender, Social_Network, Comment_Student, Id_Student_Programs, Id_Program,  Program_Name, Book, Folio, Line, Comment_SS, Date, Student_Code FROM student_consultation";
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
