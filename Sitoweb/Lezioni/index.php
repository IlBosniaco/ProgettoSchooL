<?php
    //fare 2 tabelle 
    //prima tabella --->ripetizioni che si offrono 

    /*
        SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, u.email, u.numTelefono
        FROM utente u, lezioni l
        WHERE u.id=l.id_alunno
        AND l.id_ripetizione IN ( 
            SELECT l.id_ripetizione 
            FROM utente u, tutor t, materiatutor mt, materie m, lezioni l 
            WHERE u.id=t.id_utente AND t.id_utente=mt.idtutor AND m.id=mt.idmaterie AND mt.id_ripetizione=l.id_ripetizione AND u.id=2);

        u.id---> $_SESSION['id']
        //stampa le informazioni dell'utente a cui devo offrire ripetizioni

        //N.B magari faccio una union dove stampa anche le info sulla materia 




    */
    //seconda tabella ->ripetizioni che ho prenotato
  
    /*
        SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, mt.descrizione, m.materia, mt.prezzi_ora, u.email, u.numTelefono 
        FROM utente u, tutor t, materiatutor mt, materie m, lezioni l 
        WHERE u.id=t.id_utente AND t.id_utente=mt.idtutor AND m.id=mt.idmaterie AND mt.id_ripetizione=l.id_ripetizione AND l.id_alunno=1;

        l.id_alunno= --->$_SESSION['id'] //ritorna tutte le ripetizioni dove il ripetente 'sono io'

    */
?>
<?php
    session_start();
    if(!isset($_SESSION['uname'])){
        header('location: ../index.php');
        exit();
    }
?>

<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../Stylesheets/style.css">
        <title>Le mie lezioni</title>
    </head>
    <body>

        <?php
            include_once '../header/navbar.php';//navbar
        ?>
        <center>
            <h1>Visualizza</h1>
            <h3>Lezioni</h3>
        </center>
       
        <?php
            require_once '../Database/config.php';
            

            $sql = 'SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, u.email, u.numTelefono
            FROM utente u, lezioni l 
            WHERE u.id=l.id_alunno
            AND l.id_ripetizione IN ( 
                SELECT l.id_ripetizione 
                FROM utente u, tutor t, materiatutor mt, materie m, lezioni l 
                WHERE u.id=t.id_utente AND t.id_utente=mt.idtutor AND m.id=mt.idmaterie AND mt.id_ripetizione=l.id_ripetizione AND u.id=?)';
                if($stmt = mysqli_prepare($link,$sql)){
                    mysqli_stmt_bind_param($stmt, "i", $param_id);

                    $param_id=$_SESSION['id'];
                    if(mysqli_stmt_execute($stmt)){
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){
                            echo '<table border="1" style="margin-top:20px;">';
                            echo '<tr><td>nome</td><td>cognome</td><td>anno</td><td>sezione</td><td>indirizzo</td><td>email</td><td>telefono</td></tr>';
                            
                            while($row = mysqli_fetch_array($result)){
                                echo '<tr style="text-align:center">';
                                    echo "<td>".$row['nome']."</td>";
                                    echo "<td>".$row['cognome']."</td>";
                                    echo "<td>".$row['anno']."</td>";
                                    echo "<td>".$row['sezione']."</td>";
                                    echo "<td>".$row['indirizzo']."</td>";
                                    echo "<td>".$row['email']."</td>";
                                    echo "<td>".$row['numTelefono']."</td>";
                                echo "</tr>";
                            }
                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else echo "<br>Non hai nessuna lezione";
                    } else echo "<br>ERRORE: Errore nella sintassi della query";
                    
                }else{
                    echo "errore";
                }


				
		?>

        <?php
            require_once '../Database/config.php';
            

            $sql = 'SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, mt.descrizione, m.materia, mt.prezzi_ora, u.email, u.numTelefono, m.materia 
            FROM utente u, tutor t, materiatutor mt, materie m, lezioni l 
            WHERE u.id=t.id_utente AND t.id_utente=mt.idtutor AND m.id=mt.idmaterie AND mt.id_ripetizione=l.id_ripetizione AND l.id_alunno=?';
                if($stmt = mysqli_prepare($link,$sql)){
                    mysqli_stmt_bind_param($stmt, "i", $param_id);

                    $param_id=$_SESSION['id'];
                    if(mysqli_stmt_execute($stmt)){
                        $result = mysqli_stmt_get_result($stmt);
                        if(mysqli_num_rows($result) > 0){
                            echo '<table border="1" style="margin-top:20px;">';
                            echo '<tr><td>nome</td><td>cognome</td><td>anno</td><td>sezione</td><td>indirizzo</td><td>descrizione</td><td>materia</td><td>prezzo/ora</td><td>email</td><td>telefono</td><td>materia</td></tr>';
                            
                            while($row = mysqli_fetch_array($result)){
                                echo '<tr style="text-align:center">';
                                    echo "<td>".$row['nome']."</td>";
                                    echo "<td>".$row['cognome']."</td>";
                                    echo "<td>".$row['anno']."</td>";
                                    echo "<td>".$row['sezione']."</td>";
                                    echo "<td>".$row['indirizzo']."</td>";
                                    echo "<td>".$row['descrizione']."</td>";
                                    echo "<td>".$row['materia']."</td>";
                                    echo "<td>".$row['prezzi_ora']."</td>";
                                    echo "<td>".$row['email']."</td>";
                                    echo "<td>".$row['numTelefono']."</td>";
                                    echo "<td>".$row['materia']."</td>";
                                echo "</tr>";
                            }
                            
                            echo "</table>";
                            mysqli_free_result($result);
                        } else echo "<br>Non hai nessuna lezione";
                    } else echo "<br>ERRORE: Errore nella sintassi della query";
                    
                }else{
                    echo "errore";
                }



				
		?>
    </body>
</html>


