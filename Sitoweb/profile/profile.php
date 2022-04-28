<?php
  session_start();

if(!isset($_SESSION['uname'])){
  header('location: ../Login/');
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <style>
      body {
    height: 100vh;
    margin: 0;
    background-color: rgba(0, 0, 0, 0.4);
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-position: center;
    display: flex;
    flex-flow:column;
    justify-content: flex-start;
    
    
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
  a {
    color: white;
    text-decoration: none; 
    font-weight: bold;
  }
  a:hover {
    color: black;
  }
  .logo{
    width:100%;
    height:40px;
  }
  .profile {
  vertical-align: middle;
  width: 3em;
  height: 3em;
  border-radius: 50%; 

}
    </style>
    
    <title>HomePage</title>
</head>
<body>   
<ul class="menu-bar">
        <li>
          <a href="../Homepage/index.php"><img src="../Homepage/Image/logo_white_large.png" class="logo"></a> 
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
          Cerca tutor
        </li>      
        <li>
          <a href="logout.php">Logout</a>
        </li>
        <li>
        Ricerca
          <input type="search" name="cerca" id="cerca" placeholder="search">
        </li>
        <li>
        <a href="../Profile/profile.php"><img src="../Immagini_profilo/rossi_mario.jpg" class="profile"></a>  <?php echo $_SESSION['uname'] ?>
        </li>
</ul>
      <!--il mio profilo-->
<?php
    require_once '../Login/config.php';
    $id=$_SESSION['id'];
    $sql="SELECT * FROM utente WHERE id='$id'";

    if($stmt = mysqli_prepare($link,$sql)){

        if(mysqli_stmt_execute($stmt)){
            /*$result = mysqli_stmt_get_result($stmt);
            while ($row = mysqli_fetch_array($result)) {
              $img_profilo=$row['immagine_profilo'];
            }*/
            $result = mysqli_stmt_get_result($stmt);
            $idUtente=$row['id'];
            $nomeUtente=$row['nome_utente'];
            $emailUtente=$row['email'];
            $passwordUtente=$row['password'];
            $imgprofiloUtente=$row['immagine_profilo'];
            $annoUtente=$row['anno'];
            $sezioneUtente=$row['sezione'];
            $indirizzoUtente=$row['indirizzo'];
            $numtelefonoUtente=$row['numTelefono'];
            $sessoUtente=$row['sesso'];
        }
    }else{
        echo "something went wrong";
    }
    mysqli_stmt_close($stmt);
?>  

    </body>
</html>