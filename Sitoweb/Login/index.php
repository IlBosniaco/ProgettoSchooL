<?php
  session_start();
    
  //se sessioneè gà attiva passa alla pagina della sessione
  if(isset($_SESSION['uname'])){
    header('Location: ../Homepage/index.php');
    exit();
  }

  if(isset($_POST['but_submit'])){
    include "../Database/config.php";
    $param_uname = trim($_POST["uname"]);
    $pass = trim($_POST["pwd"]);
    $param_pass=md5($pass);
    
    if($param_uname != "" && $param_pass != ""){
      echo $param_pass;
      $sql_query="SELECT id,COUNT(*) AS cntUser FROM utente WHERE nome_utente=? AND password=?";
      if($stmt = mysqli_prepare($link,$sql_query)){
        mysqli_stmt_bind_param($stmt, "ss", $param_uname, $param_pass);
        if(mysqli_stmt_execute($stmt)){
          $result = mysqli_stmt_get_result($stmt);
          $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
          echo "cntUSer:".$row['cntUser'];
            if($row["cntUser"]==1){
              $_SESSION['uname']=$param_uname;
              $_SESSION['id']=$row["id"];
              header('Location: ../Homepage/index.php');
              exit(); 
            }else if($row["cntUser"]>1){
              header("Refresh:0");
            }else{
              header("Refresh:0");
            }
        }
        else{
          echo "Error updating record: " . $link->error. " ".$query;
        }
      }
      
    }
  }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="loginstyle.css">
    <link rel="icon" href="../logo/logo_small_icon_only.png">
</head>

<body>
    <div class="center">
        <center><img src="../logo/logo_small.png" width="400px"></center>
        <h1>Login</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">
            <div class="txt_field">
                <input type="text" name="uname" required>
                <span></span>
                <label>cognome_nome</label>
            </div>
            <div class="txt_field">
                <input type="password" name="pwd" required>
                <span></span>
                <label>Password</label>
            </div>
            <div class="pass">
                <a href="forgotpass.php">password dimenticata?</a>
            </div>
            <input type="submit" value="Login" name="but_submit">
            <div class="signup_link">
                Non sei iscritto? <a href="../Registrati/register.php">Registrati</a>
            </div>
        </form>
    </div>

</body>

</html>