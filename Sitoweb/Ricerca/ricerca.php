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
    <title>HomePage</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="ricercastyle.css">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../Registrati/functions.js"></script>
</head>
<body>
<?php
    include_once '../header/header.php';//navbar

    require_once '../Database/config.php';
    $sql="SELECT * FROM tutor INNER JOIN utente ON tutor.id_utente=utente.id INNER JOIN materiatutor ON tutor.id_utente=materiatutor.idtutor INNER JOIN materie ON materiatutor.idmaterie=materie.id";
    $query=false;
    if($_SERVER["REQUEST_METHOD"] == "post" || $_SERVER["REQUEST_METHOD"] == "POST"){ 
        $query=true;
        

        if(empty(trim($_POST["materia"]))){
            $sql.=" WHERE materia != ? ";
            $param_materia="";
        }else{
            $sql.=" WHERE materia = ? ";
            $param_materia = trim($_POST["materia"]);
        }
        
        
        if(empty($_POST["sesso"])){
            $sql.=" AND sesso != ?";
            $param_sesso="";
        }else{
            $sql.=" AND sesso = ?";
            $param_sesso = trim($_POST["sesso"]);
        }        
    }

    $sql.=" GROUP BY nome_utente";

    if($stmt = mysqli_prepare($link,$sql)){
        if($query==true)
            mysqli_stmt_bind_param($stmt, "ss", $param_materia, $param_sesso);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);
            if(mysqli_num_rows($result)>0){
               echo "<table style='text-align:center;'>";
                    echo"<thead>";
                        echo"<tr>";
                            echo "<th>nome utente</th>";
                            echo "<th>nome</th>";
                            echo "<th>cognome</th>";
                            echo "<th>sesso</th>";
                            echo "<th>materia</th>";
                            echo "<th>descrizione</th>";
                            echo "<th>visualizza</th>";
                        echo"</tr>";
                    echo"</thead>";
                    echo"<tbody>";
                    while ($row = mysqli_fetch_array($result)) {
                        if($row['id']!=$_SESSION['id']){
                            echo"<tr>";
                                echo "<td>".$row['nome_utente']."</td>";
                                echo "<td>".$row['nome']."</td>";
                                echo "<td>".$row['cognome']."</td>";
                                echo "<td>".$row['sesso']."</td>";
                                echo "<td>".$row['materia']."</td>";
                                if($row['descrizione']!=null)
                                    echo "<td>".$row['descrizione']."</td>";
                                else
                                    echo "<td/>";
                                echo "<td><a href='visualizza.php?id=".$row['id_utente']."'>V</a></td>";
                            echo"</tr>";
                        }
                    }
                    echo"</tbody>";
                echo"</table>";
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
    <!--
QUESTA E' LA CARD CHE VIENE VISUALIZZATA QUANDO FA IL WHILE
        <form action="" method="post">
    <div class="container mt-5 d-flex justify-content-center">
    <div class="card p-3">
    <div class="d-flex align-items-center">
    <div class="ml-3 w-100">
       <h4 class="mb-0 mt-0"><?php ?></h4>
       <span>Senior Journalist</span>
       <div class="p-2 mt-2 bg-primary d-flex justify-content-between rounded text-white stats">
        <div class="d-flex flex-column">
            <span class="articles">Articles</span>
            <span class="number1">38</span>
        </div>
        <div class="d-flex flex-column">
            <span class="followers">Followers</span>
            <span class="number2">980</span>
        </div>
        <div class="d-flex flex-column">
            <span class="rating">Rating</span>
            <span class="number3">8.9</span>  
        </div> 
       </div>
       <div class="button mt-2 d-flex flex-row align-items-center">
        <button class="btn btn-sm btn-outline-primary w-100">Chat</button>
        <button class="btn btn-sm btn-primary w-100 ml-2">Follow</button>     
       </div>
    </div>   
    </div>
</div>
</div>
</form>
<div class="main-block">
        <div class="left-part">

            <form action="<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="title">
                    <i class="fas fa-pencil-alt"></i>
                    <h2>Search here</h2>
                </div>
                <div class="info">
                    <select name="sesso" id="" required>
                        <option disabled selected value>Sesso</option>
                        <option value="maschio">Maschio</option>
                        <option value="femmina">Femmina</option>
                    </select>
                    <select name="materia" onchange="document.getElementById('selected_id').value=this.options[this.selectedIndex].text">
                    <option disabled selected value>Materia</option>
                <option value=""></option>
                <?php  /* 
                    require_once '../Login/config.php';
                    $sql = "SELECT materia FROM materie";
                    $result = mysqli_query($link,$sql);

                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
                    echo "<option value='".$row['materia']."'>".$row['materia']."</option>";
                    }   
                        */
                ?>
            </select>
                
                <button type="submit" href="/">Registrati</button>
                <button type="reset" href="register.php">Annulla</button>
            </form>
        </div>
    <br><br><br>

<br>
    <form action="index.php">
        <button type="submit">Indietro</button>
    </form>-->
</body>
</html>