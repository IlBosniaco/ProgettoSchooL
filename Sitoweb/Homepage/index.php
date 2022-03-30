<?php
session_start();

if(!isset($_SESSION['uname'])){
    header('location: ../Login/index.php');
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    
    <title>HomePage</title>
</head>
<body>
   <img class="sfondo1" src="Image/logo_large.png" width="12%" height="5%" >
    <ul class="menu-bar">
        <li>
          Home
        </li>
        <li>
          Nigga
        </li>
        <li>
          Shop
        </li>
        <li>
          Amogus
        </li>
        <li>
          Pisnelo
        </li>
        <li>
          Bosnia
        </li>
      </ul>
     
      <br>
      <a href="logout.php">logout</a>
</body>
</html>