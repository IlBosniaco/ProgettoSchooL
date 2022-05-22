<?php
    session_start();
    if(empty($_SESSION['id'])){
        header ("Location: ../index.php");
    }
?>

<?php
    if(isset($_POST["ID"]) && !empty($_POST["ID"])){
        require_once '../Database/config.php';
        
        $sql = "DELETE FROM materiatutor WHERE (id_ripetizione = ?);";
        if($stmt = mysqli_prepare($link, $sql)){
            mysqli_stmt_bind_param($stmt, "i", $ID);
            
            $ID = trim($_POST["ID"]);
            
            if(mysqli_stmt_execute($stmt)){
                header("Location: istutor.php");
                exit();
            } else {
                echo "errore in sql";
            }

            mysqli_stmt_close($stmt);
        } else {
            echo "errore in esecuzione";
        }
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Elimina lezione</title>
    </head>
    <body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <input type="hidden" name="ID" value="<?php echo trim($_GET["ID"]);?>"/>
            <p>Sei davvero sicuro di voler eliminare questa lezione?</p>
            <p>
                <input type="submit" value="Sì"/>
                <a href="istutor.php">No</a>
            </p>
        </form>
    </body>
</html>