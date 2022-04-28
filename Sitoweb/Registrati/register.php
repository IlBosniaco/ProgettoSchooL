<?php
require_once '../config.php';
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
        <input type="radio" id="sesso" value="M">Maschio
        <input type="radio" id="sesso" value="F">Femmina
        
        
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
                <option value="1">A</option>
                <option value="2">B</option>
                <option value="3">C</option>
                <option value="4">D</option>
            </select>
            Corso:
            <select name="sezione" id="" required>
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
        <p>Password:
            <input type="password" name="password" id="password" required>
            <input type="checkbox" onclick='seePassword("password")'>Show Password
        </p>
        <p>Conferma password:
            <input type="password" name="conf_password" id="conf_password" required>
            <input type="checkbox" onclick='seePassword("conf_password")'>Show Password
        </p>
        <p>
            <input type="submit" value="Registrati"> o
            <a href="index.html">Annulla</a>
        </p>
    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (strcmp($_POST['password'], $_POST['conf_password']) != 0) {
                echo '<p class="error">Le due password non sono uguali</p>';
            } else {
                $sql = "SELECT nome_utente FROM utente";
                if ($stmt = mysqli_prepare($link, $sql)) {
                    if (mysqli_stmt_execute($stmt)) {
                        $result = mysqli_stmt_get_result($stmt);
                        if (mysqli_num_rows($result) > 0) {
                            echo '<p class="error">Username già esistente</p>';
                        } else {
                            $nome = mysqli_real_escape_string($link, $_POST['nome']);
                            $cognome = mysqli_real_escape_string($link, $_POST['cognome']);
                            $nome_utente=$cognome."_".$nome;
                            $anno = mysqli_real_escape_string($link, $_POST['anno']);
                            $sezione = mysqli_real_escape_string($link, $_POST['sezione']);
                            $idCorso = mysqli_real_escape_string($link, $_POST['corso']);
                            $username = mysqli_real_escape_string($link, $_POST['username']);
                            $password = mysqli_real_escape_string($link, $_POST['password']);
                            $sql = "INSERT INTO utenti (`nome`, `cognome`, `anno`, `sezione`, `IDCorso`, `username`, `password`)  VALUES (?, ?, ?, ?, ?, ?, ?)";
                            if ($stmt = mysqli_prepare($link, $sql)) {
                                mysqli_stmt_bind_param($stmt, 'ssisiss', $nome, $cognome, $anno, $sezione, $idCorso, $username, $password);
                                if (mysqli_stmt_execute($stmt)) {
                                    header('location: register-success.php');
                                } else {
                                    echo '<p class="error">Qualcosa è andato storto. Riprova più tardi</p>';
                                }
                            } else {
                                echo '<p class="error">Qualcosa è andato storto. Riprova più tardi</p>';
                            }
                        }
                    } else {
                        echo '<p class="error">Qualcosa è andato storto. Riprova più tardi</p>';
                    }
                } else {
                    echo '<p class="error">Qualcosa è andato storto. Riprova più tardi</p>';
                }
            }
    }

    ?>

</body>

</html>