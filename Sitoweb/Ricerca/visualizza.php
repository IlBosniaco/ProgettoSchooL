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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <link rel="stylesheet" href="visualizzastyle.css">

</head>
<body>
<?php
    if (isset($_GET["id"])&& !empty(trim($_GET["id"]))) {
        require_once '../Database/config.php';

        include_once '../header/navbar.php';//navbar
    
        $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id INNER JOIN materiatutor ON tutor.id_utente=materiatutor.idtutor INNER JOIN materie ON materiatutor.idmaterie=materie.id WHERE utente.id=? AND materia=?";
    
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "is", $param_id, $param_materia);
    
            $param_id = trim($_GET["id"]);
            $param_materia = trim($_GET["materia"]);
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                $row = mysqli_fetch_array($result);
                ?>
                <div class="container emp-profile">
        
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img  class="logo" style="vertical-align: middle; width: 15em; height: 15em; border-radius: 50%;" src="<?php 
                                    echo $row['immagine_profilo'];
                                ?>" style="width:250px;height:200px;" >
                                
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="profile-head">
                                <br>
                                <h4>
                                    <?php echo $row['nome_utente']?>
                                </h4>
                                <br><br><br>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true">Profilo</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        
                    </div>
                    
        
            
                    <div class="row">
                        <div class="col-md-8">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Nome</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $row['nome']." ".$row['cognome']?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Classe</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $row['anno']. " ".$row['sezione']. " ".$row['indirizzo']?></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>Sesso</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $row['sesso']?></p>
                                        </div>
                                    </div>
                                    
                                    <div class="row">       
                                        <div class="col-md-6">
                                            <label>materia:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $row['materia']?></p>
                                        </div>
                                    </div>                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>prezzo:</label>
                                        </div>
                                        <div class="col-md-6">
                                            <p><?php echo $row['prezzi_ora']."€/h"?></p>
                                        </div>
                                    </div>  
                                    
                                    <?php
                                        if($row['descrizione']!=NULL){
                                            echo "<br>";
                                            echo "<div class='row'>";
                                                echo "<div class='col-md-2'>";
                                                    echo '<div class="profile-head">';
                                                        echo '<ul class="nav nav-tabs" id="myTab" role="tablist">';
                                                            echo '<li class="nav-item">';
                                                                echo '<a class="nav-link active" id="home-tab">DESCRIZIONE</a>';
                                                            echo '</li>';
                                                        echo '</ul>';
                                                    echo '</div>';
                                                echo '</div>'; 
                                            echo '</div>';
                                            echo '<div class="row">';
                                                    echo "<p>".$row['descrizione']."</p>";                                            
                                            echo '</div>'; 
                                        }
                                    ?>                                  
                                </div>                             
                            </div>
                        </div> 
                    </div>
                    
                    <br>
                    <form action="prenota.php" action="post">
                        <center><input type="submit" value="PRENOTA" class="profile-edit-btn" id="editPwd" value="Edit Password"></center>
                    </form>

                </div>
            <?php
            }else{
                header("location: error.php");
                exit();
            }
            
        }
        mysqli_stmt_close($stmt);
    }else{
        if (empty(trim($_GET["id"]))) {
           header("location: error.php");
           exit();
        }
    }
?>

    <form action="ricerca.php">
        <input type="submit" value="Indietro">
    </form>
</body>
</html>