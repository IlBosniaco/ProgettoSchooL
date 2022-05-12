<?php
session_start();
if(!isset($_SESSION['uname'])){
    header('location: ../Login/index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Cerca Tutor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!--link card-->
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <link rel="stylesheet" href="ricercastyle.css">
    <link rel="icon" href="../logo/logo_small_icon_only.png">
    <script src="../Registrati/functions.js"></script>
</head>

<body>
    <?php
        include_once '../header/navbar.php';//navbar
    ?>

    <div class="row">
        <div class="col-md-4">
            <!--RICERCA-->
            <div class="main-block">
                <div class="left-part">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="title">
                            <i class="fas fa-pencil-alt"></i>
                            <h2>FILTRI RICERCA</h2>
                        </div>
                        <div class="info">
                            <select name="sesso" id="">
                                <option disabled selected value>Sesso</option>
                                <option value="maschio">Maschio</option>
                                <option value="femmina">Femmina</option>
                            </select>
                            <select name="materia"
                                onchange="document.getElementById('selected_id').value=this.options[this.selectedIndex].text">
                                <option disabled selected value>Materia</option>
                                <?php  
                                require_once '../Database/config.php';
                                $sql = "SELECT materia FROM materie";
                                $result = mysqli_query($link,$sql);
                
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
                                echo "<option value='".$row['materia']."'>".$row['materia']."</option>";
                                }                                
                                ?>
                            </select>
                            <button type="submit" href="/">Cerca</button>
                            <button type="reset" href="register.php">Annulla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8" align-content="center">
            <center>
                <h2>LISTA TUTOR</h2>
            </center>

            <?php
                    require_once '../Database/config.php';
                    $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id INNER JOIN materiatutor ON tutor.id_utente=materiatutor.idtutor INNER JOIN materie ON materiatutor.idmaterie=materie.id ";
                    $query=false;
                    if($_SERVER["REQUEST_METHOD"] == "post" || $_SERVER["REQUEST_METHOD"] == "POST"){ 
                        $query=true;
                        if(empty($_POST["materia"])){
                            $sql.="WHERE  materia != ? ";
                            $param_materia="";//materia!=all vuoldire che cerca tutte le materie
                        }else{
                            $sql.="WHERE materia = ? ";
                            $param_materia = trim($_POST["materia"]);
                        }
                        
                        
                        if(empty($_POST["sesso"])){
                            $sql.=" AND sesso != ?";
                            $param_sesso="";
                        }else{
                            $sql.=" AND sesso = ?";
                            $sesso = trim($_POST["sesso"]);
                            $param_sesso = $sesso[0]; //prendo primo carattere perche nel database salvato come M/F
                        }        
                    }
                    //id_utente     descrizione     valutazione     numero_recensioni   prezzi_ora  link_meet   nome_utente 
                    //email     password    immagine_profilo   anno  sezione  indirizzo    nome   cognome   numTelefono   sesso     materia 
                    if($stmt = mysqli_prepare($link,$sql)){
                        if($query==true)
                            mysqli_stmt_bind_param($stmt, "ss", $param_materia, $param_sesso);

                        if(mysqli_stmt_execute($stmt)){
                            $result = mysqli_stmt_get_result($stmt);
                            if(mysqli_num_rows($result)>0){                              
                                    while ($row = mysqli_fetch_array($result)) {
                                        if($row['id_utente']!=$_SESSION['id']){
                                            echo "<div class='container mt-5 d-flex justify-content-center'>";
                                            echo "<div class='card p-3'>";
                                            echo "<div class='d-flex align-items-center'>";
                                            echo "<div class='image'>";
                                            echo "<img src='".$row['immagine_profilo']."' class='profile'>";
                                            echo "</div>";
                                            echo "<div class='ml-4 w-100'>";
                                            echo "<h4 class='mb-0 mt-0'>".$row['nome_utente']."</h4>";
                                            echo "<span>".$row['materia']."</span>";
                                            echo "<div class='p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats'>";
                                            echo "<div class='d-flex flex-column'>";
                                            echo "<span class='articles'>Classe</span>";
                                            echo "<span class='number1'>".$row['anno'].$row['sezione'].$row['indirizzo']."</span>";
                                            echo "</div>";
                                            echo "<div class='d-flex flex-column'>";
                                            echo "<span class='followers'>Prezzo</span>";
                                            echo "<span class='number2'>".$row['prezzi_ora']."€/h</span>";
                                            echo "</div>";
                                            echo "<div class='d-flex flex-column'>";
                                            echo "<span class='rating'>Rating</span>";
                                            echo "<span class='number3'>".$row['valutazione']."</span>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "<div class='button mt-2 d-flex flex-row align-items-center'>";
        
                                            echo "<a href='visualizza.php?id=".$row['id_utente']."&materia=".$row['materia']."'><button class='btn btn-sm btn-outline-primary w-100'>Dettagli</button></a>";
                                            echo "<a href='prenota.php?id=".$row['id_utente']."&utente=".$_SESSION['id']."'><button class='btn btn-sm btn-primary w-100 ml-2'>Prenota</button></a>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>";
                                            echo "</div>"; 
                                        }
                                    }    
                                                                   
                            }else{
                                echo "nessun risultato trovato";
                            }
                        
                        }else{
                            echo "something went wrong";
                        }
                    }else{
                        echo "could not execute statement";
                    } 
            ?>




        </div>
    </div>




</body>

</html>