<?php
    session_start();
    if(!isset($_SESSION['uname'])){
        header('location: ../index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <title>Document</title>
</head>
<body>
    <?php

        require_once '../Database/config.php';


        $sql="SELECT t.id_utente FROM utente u LEFT JOIN tutor t ON u.id=t.id_utente WHERE u.id=?";

        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $_SESSION["id"];

            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result);
                if(isset($row['id_utente'])){
                    header('Location: istutor.php');
                    exit();
                }else{ 
                    header('Location: becometutor.php');
                    exit();
                }
                mysqli_stmt_close($stmt);
            }else{
                echo "errore in esecuzione";
            }
        }else{
            echo "errore in sql";
        }
    ?>
</body>
</html>