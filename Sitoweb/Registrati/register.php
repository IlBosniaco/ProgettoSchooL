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
</head>

<body>
    <h2>Registrati per poter accedere al sito web</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <p>Nome:
            <input type="text" name="nome" id="" required autofocus>
        </p>
        <p>Cognome:
            <input type="text" name="cognome" id="" required>
        </p>
        
        <p>Sesso:
        <input type="radio" name="sesso" id="sesso" value="M">Maschio
        <input type="radio" name="sesso"id="sesso" value="F">Femmina
        
        
        <p>Classe: </p>
        <p>
            Anno:
            <select name="anno" id="" required>
                <option disabled selected value> -- Seleziona un'opzione -- </option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
            </select>
            Sezione:
            <select name="sezione" id="" required>
                <option disabled selected value> -- Seleziona un'opzione -- </option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>
            indirizzo:
            <select name="indirizzo" id="" required>
                <option disabled selected value> -- Seleziona un'opzione -- </option>
                <option value="INF">INF</option>
                <option value="LSA">LSA</option>
                <option value="RIM">RIM</option>
                <option value="MEC">MEC</option>
            </select>
            
        </p>
        <p>Email:
            <input type="email" name="email" id="email" required>
        </p>
        <!--<p>Password:
            <input type="password" name="password" id="password" required>
            <input type="checkbox" onclick='seePassword("password")'>Show Password
        </p>
        <p>Conferma password:
            <input type="password" name="conf_password" id="conf_password" required>
            <input type="checkbox" onclick='seePassword("conf_password")'>Show Password
        </p>
        LA PASSWORD ALLA REGISTRAZIONE E' RANDOM-->
        <p>Num Telefono:
        <input type="text" name="numTel" placeholder="non obbligatorio" id="">
        <p>
            <input type="submit" value="Registrati"> o
            <a href="register.php">Annulla</a>
        </p>
    
        
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $nome = mysqli_real_escape_string($link, $_POST['nome']);
                    $cognome = mysqli_real_escape_string($link, $_POST['cognome']);
                    $nome_utente=$cognome."_".$nome;
                    $email = mysqli_real_escape_string($link, $_POST['email']);
                    //immagine profilo è di default
                    $immagine_profilo='DEFAULT';
                    $anno = mysqli_real_escape_string($link, $_POST['anno']);
                    $sezione = mysqli_real_escape_string($link, $_POST['sezione']);
                    $indirizzo = mysqli_real_escape_string($link, $_POST['indirizzo']);
                    $sesso = mysqli_real_escape_string($link, $_POST['sesso']);
                    
                    //GENERO LA PASSWORD RANDOM
                    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                    $randstring = '';
                    for ($i = 0; $i < 10; $i++) {
                        $index = rand(0, strlen($characters) - 1);
                        $randstring .= $characters[$index];
                    }
                    $query= "INSERT INTO utente VALUES (' ', '$nome_utente', '$email', '$randstring', DEFAULT, '$anno', '$sezione','$indirizzo','$nome','$cognome',' ','$sesso')";
                    $result= mysqli_query($link,$query);
                    //echo "REGISTRAZIONE COMPLETATA";
                    if($result)
                    header("location: ../Login/");                
    }

    ?>

</body>

</html>