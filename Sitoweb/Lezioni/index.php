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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <title>Le mie lezioni</title>
    <style type="text/css">
    .wrapper {
        width: 650px;
        margin: 0 auto;
    }
    .table{
        width: 1000px;
    }
    </style>
</head>

<body>

    <?php
            include_once '../header/navbar.php';//navbar
        ?>

    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <center><h2 class="">RIPETIZIONI CHE OFFRO</h2></center>
                </div>
            </div>
            </div>
    </div>  
                <?php
                        require_once '../Database/config.php';
                        
                        
                        $sql = 'SELECT u.nome, u.cognome, u.anno, u.sezione, u.indirizzo, u.email, u.numTelefono, m.materia,mt.descrizione, mt.prezzi_ora 
                        FROM utente u, lezioni l, materiatutor mt, materie m
                        WHERE u.id=l.id_alunno AND l.id_ripetizione=mt.id_ripetizione AND m.id=mt.idmaterie
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
                                        echo "<center>";
                                        echo "<table class='table table-bordered table-striped'>";
                                        echo "<thead >";
                                        echo "<tr>";
                                            echo "<th>nome</th>";
                                            echo "<th>cognome</th>";
                                            echo "<th>classe</th>";
                                            echo "<th>email</th>";
                                            echo "<th>numTelefono</th>";
                                            echo "<th>materia</th>";
                                            echo "<th>descrizione</th>";
                                            echo "<th>prezzo</th>";
                                        echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo '<tr style="text-align:center ; background-color:rgb(255, 255, 200);">';
                                                echo "<td>".$row['nome']."</td>";
                                                echo "<td>".$row['cognome']."</td>";
                                                echo "<td>".$row['anno'].$row['sezione']." ".$row['indirizzo']."</td>";
                                                echo "<td><a style='color:black' href='mailto:".$row['email']."' >".$row['email']."</a></td>";
                                                echo "<td><a style='color:black' href='https://wa.me/+39".$row['numTelefono']."' >".$row['numTelefono']."</a></td>";
                                                echo "<td>".$row['materia']."</td>";
                                                echo "<td>".$row['descrizione']."</td>";
                                                echo "<td>".$row['prezzi_ora']."€</td>";
                                            echo "</tr>";
                                        }
                                     echo "</tbody>";                                    
                                        echo "</table></center>";
                                        mysqli_free_result($result);
                                    } else echo "<p class='wrapper'><em>Nessuna ripetizione offerta prenotata</em></p>";
                                } else echo "<br>ERRORE: Errore nella sintassi della query";
                                
                            }else{
                                echo "errore";
                            }
                    ?>

    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <center><h2 class="">RIPETIZIONI CHE PRENDO</h2></center>
                </div>
            </div>
        </div>
    </div>
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
                                    
                                    echo "<center><table class='table table-bordered table-striped'>";
                                        echo "<thead>";
                                                echo "<tr>";
                                                    echo "<th>nome</th>";
                                                    echo "<th>cognome</th>";
                                                    echo "<th>classe</th>";
                                                    echo "<th>descrizione</th>";
                                                    echo "<th>materia</th>";
                                                    echo "<th>prezzo</th>";
                                                    echo "<th>email</th>";
                                                    echo "<th>telefono</th>";
                                                echo "</tr>";
                                            echo "</thead>";
                                        echo "<tbody>";
                                        while($row = mysqli_fetch_array($result)){
                                            echo '<tr style="text-align:center ; background-color:rgb(255, 255, 200);">';
                                                echo "<td>".$row['nome']."</td>";
                                                echo "<td>".$row['cognome']."</td>";
                                                echo "<td>".$row['anno'].$row['sezione']." ".$row['indirizzo']."</td>";
                                                echo "<td>".$row['descrizione']."</td>";
                                                echo "<td>".$row['materia']."</td>";
                                                echo "<td>".$row['prezzi_ora']."€</td>";
                                                echo "<td><a style='color:black' href='mailto:".$row['email']."' >".$row['email']."</a></td>";
                                                echo "<td><a style='color:black' href='https://wa.me/+39".$row['numTelefono']."' >".$row['numTelefono']."</a></td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";                            
                                    echo "</table></center>";
                                        mysqli_free_result($result);
                                    } else echo "<p class='wrapper'><em>Non hai prenotato nessuna ripetizione</em></p>";
                                } else echo "<br>ERRORE: Errore nella sintassi della query";
                                
                            }else{
                                echo "errore";
                            }
                            
                    ?>
</body>

</html>