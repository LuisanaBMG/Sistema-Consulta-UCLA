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

if (isset($_POST['Id_Program_Types']) && !empty($_POST['Id_Program_Types'])) {
    $Id_Program_Types = intval($_POST['Id_Program_Types']);
    $Acronyms_Program = strtoupper(validate($_POST['Acronyms_Program']));
    $Program_Type = strtoupper(validate($_POST['Program_Type']));
} elseif (isset($_POST['Id_Units']) && !empty($_POST['Id_Units'])) {
    $Id_Units = intval($_POST['Id_Units']);
    $Acronyms_Unit = strtoupper(validate($_POST['Acronyms_Unit']));
    $Attached_Unit = strtoupper(validate($_POST['Attached_Unit']));
} elseif (isset($_POST['Id_Organization']) && !empty($_POST['Id_Organization'])) {
    $Id_Organization = intval($_POST['Id_Organization']);
    $Organization_Number = strtoupper(validate($_POST['Organization_Number']));
    $Organization_Name = strtoupper(validate($_POST['Organization_Name']));
    $Responsible_Id = intval($_POST['Responsible_Id']);
} elseif (isset($_POST['Id_Resources']) && !empty($_POST['Id_Resources'])) {
    $Id_Resources = intval($_POST['Id_Resources']);
    $Acronyms_Resource = strtoupper(validate($_POST['Acronyms_Resource']));
    $Resource_Name = strtoupper(validate($_POST['Resource_Name']));
    $Approval_Date = validate($_POST['Approval_Date']);
}elseif (isset($_POST['Id_Responsible']) && !empty($_POST['Id_Responsible'])) {
    $Id_Responsible = intval($_POST['Id_Responsible']);
    $Document_Type = validate($_POST['Document_Type']);
    $Identification_Document = validate($_POST['Identification_Document']);
    $First_Name = strtoupper(validate($_POST['First_Name']));
    $Second_Name = !empty($_POST['Second_Name']) ? strtoupper(validate($_POST['Second_Name'])) : '';
    $First_LastName = strtoupper(validate($_POST['First_LastName']));
    $Second_LastName = !empty($_POST['Second_LastName']) ? strtoupper(validate($_POST['Second_LastName'])) : '';
    $Phone_Number = validate($_POST['Phone_Number']);
    $Email = strtoupper(validate($_POST['Email']));
    $Gender = validate($_POST['Gender']);
    $Type_Responsible = !empty($_POST['Type_Responsible']) ? strtoupper(validate($_POST['Type_Responsible'])) : '';
    $Status_Responsible = !empty($_POST['Status_Responsible']) ? strtoupper(validate($_POST['Status_Responsible'])) : '';
    $Comment_Responsible = !empty($_POST['Comment_Responsible']) ? strtoupper(validate($_POST['Comment_Responsible'])) : '';
} 

$Status = 'Inactive';
$Date = date("Y-m-d");

