<?php
session_start();
include_once('Connection_DB.php');

if (isset($_POST['User']) && isset($_POST['Password'])) {
    function validate($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $User = validate($_POST['User']);
    $Password = validate($_POST['Password']);

    if (empty($User)) {
        header("Location: ../Login.php?error=campo_vacio");
        exit();
    } elseif (empty($Password)) {
        header("Location: ../Login.php?error=campo_vacio");
        exit();
    } else {
        $Password = md5($Password);

        $Consult = "SELECT Id_User, User, User_Name, User_LastName, Email, Password, Level, Status 
                    FROM users
                    WHERE User = ? AND Status = 'Active'";

        $Stmt = $Connection->prepare($Consult);
        $Stmt->bind_param("s", $User);
        $Stmt->execute();
        $Result = $Stmt->get_result();

        if ($Result && $Result->num_rows > 0) {
            $Row = $Result->fetch_assoc();

            if ($Row['Password'] === $Password) {
                $_SESSION['Id_User'] = $Row['Id_User'];
                $_SESSION['User_Name'] = $Row['User_Name'];
                $_SESSION['User_LastName'] = $Row['User_LastName'];
                $_SESSION['Email'] = $Row['Email'];
                $_SESSION['Level'] = $Row['Level'];
                $_SESSION['Status'] = $Row['Status'];
                header("Location: ../PHP/Dashboard.php?success=Inicie_Sesion");
                exit();
            } else {
                header("Location: ../Login.php?error=contrasena_incorrecta");
                exit();
            }
        } else {
            header("Location: ../Login.php?error=usuario_no_existe");
            exit();
        }
    }
} else {
    header("Location: ../Login.php");
    exit();
}
