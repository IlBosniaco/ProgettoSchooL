<?php
require_once '../Database/config.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="functions.js"></script>
    <title>JMripetizioni - Registrati</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css"
        integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
    a:link,
    a:visited {
        color: white;
    }
    </style>
</head>

<body>
    <div class="main-block">
        <div class="left-part">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="title">
                    <i class="fas fa-pencil-alt"></i>
                    <h2>Registrati </h2>
                </div>
                <div class="info">
                    <input class="fname" type="text" name="nome" placeholder=" Nome">
                    <input class="fname" type="text" name="cognome" placeholder=" Cognome">
                    <input type="text" name="email" placeholder=" Email">
                    <select name="sesso" id="" required>
                        <option disabled selected value>Sesso</option>
                        <option value="M">Maschio</option>
                        <option value="F">Femmina</option>
                    </select>
                    <select name="anno" id="" required>
                        <option disabled selected value>Anno</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <select name="sezione" id="" required>
                        <option disabled selected value>Sezione</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                        <option value="E">E</option>
                        <option value="F">F</option>

                    </select>
                    <select name="indirizzo" id="" required>
                        <option disabled selected value>Indirizzo</option>
                        <option value="MEC">MEC</option>
                        <option value="ENE">ENE</option>
                        <option value="INF">INF</option>
                        <option value="TUR">TUR</option>
                        <option value="CHI">CHI</option>
                        <option value="AFM">AFM</option>
                        <option value="RIM">RIM</option>
                        <option value="LSA">LSA</option>
                        <option value="LL">LL</option>

                    </select>
                    <input class="fname" type="text" name="numTel" id="numTel"
                        placeholder=" Num Telefono (non obbligatorio)">
                </div>
                <!--LA PASSWORD ALLA REGISTRAZIONE E' RANDOM-->
                <?php
                    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    
                        $nome = mysqli_real_escape_string($link, $_POST['nome']);
                        $nome_maiuscolo = ucfirst(strtolower($nome)); 
                        $cognome = mysqli_real_escape_string($link, $_POST['cognome']);
                        $cognome_maiuscolo = ucfirst(strtolower($cognome)); 

                        $nome_utente=$cognome."_".$nome;
                        $email = mysqli_real_escape_string($link, $_POST['email']);
                        $immagine_profilo='DEFAULT';
                        $anno = mysqli_real_escape_string($link, $_POST['anno']);
                        $sezione = mysqli_real_escape_string($link, $_POST['sezione']);
                        $indirizzo = mysqli_real_escape_string($link, $_POST['indirizzo']);
                        $sesso = mysqli_real_escape_string($link, $_POST['sesso']);
                            //Controllo email gi?? usata 
                             $sql_query="SELECT COUNT(*) AS cntEmail FROM utente WHERE email=?";
                            if($stmt = mysqli_prepare($link,$sql_query)){
                                mysqli_stmt_bind_param($stmt, "s", $email);                   
                                if(mysqli_stmt_execute($stmt)){
                                    $result = mysqli_stmt_get_result($stmt);
                                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                                    if($row["cntEmail"]==1){//email gi?? usata
                                        echo '<div class="alert alert-danger" style="display:flex; justify-content: center; color:red;  " role="alert">';
                                        echo 'Email gi?? in uso';
                                        echo '</div>';
                                    }
                                    else{//GENERO LA PASSWORD RANDOM
                                        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                        $randstring = '';
                                        for ($i = 0; $i < 10; $i++) {
                                        $index = rand(0, strlen($characters) - 1);
                                        $randstring .= $characters[$index];
                                        }
                                        $rand_pass=md5($randstring);
                                        $query= "INSERT INTO utente VALUES (NULL, '$nome_utente', '$email', '$rand_pass', DEFAULT, '$anno', '$sezione','$indirizzo','$nome_maiuscolo','$cognome_maiuscolo',NULL,'$sesso')";
                                        if ($link->query($query) === TRUE) { //updating success

                                            //invio email                                           
                                            $to= $email;//email utente
                                            $subject="Registrazione Completata";
                                            $message="nomeutente:".$nome_utente."\n\npassword: ".$randstring;
                                            $sender="";
                                            //$from="corsophp@gmail.com"
                                            if(mail($to,$subject,$message,$sender))
                                            {
                                                echo "?? stata inviata un email con la password temporanea \n";
                                                echo '<div class="alert alert-success" style="display:flex; justify-content: center; color:green;  " role="alert">';
                                                echo 'Registrazione completata'.'<a href="../Login/index.php">Torna alla login</a>';
                                                echo '</div>';
                                            }
                                            else{
                                                echo "errore nell'invio email";
                                            }

                                        } else {
                                            echo "Error updating record: " . $link->error. " ".$query;
                                        }                                      
                                    }     
                                }                      
                            }
                    }
?>
                <button type="submit" href="/">Registrati</button>
                <button type="reset" href="register.php">Annulla</button>
            </form>
        </div>
    </div>
</body>

</html>