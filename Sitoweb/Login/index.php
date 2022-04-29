<?php
  session_start();
    
  //se sessioneè gà attiva passa alla pagina della sessione
  if(isset($_SESSION['uname'])){
    header('Location: ../Homepage/index.php');
  }

  if(isset($_POST['but_submit'])){
    include "../Database/config.php";
    $uname=mysqli_real_escape_string($link,$_POST['uname']);
    $password=mysqli_real_escape_string($link,$_POST['pwd']);

    if($uname != "" && $password != ""){
        $sql_query="SELECT id,COUNT(*) AS cntUser FROM utente WHERE nome_utente=? AND password=?";
        if($stmt = mysqli_prepare($link,$sql_query)){
          mysqli_stmt_bind_param($stmt, "ss", $param_uname, $param_pass);
          
          $param_uname = trim($_POST["uname"]);
          $param_pass = trim($_POST["pwd"]);
  
          if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            if($row["cntUser"]==1){
              $_SESSION['uname']=$uname;
              $_SESSION['id']=$row["id"];
              header('Location: ../Homepage/index.php');
              exit(); 
            }else if($row["cntUser"]>1){
              echo "fatal error";
            }else{
              echo "invalid username or password";
            }
          }
      }else{
        echo "something went wrong";
      }
    }
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
        <a href="https://agora.ismonnet.it/resetPsw/capResetPsw-mail.php">password dimenticata?</a>
        </div>
        <input type="submit" value="Login" name="but_submit">
        <div class="signup_link">
          Non sei iscritto? <a href="../Registrati/register.php">Registrati</a>
        </div>
      </form>
    </div>

  </body>
</html>
