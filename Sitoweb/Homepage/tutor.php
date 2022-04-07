<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
session_start();

if(!isset($_SESSION['uname'])){
    header('location: ../Login');
}else{
    require_once '../config.php';

    $sql="SELECT * FROM (SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id) AS tblTutor";

    if($stmt = mysqli_prepare($link,$sql)){

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($result)) {
                echo"<div>";
                    echo "<p>".$row['nome_utente']."</p>";
                    echo "<p>".$row['nome']."</p>";
                    echo "<p>".$row['cognome']."</p>";
                    echo "<p>".$row['sesso']."</p>";
                    if($row['descrizione']!=null)
                        echo "<p>".$row['descrizione']."</p>";
                echo"</div>";
            }

        }
    }else{
        echo "something went wrong";
    }

    mysqli_stmt_close($stmt);
}
?>
</body>
</html>