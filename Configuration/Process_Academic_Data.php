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

if (isset($_POST['Id_Study_Types']) && !empty($_POST['Id_Study_Types'])) {
    $Id_Study_Types = intval($_POST['Id_Study_Types']);
    $Acronyms_Study = strtoupper(validate($_POST['Acronyms_Study']));
    $Study_Type = strtoupper(validate($_POST['Study_Type']));

} elseif (isset($_POST['Id_Units']) && !empty($_POST['Id_Units'])) {
    $Id_Units = intval($_POST['Id_Units']);
    $Acronyms_Unit = strtoupper(validate($_POST['Acronyms_Unit']));
    $Attached_Unit = strtoupper(validate($_POST['Attached_Unit']));

} elseif (isset($_POST['Id_Academy']) && !empty($_POST['Id_Academy'])) {
    $Id_Academy = intval($_POST['Id_Academy']);
    $Academy_Number = strtoupper(validate($_POST['Academy_Number']));
    $Academy_Name = strtoupper(validate($_POST['Academy_Name']));

} elseif (isset($_POST['Id_Resources']) && !empty($_POST['Id_Resources'])) {
    $Id_Resources = intval($_POST['Id_Resources']);
    $Acronyms_Resource = strtoupper(validate($_POST['Acronyms_Resource']));
    $Resource_Name = strtoupper(validate($_POST['Resource_Name']));

} elseif (isset($_POST['Id_Associate']) && !empty($_POST['Id_Associate'])) {
    $Id_Associate = intval($_POST['Id_Associate']);
    $Associate_Name = strtoupper(validate($_POST['Associate_Name']));
    $Associate_Comment = strtoupper(validate($_POST['Associate_Comment']));

} elseif (isset($_POST['Id_Responsible']) && !empty($_POST['Id_Responsible'])) {
    $Id_Responsible = intval($_POST['Id_Responsible']);
    $Document_Type = validate($_POST['Document_Type']);
    $Identification_Document = validate($_POST['Identification_Document']);
    $Date_Birth = validate($_POST['Date_Birth']);
    $First_Name = strtoupper(validate($_POST['First_Name']));
    $Second_Name = !empty($_POST['Second_Name']) ? strtoupper(validate($_POST['Second_Name'])) : '';
    $First_LastName = strtoupper(validate($_POST['First_LastName']));
    $Second_LastName = !empty($_POST['Second_LastName']) ? strtoupper(validate($_POST['Second_LastName'])) : '';
    $Phone_Number = validate($_POST['Phone_Number']);
    $Email = strtoupper(validate($_POST['Email']));
    $Gender = validate($_POST['Gender']);
    $Comment_Responsible = !empty($_POST['Comment_Responsible']) ? strtoupper(validate($_POST['Comment_Responsible'])) : '';
    $selected_associate_id = validate($_POST['A_Name']);
    $selected_responsible_id = validate($_POST['Responsible_ID']);
    $Id_RA = intval(validate($_POST['Id_RA']));
    
} else {
    $selected_associate_id = validate($_POST['A_Name']);
    $selected_responsible_id = validate($_POST['Responsible_ID']);
    $Id_RA = intval(validate($_POST['Id_RA']));
}

$Status = 'Inactive';
$Date = date("Y-m-d");

