<?php
if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

try {
    $QueryProgram = "SELECT Id_Program, Program_Code, Program_Name, Year, Comment_Programs, Number_Hours, Approval_Date, Id_Cohort, Cohort, Number_Females, Number_Males, Start_Date,  Termination_Date,  Comment_Cohort,  Id_Program_Types, Program_Type, Id_Units, Attached_Unit, Acronyms_Resource, Id_Organization, Id_Resources, Organization_Name, Date FROM program_consultation";
    $StatementProgram = $Connection->prepare($QueryProgram);

    if ($StatementProgram === false) {
        header("Location: ../PHP/Program_Information.php?error=Error_BaseDatos");
    }
    if (!$StatementProgram->execute()) {
        header("Location: ../PHP/Program_Information.php?error=Error_Ejecucion");
    } 
        $ResultProgram = $StatementProgram->get_result();

        return [
            'program' => $ResultProgram
        ];

} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}