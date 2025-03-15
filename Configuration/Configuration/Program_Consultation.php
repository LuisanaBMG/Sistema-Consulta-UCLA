<?php
if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

try {

    $QueryProgramType = "SELECT Id_Program_Types, Acronyms_Program, Program_Type, Date, Status FROM program_types WHERE Status = 'Active'";
    $StatementProgramType = $Connection->prepare($QueryProgramType);
    if ($StatementProgramType === false) {
        header("Location: ../PHP/Program_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementProgramType->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Ejecucion");
    } 
        $ResultProgramType = $StatementProgramType->get_result();
       

    $QueryUnits = "SELECT Id_Units, Acronyms_Unit, Attached_Unit, Date, Status FROM attached_units WHERE Status = 'Active'";
    $StatementUnits = $Connection->prepare($QueryUnits);
    if ($StatementUnits === false) {
        header("Location: ../PHP/Program_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementUnits->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Ejecucion");
    }
    $ResultUnits = $StatementUnits->get_result();


    $QueryOrganization = "SELECT Id_Organization, Organization_Number, Organization_Name, Id_Responsible, Date, Status FROM organization WHERE Status = 'Active'";
    $StatementOrganization = $Connection->prepare($QueryOrganization);
    if ($StatementOrganization === false) {
        header("Location: ../PHP/Program_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementOrganization->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Ejecucion");
    }
    $ResultOrganization = $StatementOrganization->get_result();


    $QueryUnitResources = "SELECT Id_Resources, Acronyms_Resource, Resource_Name, Approval_Date, Date, Status FROM unit_resources WHERE Status = 'Active'";
    $StatementUnitResources = $Connection->prepare($QueryUnitResources);
    if ($StatementUnitResources === false) {
        header("Location: ../PHP/Program_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementUnitResources->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Ejecucion");
    }
    $ResultUnitResources = $StatementUnitResources->get_result();


    $QueryResponsibles = "SELECT Id_Responsible, Document_Type, Identification_Document, First_Name, Second_Name, First_LastName, Second_LastName, Phone_Number, Email, Gender, Type_Responsible, Status_Responsible, Comment_Responsible, Date, Status FROM responsibles WHERE Status = 'Active'";
    $StatementResponsibles = $Connection->prepare($QueryResponsibles);
    if ($StatementResponsibles === false) {
        header("Location: ../PHP/Program_Consultation.php?error=Error_BaseDatos");
    }
    if (!$StatementResponsibles->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Ejecucion");
    }

    $ResultResponsibles = $StatementResponsibles->get_result();


    return [
        'programTypes' => $ResultProgramType,
        'units' => $ResultUnits,
        'organizations' => $ResultOrganization,
        'unitResources' => $ResultUnitResources,
        'responsables' => $ResultResponsibles
    ];
} catch (Exception $e) {
    header('HTTP/1.1 500 Internal Server Error');
    header('Content-Type: application/json');
    echo json_encode(['error' => $e->getMessage()]);
}
