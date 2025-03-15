<?php
session_start();
include_once('../Configuration/Connection_DB.php');

if (!isset($_SESSION['Id_User'])) {
    header("Location:../Login.php?error=error_acceso");
    exit();
}

// Get the current user ID and set status to Active
$Id_User = $_SESSION['Id_User'];
$Status = "Active";

// Function to validate and sanitize input data
function validate($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form has been submitted
if (isset($_POST['Register_Type'])) {
    try {
        switch ($_POST['Register_Type']) {
            case 'section1':              
                // Validate program details
                $Acronyms_Program = strtoupper(validate($_POST['Acronyms_Program']));
                $Program_Type = strtoupper(validate($_POST['Program_Type']));

                $QueryProgram = "SELECT COUNT(*) as count FROM Program_types WHERE Acronyms_Program = ? AND Status = 'Active'";
                $stmtProgram = $Connection->prepare($QueryProgram);
                $stmtProgram->bind_param("s", $Acronyms_Program);
                $stmtProgram->execute();
                $resultProgram = $stmtProgram->get_result();
                $rowProgram = $resultProgram->fetch_assoc();
            
                if ($rowProgram['count'] > 0) {
                    header("Location: ../PHP/Program_Data.php?error=acronimo_existe");
                    exit;
                }

                // Check if fields are empty
                if (empty($Acronyms_Program) || empty($Program_Type)) {
                    header("Location: ../PHP/Program_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for Program types
                $ProgramRegistration = $Connection->prepare("INSERT INTO program_types (Acronyms_Program, Program_Type, Date, Status) VALUES (?, ?, NOW(), ?)");
                $ProgramRegistration->bind_param("sss", $Acronyms_Program, $Program_Type, $Status);
                $ProgramRegistration->execute();

                break;

            case 'section2':
                // Validate unit details
                $Acronyms_Unit = strtoupper(validate($_POST['Acronyms_Unit']));
                $Attached_Unit = strtoupper(validate($_POST['Attached_Unit']));

                $QueryUnits = "SELECT COUNT(*) as count FROM attached_units WHERE Acronyms_Unit = ? AND Status = 'Active'";
                $stmtUnits = $Connection->prepare($QueryUnits);
                $stmtUnits->bind_param("s", $Acronyms_Unit);
                $stmtUnits->execute();
                $resultUnits = $stmtUnits->get_result();
                $rowUnits = $resultUnits->fetch_assoc();

                if ($rowUnits['count'] > 0) {
                    header("Location: ../PHP/Program_Data.php?error=acronimo_existe");
                    exit;
                }

                // Check if fields are empty
                if (empty($Acronyms_Unit) || empty($Attached_Unit)) {
                    header("Location: ../PHP/Program_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for attached units
                $UnitRegistration = $Connection->prepare("INSERT INTO attached_units (Acronyms_Unit, Attached_Unit, Date, Status) VALUES (?, ?, NOW(), ?)");
                $UnitRegistration->bind_param("sss", $Acronyms_Unit, $Attached_Unit, $Status);
                $UnitRegistration->execute();

                break;

            case 'section3':
                // Validate organizations details
                $Organization_Number = validate($_POST['Organization_Number']);
                $Organization_Name = strtoupper(validate($_POST['Organization_Name']));
                $Id_Responsible = validate($_POST['Id_Responsible']);

                $QueryOrganization = "SELECT COUNT(*) as count FROM organization WHERE Organization_Number = ? AND Status = 'Active'";
                $stmtOrganization = $Connection->prepare($QueryOrganization);
                $stmtOrganization->bind_param("s", $Organization_Number);
                $stmtOrganization->execute();
                $resultOrganization = $stmtOrganization->get_result();
                $rowOrganization = $resultOrganization->fetch_assoc();
            
                if ($rowOrganization['count'] > 0) {
                    header("Location: ../PHP/Organization_Data.php?error=acronimo_existe");
                    exit;
                }

                // Check if fields are empty
                if (empty($Organization_Number) || empty($Organization_Name) || empty($Id_Responsible)) {
                    header("Location: ../PHP/Program_Data.php?error=Datos_Vacios");
                    exit();
                }

                $OrganizationRegistration = $Connection->prepare("INSERT INTO organization (Organization_Number, Organization_Name, Id_Responsible, Date, Status) VALUES (?, ?, ?, NOW(), ?)");
                $OrganizationRegistration->bind_param("ssss", $Organization_Number, $Organization_Name, $Id_Responsible, $Status);
                $OrganizationRegistration->execute();

                break;

            case 'section4':
                $Acronyms_Resource = strtoupper(validate($_POST['Acronyms_Resource']));
                $Resource_Name = strtoupper(validate($_POST['Resource_Name']));
                $Approval_Date = validate($_POST['Approval_Date']);

                // Check if fields are empty
                if (empty($Acronyms_Resource) || empty($Resource_Name) || empty($Approval_Date)) {
                    header("Location: ../PHP/Program_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for unit resources
                $ResourceRegistration = $Connection->prepare("INSERT INTO unit_resources (Acronyms_Resource, Resource_Name, Approval_Date, Date, Status) VALUES (?, ?, ?, NOW(), ?)");
                $ResourceRegistration->bind_param("ssss", $Acronyms_Resource, $Resource_Name, $Approval_Date, $Status);
                $ResourceRegistration->execute();

                break;

            case 'section5':
                // Validate responsible details
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

                $QueryResponsibles = "SELECT COUNT(*) as count FROM responsibles WHERE Identification_Document = ? AND Status = 'Active'";
                $stmtResponsibles = $Connection->prepare($QueryResponsibles);
                $stmtResponsibles->bind_param("s", $Identification_Document);
                $stmtResponsibles->execute();
                $resultResponsibles = $stmtResponsibles->get_result();
                $rowResponsibles = $resultResponsibles->fetch_assoc();
            
             
                if ($rowResponsibles['count'] > 0) {
                    header("Location: ../PHP/Program_Data.php?error=documento_existe");
                    exit;
                }

                // Check if fields are empty
                if (empty($Document_Type) || empty($Identification_Document) || empty($First_Name) || empty($First_LastName) || empty($Phone_Number) || empty($Email) || empty($Gender) || empty($Type_Responsible)|| empty($Status_Responsible)) {
                    header("Location:../PHP/Program_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for responsible
                $ResponsibleRegistration = $Connection->prepare("INSERT INTO responsibles (Document_Type, Identification_Document, First_Name, Second_Name, First_LastName, Second_LastName, Phone_Number, Email, Gender, Type_Responsible, Status_Responsible, Comment_Responsible, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
                $ResponsibleRegistration->bind_param("sssssssssssss", $Document_Type, $Identification_Document, $First_Name, $Second_Name, $First_LastName, $Second_LastName, $Phone_Number, $Email, $Gender, $Type_Responsible, $Status_Responsible, $Comment_Responsible, $Status);
                $ResponsibleRegistration->execute();

                $Id_Responsible = $mysqli->insert_id;

                break;
        }

        // In all successful cases, redirect with success message
        header("Location: ../PHP/Program_Data.php?success=Registro_Exitoso");
        exit();
    } catch (Exception $e) {
        // Echo the error message if an exception occurs
        echo "Error: " . $e->getMessage();
    }
}
