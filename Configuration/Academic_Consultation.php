<?php
if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

try {

    $QueryStudyType = "SELECT Id_Study_Types, Diminutive_Study, Study_Type, Date, Status FROM study_types WHERE Status = 'Active'";
    $StatementStudyType = $Connection->prepare($QueryStudyType);
    if ($StatementStudyType === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementStudyType->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    } 
        $ResultStudyType = $StatementStudyType->get_result();
       

    $QueryUnits = "SELECT Id_Units, Diminutive_Unit, Attached_Unit, Date, Status FROM attached_units WHERE Status = 'Active'";
    $StatementUnits = $Connection->prepare($QueryUnits);
    if ($StatementUnits === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementUnits->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    }
    $ResultUnits = $StatementUnits->get_result();


    $QueryAcademy = "SELECT Id_Academy, Academy_Number, Academy_Name, Date, Status FROM academy WHERE Status = 'Active'";
    $StatementAcademy = $Connection->prepare($QueryAcademy);
    if ($StatementAcademy === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementAcademy->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    }
    $ResultAcademy = $StatementAcademy->get_result();


    $QueryUnitResources = "SELECT Id_Resources, Diminutive_Resource, Resource_Name, Date, Status FROM unit_resources WHERE Status = 'Active'";
    $StatementUnitResources = $Connection->prepare($QueryUnitResources);
    if ($StatementUnitResources === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementUnitResources->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    }
    $ResultUnitResources = $StatementUnitResources->get_result();


    $QueryAssociate = "SELECT  Id_Associate, Associate_Name, Associate_Comment, Date, Status  FROM associates WHERE Status = 'Active'";
    $StatementAssociate = $Connection->prepare($QueryAssociate);
    if ($StatementAssociate === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementAssociate->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    }
    $ResultAssociate = $StatementAssociate->get_result();


    $QueryResponsibleAssociate = "SELECT Id_RA, Id_A, A_Name, Id_R, Full_Name, Date FROM responsible_associate";
    $StatementResponsibleAssociate = $Connection->prepare($QueryResponsibleAssociate);
    if ($StatementResponsibleAssociate === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementResponsibleAssociate->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    }

    $ResultResponsibleAssociate = $StatementResponsibleAssociate->get_result();



    $QueryResponsibles = "SELECT Id_Responsible, Document_Type, Identification_Document, Date_Birth, First_Name, Second_Name, First_LastName, Second_LastName, Phone_Number, Email, Gender, Comment_Responsible, Date, Status FROM responsibles WHERE Status = 'Active'";
    $StatementResponsibles = $Connection->prepare($QueryResponsibles);
    if ($StatementResponsibles === false) {
        header("Location: ../PHP/Academic_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementResponsibles->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Ejecucion");
    }

    $ResultResponsibles = $StatementResponsibles->get_result();


    return [
        'studyTypes' => $ResultStudyType,
        'units' => $ResultUnits,
        'academies' => $ResultAcademy,
        'unitResources' => $ResultUnitResources,
        'asociados' => $ResultResponsibleAssociate,
        'responsables' => $ResultResponsibles
    ];
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