if ($action === 'action_edit') {
    //Update data on program types
    $currentQuery = "SELECT Acronyms_Program FROM Program_types WHERE Id_Program_Types = ?";
    $stmtCurrent = $Connection->prepare($currentQuery);
    $stmtCurrent->bind_param("i", $Id_Program_Types);
    $stmtCurrent->execute();
    $currentResult = $stmtCurrent->get_result();
    $currentRow = $currentResult->fetch_assoc();


    if ($currentRow['Acronyms_Program'] !== $Acronyms_Program) {
        $checkQuery = "SELECT COUNT(*) as count FROM Program_types WHERE Acronyms_Program = ? AND Status = 'Active'";
        $stmtCheck = $Connection->prepare($checkQuery);
        $stmtCheck->bind_param("s", $Acronyms_Program);
        $stmtCheck->execute();
        $result = $stmtCheck->get_result();
        $row = $result->fetch_assoc();

        if ($row['count'] > 0) {
            header("Location: ../PHP/Program_Consultation.php?error=acronimo_existe");
            exit;
        }
    }

    $QueryProgramType = "UPDATE Program_types SET Acronyms_Program = ?, Program_Type = ?, Date = ? WHERE Id_Program_Types = ?";
    $stmtProgramType = $Connection->prepare($QueryProgramType);
    $stmtProgramType->bind_param("sssi", $Acronyms_Program, $Program_Type, $Date, $Id_Program_Types);

    if (!$stmtProgramType->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Actualizar");
        exit;
    }

    header("Location: ../PHP/Program_Consultation.php?success=Datos_Actualizados");

    //Update data on attached units
    $unitCurrentQuery = "SELECT Acronyms_Unit FROM attached_units WHERE Id_Units = ?";
    $unitStmtCurrent = $Connection->prepare($unitCurrentQuery);
    $unitStmtCurrent->bind_param("i", $Id_Units);
    $unitStmtCurrent->execute();
    $unitCurrentResult = $unitStmtCurrent->get_result();
    $unitCurrentRow = $unitCurrentResult->fetch_assoc();

    if ($unitCurrentRow['Acronyms_Unit'] !== $Acronyms_Unit) {
        $QueryUnits = "SELECT COUNT(*) as count FROM attached_units WHERE Acronyms_Unit = ? AND Status = 'Active'";
        $stmtUnits = $Connection->prepare($QueryUnits);
        $stmtUnits->bind_param("s", $Acronyms_Unit);
        $stmtUnits->execute();
        $resultUnits = $stmtUnits->get_result();
        $rowUnits = $resultUnits->fetch_assoc();

        if ($rowUnits['count'] > 0) {
            header("Location: ../PHP/Program_Consultation.php?error=acronimo_existe");
            exit;
        }
    }

    $QueryAttachedUnits = "UPDATE attached_units SET Acronyms_Unit = ?, Attached_Unit = ?, Date = ? WHERE Id_Units = ?";
    $stmtAttachedUnits = $Connection->prepare($QueryAttachedUnits);
    $stmtAttachedUnits->bind_param("sssi", $Acronyms_Unit, $Attached_Unit, $Date, $Id_Units);

    if (!$stmtAttachedUnits->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Actualizar");
        exit;
    }

    header("Location: ../PHP/Program_Consultation.php?success=Datos_Actualizados");

    //Update organization
    $orgCurrentQuery = "SELECT Organization_Number FROM organization WHERE Id_Organization = ?";
    $orgStmtCurrent = $Connection->prepare($orgCurrentQuery);
    $orgStmtCurrent->bind_param("i", $Id_Organization);
    $orgStmtCurrent->execute();
    $orgCurrentResult = $orgStmtCurrent->get_result();
    $orgCurrentRow = $orgCurrentResult->fetch_assoc();

    if ($orgCurrentRow['Organization_Number'] !== $Organization_Number) {
        $QueryOrganization = "SELECT COUNT(*) as count FROM organization WHERE Organization_Number = ? AND Status = 'Active'";
        $stmtOrganization = $Connection->prepare($QueryOrganization);
        $stmtOrganization->bind_param("s", $Organization_Number);
        $stmtOrganization->execute();
        $resultOrganization = $stmtOrganization->get_result();
        $rowOrganization = $resultOrganization->fetch_assoc();

        if ($rowOrganization['count'] > 0) {
            header("Location: ../PHP/Program_Consultation.php?error=acronimo_existe");
            exit;
        }
    }

    $QueryOrganization = "UPDATE organization SET Organization_Number = ?, Organization_Name = ?, Id_Responsible = ?, Date = ? WHERE Id_Organization = ?";
    $stmtOrganization = $Connection->prepare($QueryOrganization);
    $stmtOrganization->bind_param("ssisi", $Organization_Number, $Organization_Name, $Responsible_Id, $Date, $Id_Organization);

    if (!$stmtOrganization->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Actualizar");
        exit;
    }
    header("Location: ../PHP/Program_Consultation.php?success=Datos_Actualizados");

    //Update data on unit resources
    $QueryResource = "UPDATE unit_resources SET Acronyms_Resource = ?, Resource_Name = ?,  Approval_Date = ?, Date = ? WHERE Id_Resources = ?";
    $stmtResource = $Connection->prepare($QueryResource);
    $stmtResource->bind_param("ssssi", $Acronyms_Resource, $Resource_Name, $Approval_Date, $Date, $Id_Resources);

    if (!$stmtResource->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Actualizar");
        exit;
    }

    header("Location: ../PHP/Program_Consultation.php?success=Datos_Actualizados");


    //Update responsible
    $respCurrentQuery = "SELECT Identification_Document FROM responsibles WHERE Id_Responsible = ?";
    $respStmtCurrent = $Connection->prepare($respCurrentQuery);
    $respStmtCurrent->bind_param("i", $Id_Responsible);
    $respStmtCurrent->execute();
    $respCurrentResult = $respStmtCurrent->get_result();
    $respCurrentRow = $respCurrentResult->fetch_assoc();

    if ($respCurrentRow['Identification_Document'] !== $Identification_Document) {
        $QueryResponsibles = "SELECT COUNT(*) as count FROM responsibles WHERE Identification_Document = ? AND Status = 'Active'";
        $stmtResponsibles = $Connection->prepare($QueryResponsibles);
        $stmtResponsibles->bind_param("s", $Identification_Document);
        $stmtResponsibles->execute();
        $resultResponsibles = $stmtResponsibles->get_result();
        $rowResponsibles = $resultResponsibles->fetch_assoc();

        if ($rowResponsibles['count'] > 0) {
            header("Location: ../PHP/Program_Consultation.php?error=documento_existe");
            exit;
        }
    }
    $QueryResponsible = "UPDATE responsibles SET Document_Type = ?, Identification_Document = ?, First_Name = ?, Second_Name = ?, First_LastName = ?, Second_LastName = ?, Phone_Number = ?, Email = ?, Gender = ?, Type_Responsible = ?, Status_Responsible = ?, Comment_Responsible = ?, Date = ? WHERE Id_Responsible = ?";
    $stmtResponsible = $Connection->prepare($QueryResponsible);
    $stmtResponsible->bind_param("sssssssssssssi", $Document_Type, $Identification_Document, $First_Name, $Second_Name, $First_LastName, $Second_LastName, $Phone_Number, $Email, $Gender, $Type_Responsible, $Status_Responsible, $Comment_Responsible, $Date, $Id_Responsible);

    if (!$stmtResponsible->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Actualizar");
        exit;
    }

    header("Location: ../PHP/Program_Consultation.php?success=Datos_Actualizados");

} elseif ($action === 'action_delete') {
    //Update data on types of programs
    $QueryProgramType = "UPDATE Program_types SET  Status=? WHERE Id_Program_Types = ?";
    $stmtProgramType  = $Connection->prepare($QueryProgramType);
    $stmtProgramType->bind_param("si", $Status,  $Id_Program_Types);
    $stmtProgramType->execute();

    header("Location: ../PHP/Program_Consultation.php?success=Registro_Eliminado");

    if (!$stmtProgramType->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on attached units
    $QueryAttachedUnits = "UPDATE attached_units SET Status = ? WHERE Id_Units = ?";
    $stmtAttachedUnits  = $Connection->prepare($QueryAttachedUnits);
    $stmtAttachedUnits->bind_param("si", $Status, $Id_Units);
    $stmtAttachedUnits->execute();

    header("Location: ../PHP/Program_Consultation.php?success=Registro_Eliminado");

    if (!$stmtAttachedUnits->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on organization
    $QueryOrganization = "UPDATE organization SET Status = ? WHERE Id_Organization = ?";
    $stmtOrganization  = $Connection->prepare($QueryOrganization);
    $stmtOrganization->bind_param("si", $Status, $Id_Organization);
    $stmtOrganization->execute();

    header("Location: ../PHP/Program_Consultation.php?success=Registro_Eliminado");

    if (!$stmtOrganization->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on unit resources
    $QueryResource = "UPDATE unit_resources SET Status = ? WHERE Id_Resources = ?";
    $stmtResource = $Connection->prepare($QueryResource);
    $stmtResource->bind_param("si", $Status, $Id_Resources);
    $stmtResource->execute();

    header("Location: ../PHP/Program_Consultation.php?success=Registro_Eliminado");

    if (!$stmtResource->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Eliminar_Registro");
    }

  

    //Update data on responsible
    $QueryResponsible = "UPDATE responsibles SET Status = ? WHERE Id_Responsible = ?";
    $stmtResponsible = $Connection->prepare($QueryResponsible);
    $stmtResponsible->bind_param("si", $Status, $Id_Responsible);
    $stmtResponsible->execute();

    header("Location: ../PHP/Program_Consultation.php?success=Registro_Eliminado");

    if (!$stmtResponsible->execute()) {
        header("Location: ../PHP/Program_Consultation.php?error=error_Eliminar_Registro");
    }
} else {
    echo "Error: Acción no válida";
}
