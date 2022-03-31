<?php
//session_start();

//if(!isset($_SESSION['uname'])){
  //  header('location: ../Login/index.php');
//}
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
  a {
    color: white;
    text-decoration: none; 
    font-weight: bold;
  }
  a:hover {
    color: black;
  }
  img{
    width:100%;
    height:40px;
  }
    </style>
    
    <title>HomePage</title>
</head>
<body>
    <ul class="menu-bar">
        <li>
          <a href="contactus.php"><img src="Image/logo_white_large.png"></a> 
        </li>    
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
        <li>
          <a href="logout.php">Logout</a>
        </li>
        <li>
        Ricerca
          <input type="search" name="cerca" id="cerca" placeholder="search">
        </li>
        
      </ul>
     
      <br>
      
</body>
</html>