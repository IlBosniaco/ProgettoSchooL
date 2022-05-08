

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <title>HomePage</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../Registrati/functions.js"></script>
    <style>
body {
    height: 100vh;
    margin: 0;
    background-color: rgba(0, 0, 0, 0.4);
    background-image: url("Image/logo_white_large.png");
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    display: flex;
    justify-content: center;
    
  }
  
  .menu-bar {
    border-radius: 25px;
    height: -webkit-fit-content;
    height: -moz-fit-content;
    height: fit-content;
    display: inline-flex;
    background-color: rgba(0, 0, 0, 0.4);
    -webkit-backdrop-filter: blur(10px);
    backdrop-filter: blur(10px);
    align-items: center;
    padding: 0 50px;
    margin: 20px 0 0 0;
  }
  .menu-bar li {
    list-style: none;
    color: white;
    font-family: sans-serif;
    font-weight: bold;
    padding: 12px 16px;
    margin: 0 8px;
    position: relative;
    cursor: pointer;
    white-space: nowrap;
  }
  .menu-bar li::before {
    content: " ";
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: -1;
    transition: 0.2s;
    border-radius: 25px;
  }
  .menu-bar li:hover {
    color: black;
  }
  .menu-bar li:hover::before {
    background: linear-gradient(to bottom, #e8edec, #d2d1d3);
    box-shadow: 0px 3px 20px 0px black;
    transform: scale(1.2);
  }
  .sfondo1{
    margin: 1% 0 0 0;
    justify-content: left;
    display: flex;

  }
    a {
        color: white;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        color: black;
    }

    .logo {
        width: 100%;
        height: 40px;
    }

    .profilino {
        vertical-align: middle;
        width: 3em;
        height: 3em;
        border-radius: 50%;
    }
    .card{
  width: 400px;
  border: none;
  border-radius: 10px;
   
  background-color: #fff;
  margin-top:30%;
  
  margin-left:-700%;
}
.stats{
    background: #f2f5f8 !important;
    color: #000 !important;
}
.articles{
  font-size:10px;
  color: #a1aab9;
}
.number1{
  font-weight:500;
}
.followers{
    font-size:10px;
  color: #a1aab9;

}
.number2{
  font-weight:500;
}
.rating{
    font-size:10px;
  color: #a1aab9;
}
.number3{
  font-weight:500;
}
html, body {
    min-height: 100%;
    }
    body, div, form, input, select, p { 
    padding: 0;
    margin: 0;
    outline: none;
    font-family: Roboto, Arial, sans-serif;
    font-size: 16px;
    color: #eee;
    }
    h1, h2 {
    text-transform: uppercase;
    font-weight: 400;
    }
    h2 {
    margin: 0 0 0 8px;
    }
    .main-block {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
    padding: 25px;
    background: rgba(0, 0, 0, 0.5); 
    }
    .left-part, form {
    padding: 25px;
    }
    .left-part {
    text-align: center;
    }
    .fa-graduation-cap {
    font-size: 72px;
    }
    form {
    background: rgba(0, 0, 0, 0.7); 
    }
    .title {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    }
    .info {
    display: flex;
    flex-direction: column;
    }
    input, select {
    padding: 5px;
    margin-bottom: 30px;
    background: transparent;
    border: none;
    border-bottom: 1px solid #eee;
    }
    input::placeholder {
    color: #eee;
    }
    option:focus {
    border: none;
    }
    option {
    background: black; 
    border: none;
    }
    .checkbox input {
    margin: 0 10px 0 0;
    vertical-align: middle;
    }
    .checkbox a {
    color: #26a9e0;
    }
    .checkbox a:hover {
    color: #85d6de;
    }
    .btn-item, button {
    padding: 10px 5px;
    margin-top: 20px;
    border-radius: 5px; 
    border: none;
    background: #26a9e0; 
    text-decoration: none;
    font-size: 15px;
    font-weight: 400;
    color: #fff;
    }
    .btn-item {
    display: inline-block;
    margin: 20px 5px 0;
    }
    button {
    width: 100%;
    }
    button:hover, .btn-item:hover {
    background: #85d6de;
    }
    @media (min-width: 568px) {
    html, body {
    height: 100%;
    }
    .main-block {
    flex-direction: row;
    height: calc(100% - 50px);
    }
    .left-part, form {
    flex: 1;
    height: auto;
    }
    }
    </style>
    

</head>
<body>
<?php
session_start();

if(!isset($_SESSION['uname'])){
    header('location: ../Login/login.php');
}else{
    require_once '../Login/config.php';
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
               /* echo "<table style='text-align:center;'>";
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
                    echo"</tbody>";
                echo"</table>";*/
            }else{
                echo "nessun risultato trovato";
            }
        }
        $id=$_SESSION['id'];
        $sql="SELECT immagine_profilo FROM utente WHERE id='$id'";
    
        if($stmt = mysqli_prepare($link,$sql)){
    
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
                while ($row = mysqli_fetch_array($result)) {
                  $img_profilo=$row['immagine_profilo'];
                }
    
            } 
        mysqli_stmt_close($stmt);
    }else{
        echo "smoething went wrong";
        exit();
    }
}
}
 ?>
    <!--<ul class="menu-bar">
        <li>
            <a href="index.php"><img src="Image/logo_white_large.png" class="logo"></a>
        </li>
        <li>
            <a href="../profile/profile.php">Il mio profilo </a>
        </li>
        <li>
            Lezioni
        </li>
        <li>
            Diventa tutor
        </li>
        <li>
            <a href="ricerca.php">Cerca tutor</a>
        </li>
        <li>
            <a href="logout.php">Logout</a>
        </li>
        <li>
            Ricerca
            <input type="search" name="cerca" id="cerca" placeholder="search">
        </li>
        <li>
            <a href="../Profile/profile.php"><img src="<?= $img_profilo ?>" class="profilino"></a>
            <?php echo $_SESSION['uname']?>
        </li>

    </ul>
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
</form>-->
<div class="main-block">
        <div class="left-part">

            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
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
                <?php   
                    require_once '../Login/config.php';
                    $sql = "SELECT materia FROM materie";
                    $result = mysqli_query($link,$sql);

                    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){                                                 
                    echo "<option value='".$row['materia']."'>".$row['materia']."</option>";
                    }   
                        
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
    </form>
</body>
</html>