<?php
if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

try {
    $QueryStudy = "SELECT Id_Studies, Study_Code, Study_Name, Cohort, Year, Identification_Document, Number_Hours, Comment_Studies,  Id_Study_Types, Study_Type, Id_Units, Attached_Unit, Id_Academy, Academy_Name, Id_RA, Associate, Date FROM study_consultation";
    $StatementStudy = $Connection->prepare($QueryStudy);
    if ($StatementStudy === false) {
        header("Location: ../PHP/Study_Information.php?error=Error_BaseDatos");
    }
    if (!$StatementStudy->execute()) {
        header("Location: ../PHP/Study_Information.php?error=Error_Ejecucion");
    } 
        $ResultStudy = $StatementStudy->get_result();

        return [
            'study' => $ResultStudy
        ];

} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}