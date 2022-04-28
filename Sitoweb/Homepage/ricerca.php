

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

    <div>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>" method="post">
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
session_start();

if(!isset($_SESSION['uname'])){
    header('location: ../Login/login.php');
}else{
    require_once '../Login/config.php';
    $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id";
    $query=false;
    if($_SERVER["REQUEST_METHOD"] == "post" || $_SERVER["REQUEST_METHOD"] == "POST"){ 
        $query=true;
        

        if(empty(trim($_POST["nome_utente"]))){
            $sql.=" WHERE nome_utente != ? ";
            $param_nome_utente="";
        }else{
            $sql.=" WHERE nome_utente = ? ";
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
            $sql.=" AND sesso != ?";
            $param_sesso="";
        }else{
            $sql.=" AND sesso = ?";
            $param_sesso = trim($_POST["sesso"]);
        }        

        
    }

    if($stmt = mysqli_prepare($link,$sql)){
        if($query==true)
            mysqli_stmt_bind_param($stmt, "ssss", $param_nome_utente, $param_nome,$param_cognome,$param_sesso);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)>0){
                echo "<table style='text-align:center;'>";
                    echo"<thead>";
                        echo"<tr>";
                            echo "<th>nome utente</th>";
                            echo "<th>nome</th>";
                            echo "<th>cognome</th>";
                            echo "<th>sesso</th>";
                            echo "<th>descrizione</th>";
                        echo"</tr>";
                    echo"</thead>";
                    echo"<tbody>";
                    while ($row = mysqli_fetch_array($result)) {
                        echo"<tr>";
                            echo "<td>".$row['nome_utente']."</td>";
                            echo "<td>".$row['nome']."</td>";
                            echo "<td>".$row['cognome']."</td>";
                            echo "<td>".$row['sesso']."</td>";
                            if($row['descrizione']!=null)
                                echo "<td>".$row['descrizione']."</td>";
                        echo"</tr>";
                    }
                    echo"</tbody>";
                echo"</table>";
            }else{
                echo "nessun risultato trovato";
            }
            

        }

        mysqli_stmt_close($stmt);
    }else{
        echo "smoething went wrong";
        exit();
    }
}
?>
<br>
    <form action="index.php">
        <input type="submit" value="Indietro">
    </form>
</body>
</html>