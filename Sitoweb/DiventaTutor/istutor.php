<?php
    session_start();
    if(!isset($_SESSION['uname'])){
        header('location: ../index.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <link rel="icon" href="../logo/logo_small_icon_only.png">
    <style type="text/css">
    
    .wrapper {
        width: 40%;
        margin: 0 auto;
    }

    .table{
        width: 1000px;
        height: 250px;
        background-color: black;
        color: white;
    }
    td{
        color:black;
        background-color: white;
    }

    input {
        margin-left: 50px;
    }
    .fields1{
        background-color: white;
        border-color: black;
        border: 20px;
        
    }
    </style>
    <title>Dati tutor</title>
</head>

<body>
    <?php
        include_once "../header/navbar.php";
        require_once '../Database/config.php';

    ?>
     <?php

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id=$_SESSION['id'];
            $id_materia=$_POST['idmateria'];
            $param_descrizione=$_POST['descrizione'];
            $param_prezzo=$_POST['prezzo'];
            //controlo prezzo
            if($param_prezzo>0)
            {
                echo $id." ".$id_materia." ".$param_descrizione." ".$param_prezzo;
                $query= "INSERT INTO materiatutor VALUES (NULL, $id, $id_materia, '$param_descrizione', '$param_prezzo')";
                if ($link->query($query) === TRUE) { //updating success
                    header("Refresh:0");                                
                } else {
                    echo "Error updating record: " . $link->error. " ".$query;
                }     
            }
            else{
                echo "<script type='text/javascript'>alert('prezzo deve essere positivo');</script>";
            }
        }
    ?>
    <div class="wrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <center>
                        <h2 class="">I MIEI ANNUNCI</h2>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <?php //visualiza i miei annunci
        $sql="SELECT * FROM tutor t LEFT JOIN materiatutor mt ON t.id_utente=mt.idtutor INNER JOIN materie m ON mt.idmaterie=m.id WHERE t.id_utente=?";

        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $_SESSION["id"];
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                if(mysqli_num_rows($result) > 0){
                    echo "<center>";
                    echo "<table class='table table-bordered table-striped'>";
                    echo "<thead >";
                    echo "<tr >";
                        echo "<th style='text-align:center'>MATERIA</th>";
                        echo "<th style='text-align:center'>DESCRIZIONE</th>";
                        echo "<th style='text-align:center'>PREZZO</th>";
                        echo "<th style='text-align:center'>ELIMINA</th>";
                    echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo '<tr style="text-align:center ; background-color:rgb(255, 255, 200);">';
                            echo "<td>".$row['materia']."</td>";
                            echo "<td>".$row['descrizione']."</td>";
                            echo "<td>".$row['prezzi_ora']."€</td>";
                            $link_elimina="elimina.php?ID=".$row['id_ripetizione'];
                            echo "<td><a href='$link_elimina'><img src='../logo/delete.png'</a></td>";
                        echo "</tr>";
                    }
                 echo "</tbody>";                                    
                    echo "</table></center>";
                    mysqli_free_result($result);
                } else {
                    echo "<p class='wrapper'><em>Non insegni nessuna materia</em></p>";
                }
            }         
        }else{
            echo "errore in esecuzione";
        }
    ?>
    <div class="wrapper">

        <div class="page-header clearfix">
            <center>
                <h2 class="">INSERISCI ANNUNCIO</h2>
            </center>
        </div>
        <fieldset class="fields1">
            
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <br><br>
            <p>SELEZIONA MATERIA
                <select name="idmateria"
                    onchange="document.getElementById('selected_id').value=this.options[this.selectedIndex].text"
                    required>
                    <option disabled selected value>Materia</option>
                    <?php  
                    require_once '../Database/config.php';
                    $id=$_SESSION['id'];
                    $sql = "SELECT * FROM materie ";//tutti gli utenti (tranne me)
                    $result = mysqli_query($link,$sql);
    
                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
                    echo "<option value='".$row['id']."'>".$row['materia']."</option>";
                    }                                
                    ?>
                </select>
            <p>Inserire descrizone <input type="text" name="descrizione" style="width:300px;"placeholder="promessi sposi, divina commedia..." required></p>
            <p>Inserire prezzo: <input type="number" style='width:50px' name="prezzo" value="0" required>€/h
            </p>
            <br>
            <center><input type="submit" value="Inserisci" class="btn btn-success"></center>
        </form>
        <br>
        </fieldset>
    </div>
    <br><br>
    <br><br>
</body>

</html>