if ($action === 'action_edit') {
    //Update data on types of studiess
    $QueryStudyType = "UPDATE study_types SET  Acronyms_Study= ?, Study_Type = ?, Date = ? WHERE Id_Study_Types = ?";
    $stmtStudyType  = $Connection->prepare($QueryStudyType);
    $stmtStudyType->bind_param("sssi", $Acronyms_Study, $Study_Type, $Date, $Id_Study_Types);
    $stmtStudyType->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Datos_Actualizados");

    if (!$stmtStudyType->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Actualizar");
    }

    //Update data on attached units
    $QueryAttachedUnits = "UPDATE attached_units SET  Acronyms_Unit= ?, Attached_Unit = ?, Date = ? WHERE Id_Units = ?";
    $stmtAttachedUnits  = $Connection->prepare($QueryAttachedUnits);
    $stmtAttachedUnits->bind_param("sssi", $Acronyms_Unit, $Attached_Unit, $Date, $Id_Units);
    $stmtAttachedUnits->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Datos_Actualizados");

    if (!$stmtAttachedUnits->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Actualizar");
    }

    //Update data on academy
    $QueryAcademy = "UPDATE academy SET  Academy_Number= ?, Academy_Name = ?, Date = ? WHERE Id_Academy = ?";
    $stmtAcademy  = $Connection->prepare($QueryAcademy);
    $stmtAcademy->bind_param("sssi", $Academy_Number, $Academy_Name, $Date, $Id_Academy);
    $stmtAcademy->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Datos_Actualizados");

    if (!$stmtAcademy->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Actualizar");
    }

    //Update data on unit resources
    $QueryResource = "UPDATE unit_resources SET  Acronyms_Resource= ?, Resource_Name = ?, Date = ? WHERE Id_Resources = ?";
    $stmtResource = $Connection->prepare($QueryResource);
    $stmtResource->bind_param("sssi", $Acronyms_Resource, $Resource_Name, $Date, $Id_Resources);
    $stmtResource->execute();


    header("Location: ../PHP/Academic_Consultation.php?success=Datos_Actualizados");

    if (!$stmtResource->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Actualizar");
    }

    //Update data on associates
    $QueryAssociates = "UPDATE associates SET  Associate_Name= ?, Associate_Comment = ?, Date = ? WHERE Id_Associate = ?";
    $stmtAssociates = $Connection->prepare($QueryAssociates);
    $stmtAssociates->bind_param("sssi", $Associate_Name, $Associate_Comment, $Date, $Id_Associate);
    $stmtAssociates->execute();


    header("Location: ../PHP/Academic_Consultation.php?success=Datos_Actualizados");

    if (!$stmtAssociates->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Actualizar");
    }


    // Prepare SQL query
    $QueryAR = "UPDATE responsible_associates SET Id_Responsible = ?, Id_Associate = ?, Date = ? WHERE Id_RA = ?";
    $stmtAR = $Connection->prepare($QueryAR);
    // Handle error if query preparation fails
    if (!$stmtAR) {
        header("Location:../PHP/Academic_Consultation.php?error=error_preparar_consulta" . mysqli_error($Connection));
        exit();
    }
    // Bind parameters
    if (!$stmtAR->bind_param("issd", $selected_responsible_id, $selected_associate_id, $Date, $Id_RA)) {
        header("Location:../PHP/Academic_Consultation.php?error=error_Actualizar" . mysqli_error($Connection));
        exit();
    }
    // Execute the query
    if ($stmtAR->execute()) {
        $affected_rows = $stmtAR->affected_rows;
        header("Location:../PHP/Academic_Consultation.php?success=Datos_Actualizados");
    } else {
        header("Location:../PHP/Academic_Consultation.php?error=error_ejecutar_consulta" . $stmtAR->error);
    }
    // Close the statement
    $stmtAR->close();


    //Update data on responsible
    $QueryResponsible = "UPDATE responsibles SET Document_Type = ?, Identification_Document = ?, Date_Birth = ?, First_Name = ?, Second_Name = ?, First_LastName = ?, Second_LastName = ?, Phone_Number = ?, Email = ?, Gender = ?, Comment_Responsible = ?, Date = ? WHERE Id_Responsible = ?";
    $stmtResponsible = $Connection->prepare($QueryResponsible);
    $stmtResponsible->bind_param("ssssssssssssi", $Document_Type, $Identification_Document, $Date_Birth, $First_Name, $Second_Name, $First_LastName, $Second_LastName, $Phone_Number, $Email, $Gender, $Comment_Responsible, $Date, $Id_Responsible);
    $stmtResponsible->execute();


    header("Location: ../PHP/Academic_Consultation.php?success=Datos_Actualizados");

    if (!$stmtResponsible->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Actualizar");
    }
} elseif ($action === 'action_delete') {
    //Update data on types of studiess
    $QueryStudyType = "UPDATE study_types SET  Status=? WHERE Id_Study_Types = ?";
    $stmtStudyType  = $Connection->prepare($QueryStudyType);
    $stmtStudyType->bind_param("si", $Status,  $Id_Study_Types);
    $stmtStudyType->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Registro_Eliminado");

    if (!$stmtStudyType->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on attached units
    $QueryAttachedUnits = "UPDATE attached_units SET Status = ? WHERE Id_Units = ?";
    $stmtAttachedUnits  = $Connection->prepare($QueryAttachedUnits);
    $stmtAttachedUnits->bind_param("si", $Status, $Id_Units);
    $stmtAttachedUnits->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Registro_Eliminado");

    if (!$stmtAttachedUnits->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on academy
    $QueryAcademy = "UPDATE academy SET Status = ? WHERE Id_Academy = ?";
    $stmtAcademy  = $Connection->prepare($QueryAcademy);
    $stmtAcademy->bind_param("si", $Status, $Id_Academy);
    $stmtAcademy->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Registro_Eliminado");

    if (!$stmtAcademy->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on unit resources
    $QueryResource = "UPDATE unit_resources SET Status = ? WHERE Id_Resources = ?";
    $stmtResource = $Connection->prepare($QueryResource);
    $stmtResource->bind_param("si", $Status, $Id_Resources);
    $stmtResource->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Registro_Eliminado");

    if (!$stmtResource->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on associates
    $QueryAssociates = "UPDATE associates SET Status = ? WHERE Id_Associate = ?";
    $stmtAssociates = $Connection->prepare($QueryAssociates);
    $stmtAssociates->bind_param("si", $Status, $Id_Associate);
    $stmtAssociates->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Registro_Eliminado");

    if (!$stmtAssociates->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Eliminar_Registro");
    }

    //Update data on responsible
    $QueryResponsible = "UPDATE responsibles SET Status = ? WHERE Id_Responsible = ?";
    $stmtResponsible = $Connection->prepare($QueryResponsible);
    $stmtResponsible->bind_param("si", $Status, $Id_Responsible);
    $stmtResponsible->execute();

    header("Location: ../PHP/Academic_Consultation.php?success=Registro_Eliminado");

    if (!$stmtResponsible->execute()) {
        header("Location: ../PHP/Academic_Consultation.php?error=error_Eliminar_Registro");
    }
} else {
    echo "Error: Acción no válida";
}
