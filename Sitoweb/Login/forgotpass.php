<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="icon" href="../logo/logo_small_icon_only.png">
    <style>
    .form-gap {
        padding-top: 70px;
    }
    </style>
</head>

<body>
    <?php               
            if($_SERVER["REQUEST_METHOD"] == "post" || $_SERVER["REQUEST_METHOD"] == "POST"){ 
                $email=$_POST['email'];
                   //Controllo email già usata 
                   require_once '../Database/config.php';

                   $sql_query="SELECT nome_utente, COUNT(*) AS cntEmail FROM utente WHERE email=?";
                    if($stmt = mysqli_prepare($link,$sql_query)){
                       mysqli_stmt_bind_param($stmt, "s", $email);                   
                       if(mysqli_stmt_execute($stmt)){
                           $result = mysqli_stmt_get_result($stmt);
                           $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                           if($row["cntEmail"]==1){//email presente nel db
                               $nome_utente=$row['nome_utente'];
                               //GENERO LA PASSWORD RANDOM
                               $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                               $randstring = '';
                               for ($i = 0; $i < 10; $i++) {
                               $index = rand(0, strlen($characters) - 1);
                               $randstring .= $characters[$index];
                               }
                               //set on database new password
                               $query= "UPDATE utente SET password = '$randstring'WHERE email = '$email';";
                               if ($link->query($query) === TRUE) { //updating success

                                   //invio email                                           
                                   $to= $email;//email utente
                                   $subject="Reset Password";
                                   $message="nomeutente:".$nome_utente."\n\npassword: ".$randstring;
                                   $sender="";
                                   if(mail($to,$subject,$message,$sender))
                                   {
                                       echo '<div class="alert alert-success" style="display:flex; justify-content: center; color:green;  " role="alert">';
                                       echo 'La password nuova è stata inviata all indirizzo di posta elettroncia';
                                       echo '</div>';
                                   }
                                   else{
                                       echo "errore nell'invio email";
                                   }
                                }
                           }
                           else{    
                               echo "email non registrata";                        
                           }     
                       }                      
                   }
            }

                
            
        ?>

    <div class="form-gap"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="text-center">
                            <h3><i class="fa fa-lock fa-4x"></i></h3>
                            <h2 class="text-center">Forgot Password?</h2>
                            <p>You can reset your password here.</p>
                            <div class="panel-body">

                                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                                    <div class="form-group">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-envelope color-blue"></i></span>
                                            <input id="email" name="email" placeholder="email address"
                                                class="form-control" type="email" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input name="recover-submit" class="btn btn-lg btn-primary btn-block"
                                            value="Reset Password" type="submit">
                                    </div>

                                    <input type="hidden" class="hide" name="token" id="token" value="">
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>