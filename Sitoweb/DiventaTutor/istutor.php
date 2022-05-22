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
    <title>Dati tutor</title>
</head>
<body>
    <?php
        include_once "../header/navbar.php";
    

        require_once '../Database/config.php';


        $sql="SELECT * FROM tutor t LEFT JOIN materiatutor mt ON t.id_utente=mt.idtutor INNER JOIN materie m ON mt.idmaterie=m.id WHERE t.id_utente=?";

        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $_SESSION["id"];
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result);
                
                echo "<h1>LINK MEET:</h1>";
                if(isset($row["link_meet"])){
                    echo $row["link_meet"];
                }else{
                    echo "non hai un link meet";
                }

                echo "<h1>Lezioni:</h1>";
                if(isset($row["id_ripetizione"])){
                    echo '<table border="1" style="margin-top:20px;">';
                    echo '<tr class="grassetto"><td>mateia</td><td>descrizione</td><td>prezzo</td><td>elimina</td></tr>';
					
                    do{
                        echo '<tr style="text-align:center">';
                            echo "<td>".$row['materia']."</td>";
                            echo "<td>".$row['descrizione']."</td>";
                            echo "<td>".$row['prezzi_ora']."</td>";
                            echo '<td><a href="elimina.php?ID='.$row['id_ripetizione'].'">D</a></td>';
                        echo "</tr>";
                    }while($row = mysqli_fetch_array($result));//controlla se c'è più di una materia insegnata
                }else{
                    echo "non insegni alcuna lezione";
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