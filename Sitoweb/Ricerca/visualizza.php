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
    if (isset($_GET["id"])&& !empty(trim($_GET["id"]))) {
        require_once '../Database/config.php';
    
        $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id INNER JOIN materiatutor ON tutor.id_utente=materiatutor.idtutor INNER JOIN materie ON materiatutor.idmaterie=materie.id WHERE utente.id=? AND materia=?";
    
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "is", $param_id, $param_materia);
    
            $param_id = trim($_GET["id"]);
            $param_materia = trim($_GET["materia"]);
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result);
                echo"<tr>";
                    echo "<td>".$row['nome_utente']."</td><br>";
                    echo "<td>".$row['nome']."</td><br>";
                    echo "<td>".$row['cognome']."</td><br>";
                    echo "<td>".$row['sesso']."</td><br>";
                    echo "<td>".$row['materia']."</td><br>";
                    if($row['descrizione']!=null)
                        echo "<td>".$row['descrizione']."</td><br>";
                echo"</tr>";
            }else{
                header("location: error.php");
                exit();
            }
            
        }
        mysqli_stmt_close($stmt);
    }else{
        if (empty(trim($_GET["id"]))) {
           header("location: error.php");
           exit();
        }
    }
?>

    <form action="ricerca.php">
        <input type="submit" value="Indietro">
    </form>
</body>
</html>