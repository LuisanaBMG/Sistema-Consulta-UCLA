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
                // Validate study details
                $Diminutive_Study = strtoupper(validate($_POST['Diminutive_Study']));
                $Study_Type = strtoupper(validate($_POST['Study_Type']));

                // Check if fields are empty
                if (empty($Diminutive_Study) || empty($Study_Type)) {
                    header("Location: ../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for study types
                $StudyRegistration = $Connection->prepare("INSERT INTO study_types (Diminutive_Study, Study_Type, Date, Status) VALUES (?, ?, NOW(), ?)");
                $StudyRegistration->bind_param("sss", $Diminutive_Study, $Study_Type, $Status);
                $StudyRegistration->execute();

                break;

            case 'section2':
                // Validate unit details
                $Diminutive_Unit = strtoupper(validate($_POST['Diminutive_Unit']));
                $Attached_Unit = strtoupper(validate($_POST['Attached_Unit']));

                // Check if fields are empty
                if (empty($Diminutive_Unit) || empty($Attached_Unit)) {
                    header("Location: ../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for attached units
                $UnitRegistration = $Connection->prepare("INSERT INTO attached_units (Diminutive_Unit, Attached_Unit, Date, Status) VALUES (?, ?, NOW(), ?)");
                $UnitRegistration->bind_param("sss", $Diminutive_Unit, $Attached_Unit, $Status);
                $UnitRegistration->execute();

                break;

            case 'section3':
                // Validate academy details
                $Academy_Number = validate($_POST['Academy_Number']);
                $Academy_Name = strtoupper(validate($_POST['Academy_Name']));

                // Check if fields are empty
                if (empty($Academy_Number) || empty($Academy_Name)) {
                    header("Location: ../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }

                $AcademyRegistration = $Connection->prepare("INSERT INTO academy (Academy_Number, Academy_Name, Date, Status) VALUES (?, ?, NOW(), ?)");
                $AcademyRegistration->bind_param("sss", $Academy_Number, $Academy_Name, $Status);
                $AcademyRegistration->execute();

                break;

            case 'section4':
                $Diminutive_Resource = strtoupper(validate($_POST['Diminutive_Resource']));
                $Resource_Name = strtoupper(validate($_POST['Resource_Name']));

                // Check if fields are empty
                if (empty($Diminutive_Resource) || empty($Resource_Name)) {
                    header("Location: ../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for unit resources
                $ResourceRegistration = $Connection->prepare("INSERT INTO unit_resources (Diminutive_Resource, Resource_Name, Date, Status) VALUES (?, ?, NOW(), ?)");
                $ResourceRegistration->bind_param("sss", $Diminutive_Resource, $Resource_Name, $Status);
                $ResourceRegistration->execute();

                break;

            case 'section5':
                // Validate associate details
                $Associate_Name = strtoupper(validate($_POST['Associate_Name']));
                $Associate_Comment = strtoupper(validate($_POST['Associate_Comment']));

                // Check if fields are empty
                if (empty($Associate_Name) || empty($Associate_Comment)) {
                    header("Location: ../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for associates
                $AssociateRegistration = $Connection->prepare("INSERT INTO associates (Associate_Name, Associate_Comment, Date, Status) VALUES (?, ?, NOW(), ?)");
                $AssociateRegistration->bind_param("sss", $Associate_Name, $Associate_Comment, $Status);
                $AssociateRegistration->execute();

                $Id_Associate = $mysqli->insert_id;

                break;

            case 'section6':
                // Validate responsible details
                $Document_Type = validate($_POST['Document_Type']);
                $Identification_Document = validate($_POST['Identification_Document']);
                $Date_Birth = validate($_POST['Date_Birth']);
                $Firts_Name = strtoupper(validate($_POST['Firts_Name']));
                $Second_Name = !empty($_POST['Second_Name']) ? strtoupper(validate($_POST['Second_Name'])) : '';
                $First_LastName = strtoupper(validate($_POST['First_LastName']));
                $Second_LastName = !empty($_POST['Second_LastName']) ? strtoupper(validate($_POST['Second_LastName'])) : '';
                $Phone_Number = validate($_POST['Phone_Number']);
                $Email = strtoupper(validate($_POST['Email']));
                $Gender = validate($_POST['Gender']);
                $Comment_Responsible = !empty($_POST['Comment_Responsible']) ? strtoupper(validate($_POST['Comment_Responsible'])) : '';

                // Check if fields are empty
                if (empty($Document_Type) || empty($Identification_Document) || empty($Date_Birth) || empty($Firts_Name) || empty($First_LastName) || empty($Phone_Number) || empty($Email) || empty($Gender)) {
                    header("Location:../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }

                // Prepare and execute INSERT query for responsible
                $ResponsibleRegistration = $Connection->prepare("INSERT INTO responsibles (Document_Type, Identification_Document, Date_Birth, Firts_Name, Second_Name, First_LastName, Second_LastName, Phone_Number, Email, Gender, Comment_Responsible, Date, Status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)");
                $ResponsibleRegistration->bind_param("ssssssssssss", $Document_Type, $Identification_Document, $Date_Birth, $Firts_Name, $Second_Name, $First_LastName, $Second_LastName, $Phone_Number, $Email, $Gender, $Comment_Responsible, $Status);
                $ResponsibleRegistration->execute();

                $Id_Responsible = $mysqli->insert_id;

                break;

            case 'section7':
                $Id_Associate = validate($_POST['Associate']);
                $Id_Responsible = validate($_POST['Responsible']);

                // Verificar si los campos están vacíos
                if (empty($Id_Associate) || empty($Id_Responsible)) {
                    header("Location:../PHP/Academic_Data.php?error=Datos_Vacios");
                    exit();
                }


                $ARRegistration = $Connection->prepare("INSERT INTO responsible_associates (Id_Responsible, Id_Associate, Date, Status) VALUES (?, ?, NOW(), ?)");
                $ARRegistration->bind_param("iis", $Id_Responsible, $Id_Associate, $Status);
                $ARRegistration->execute();

                break;
        }

        // In all successful cases, redirect with success message
        header("Location: ../PHP/Academic_Data.php?success=Registro_Exitoso");
        exit();
    } catch (Exception $e) {
        // Echo the error message if an exception occurs
        echo "Error: " . $e->getMessage();
    }
}
