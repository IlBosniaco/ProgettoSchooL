<?php
  session_start();

if(!isset($_SESSION['uname'])){
  header('location: ../Login/');
}
?>
<?php
    require_once '../Database/config.php';
    $new_password= trim($_POST["password"]);
    $id=$_SESSION['id'];
    echo $new_password." ".$id;

    $sql="UPDATE utente SET password='$new_password' WHERE id='$id'";

    if($stmt = mysqli_prepare($link,$sql)){

        if(mysqli_stmt_execute($stmt)){   
            echo "<script type='text/javascript'>alert('password modificata');</script>";     
            session_destroy();
            header('location: ../Login/');
        }
    }else{
        echo "something went wrong";
    }
    mysqli_stmt_close($stmt);
?>