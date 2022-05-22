<?php
session_start();
if (empty($_SESSION['uname'])) {
    header("Location: ../index.php");
}
?>

<?php
if (isset($_POST["sub"])) {
    require_once '../Database/config.php';

    $sql = "INSERT INTO tutor(id_utente) VALUES (?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        $id = $_SESSION["id"];

        if (mysqli_stmt_execute($stmt)) {
            header("Location: istutor.php");
            exit();
        } else {
            echo "errore in esecuzione";
        }

        mysqli_stmt_close($stmt);
    } else {
        echo "errore in sql";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../logo/logo_small_icon_only.png">
    <title>Diventa tutor</title>
    <link rel="stylesheet" href="diventatutor.css">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <center>
        <fieldset> 
        <br><br><br>
            SICURO DI VOLER DIVENTARE TUTOR?<br><br><br>
            <input type="submit" class="si" value="Sì" name="sub" />
            <input type="button" class="no" onclick="location.href='../Homepage/index.php'" value="No"/>
            <br><br><br>
        </fieldset>
        </center>
    </form>
</body>

</html>