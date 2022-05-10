<?php
session_start();

if(!isset($_SESSION['uname'])){
  header('location: ../Login/');
}
/*$_SESSION['uname']=$uname;
$_SESSION['id']=$row["id"];*/
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <link rel="icon" href="../logo/logo_small_icon_only.png">
    <title>Homepage</title>
</head>
<body>
<?php
    require_once '../Database/config.php';
    $id=$_SESSION['id'];
    $sql="SELECT immagine_profilo FROM utente WHERE id='$id'";

    if($stmt = mysqli_prepare($link,$sql)){

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($result)) {
              $img_profilo=$row['immagine_profilo'];
              $_SESSION['img']=$img_profilo;
            }

        }
    }else{
        echo "something went wrong";
    }

    mysqli_stmt_close($stmt);

    include '../header/navbar.php'
?>   

      
    </body>
</html>