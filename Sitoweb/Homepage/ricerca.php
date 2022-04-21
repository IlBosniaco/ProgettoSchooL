

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Cerca</h1>
<?php
session_start();

if(!isset($_SESSION['uname'])){
    header('location: ../Login');
}else{
    if($_SERVER["REQUEST_METHOD"] == "post" || $_SERVER["REQUEST_METHOD"] == "POST"){
        require_once '../config.php';
    
        $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id";

        if(empty(trim($_POST["nome_utente"]))){
            $sql.=" WHERE modello != ? ";
            $param_modello="";
        }else{
            $sql.=" WHERE modello = ? ";
            $param_modello = trim($_POST["modello"]);
        }

        if(empty(trim($_POST["costo"]))){
            $sql.=" AND costo != ? ";
            $param_costo="";
        }else{
            $sql.=" AND costo < ? ";
            $param_costo = trim($_POST["costo"]);
        }

        if(empty(trim($_POST["cilindrata"]))){
            $sql.=" AND cilindrata != ? ";
            $param_cilindrata="";
        }else{
            $sql.=" AND cilindrata < ? ";
            $param_cilindrata = trim($_POST["cilindrata"]);
        }
        
        if(empty(trim($_POST["anno"]))){
            $sql.=" AND annoproduzione != ? ";
            $param_anno="";
        }else{
            $sql.=" AND annoproduzione < ? ";
            $param_anno = trim($_POST["anno"]);
        }

        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "siii", $param_modello, $param_costo,$param_cilindrata,$param_anno);

            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                echo "<table style='text-align:center;'>";
                    echo"<thead>";
                        echo"<tr>";
                            echo "<th>id</th>";
                            echo "<th>modello</th>";
                            echo "<th>costo</th>";
                            echo "<th>cilindrata</th>";
                            echo "<th>annoproduzione</th>";
                        echo"</tr>";
                    echo"</thead>";
                    echo"<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo"<tr>";
                                echo "<td>".$row['id']."</td>";
                                echo "<td>".$row['modello']."</td>";
                                echo "<td>".$row['costo']."</td>";
                                echo "<td>".$row['cilindrata']."</td>";
                                echo "<td>".$row['annoproduzione']."</td>";
                            echo"</tr>";
                        }
                    echo"</tbody>";
                echo"</table>";
    
            }
        }else{
            echo "something went wrong";
        }
    
        mysqli_stmt_close($stmt);
    }else{
        header("location: error.php");
        exit();
    }
}
?>
<br>
    <form action="ricerca.php">
        <input type="submit" value="Indietro">
    </form>
</body>
</html>s