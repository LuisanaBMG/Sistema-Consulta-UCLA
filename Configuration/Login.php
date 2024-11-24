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

        $Consult = "SELECT Id_Usuario, Usuario, Nombre_Usuario, Apellido_Usuario, Correo, Password, Nivel, Status 
                    FROM usuario 
                    WHERE Usuario = ? AND Status = 'Activo'";

        $Stmt = $Connection->prepare($Consult);
        $Stmt->bind_param("s", $User);
        $Stmt->execute();
        $Result = $Stmt->get_result();

        if ($Result && $Result->num_rows > 0) {
            $Row = $Result->fetch_assoc();

            if ($Row['Password'] === $Password) {
                $_SESSION['Id_Usuario'] = $Row['Id_Usuario'];
                $_SESSION['Nombre_Usuario'] = $Row['Nombre_Usuario'];
                $_SESSION['Apellido_Usuario'] = $Row['Apellido_Usuario'];
                $_SESSION['Correo'] = $Row['Correo'];
                $_SESSION['Nivel'] = $Row['Nivel'];
                $_SESSION['Status'] = $Row['Status'];
                header("Location: ../PHP/Dashboard.php");
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

