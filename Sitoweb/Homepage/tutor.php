<?php
session_start();

if(!isset($_SESSION['uname'])){
    header('location: ../Login');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<div>
    <form action="tutor.php" method="post">
        <label for="nome_utente">nome utente</label>
        <input type="text" name="nome_utente"><br>
        <label for="nome">nome</label>
        <input type="text" name="nome"><br>
        <label for="cognome">cognome</label>
        <input type="text" name="cognome"><br>
        <label for="sesso">sesso</label>
        <input type="text" name="sesso"><br>
        <input type="submit" name="btn" value="Cerca">
    </form>
</div>

<?php
require_once '../config.php';

$sql="SELECT * FROM (SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id) AS tblTutor WHERE ";

if(empty(trim($_POST["nome_utente"]))){
    $sql.=" nome_utente != ? ";
    $param_nome_utente="";
}else{
    $sql.=" nome_utente = ? ";
    $param_nome_utente = trim($_POST["nome_utente"]);
}

if(empty(trim($_POST["nome"]))){
    $sql.=" AND nome != ? ";
    $param_nome="";
}else{
    $sql.=" AND nome = ? ";
    $param_nome = trim($_POST["nome"]);
}

if(empty(trim($_POST["cognome"]))){
    $sql.=" AND cognome != ? ";
    $param_cognome="";
}else{
    $sql.=" AND cognome = ? ";
    $param_cognome = trim($_POST["cognome"]);
}

if(empty(trim($_POST["sesso"]))){
    $sql.=" AND sesso != ? ";
    $param_sesso="";
}else{
    $sql.=" AND sesso = ? ";
    $param_sesso = trim($_POST["sesso"]);
}

if($stmt = mysqli_prepare($link,$sql)){
    mysqli_stmt_bind_param($stmt, "siii", $param_nome_utente, $param_nome,$param_cognome,$param_sesso);

    if(mysqli_stmt_execute($stmt)){
        $result = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($result)>0){
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
        }else{
            echo "nessun risultato trovato";
        }
       

    }
}else{
    echo "something went wrong";
}

mysqli_stmt_close($stmt);

?>
</body>
</html>