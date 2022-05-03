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
        require_once 'config.php';
    
        $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id INNER JOIN materiatutor ON tutor.id_utente=materiatutor.idtutor INNER JOIN materie ON materiatutor.idmaterie=materie.id WHERE utente.id=?";
    
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);
    
            $param_id = trim($_GET["id"]);
            
            $row = mysqli_fetch_array($result)
            echo"<tr>";
                echo "<td>".$row['nome_utente']."</td>";
                echo "<td>".$row['nome']."</td>";
                echo "<td>".$row['cognome']."</td>";
                echo "<td>".$row['sesso']."</td>";
                echo "<td>".$row['materia']."</td>";
                if($row['descrizione']!=null)
                    echo "<td>".$row['descrizione']."</td>";
            echo"</tr>";
            
            
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