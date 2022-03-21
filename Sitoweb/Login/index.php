<?php
if($_SERVER["REQUEST_METHOD"] == "post" || $_SERVER["REQUEST_METHOD"] == "POST"){
    require_once 'config.php';

    $sql="SELECT email, password FROM utente WHERE email=? AND password=?";

    if($stmt = mysqli_prepare($link,$sql)){
        mysqli_stmt_bind_param($stmt, "ss", $param_email, $param_password);

        $param_email = trim($_POST["email"]);
        $param_password = trim($_POST["password"]);

        if(mysqli_stmt_execute($stmt)){//inserisce i dati
            $result = mysqli_stmt_get_result($stmt);
            $i=0;
            foreach($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                if(){//controllo utente e password corretto

                }else if(){//controllo solo utente corretto

                }else{//controllo utente non trovato
                }
            }else{
                header("location: error.php");
                exit();
            }
        }
    }else{
        echo "something went wrong";
    }

    mysqli_stmt_close($stmt);
}else{
    header("location: error.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Login sitoweb</title>
    <link rel="stylesheet" href="stylee.css">
    <link rel="icon" href="Image/jean_monnet_logo.jfif">
  </head>
  <body>
    <div class="center">
      <h1>Login</h1>
      <form method="post" >
        <div class="txt_field">
          <input type="text" name="email"required>
          <span></span>
          <label>cognome_nome@ismonnet.onmicrosoft.com</label>
        </div>
        <div class="txt_field">
          <input type="password" name="password"required>
          <span></span>
          <label>Password</label>
        </div>
        <div class="pass">
        <a href="https://agora.ismonnet.it/resetPsw/capResetPsw-mail.php">password dimenticata?</a>
        </div>
        <input type="submit" value="Login">
        <!--<div class="signup_link">
          Non sei iscritto? <a href="#">Registrati</a>
        </div>-->
      </form>
    </div>

  </body>
</html>
