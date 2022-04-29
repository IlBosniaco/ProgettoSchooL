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
    <link rel="stylesheet" href="style.css">
    <title>HomePage</title>
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
.profilino {
vertical-align: middle;
width: 3em;
height: 3em;
border-radius: 50%; 
}

    </style>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
          <a href="../Homepage/logout.php">Logout</a>
        </li>
        <li>
        Ricerca
          <input type="search" name="cerca" id="cerca" placeholder="search">
        </li>
        <li>
        <a href="../Profile/profile.php"><img src="../Immagini_profilo/rossi_mario.jpg" class="profilino"></a>  <?php echo $_SESSION['uname'] ?>
        </li>
        
</ul>
  


      <!--il mio profilo-->
<?php
    
    require_once '../Database/config.php';
    $id=$_SESSION['id'];
    $sql="SELECT * FROM utente WHERE id='$id'";

    if($stmt = mysqli_prepare($link,$sql)){

        if(mysqli_stmt_execute($stmt)){
            
            $result = mysqli_stmt_get_result($stmt);   
            $row = mysqli_fetch_array($result);
              /*echo"<tr>";
                  echo "<td>".$row['id']."</td>";
                  echo "<td>".$row['nome_utente']."</td>";
                  echo "<td>".$row['email']."</td>";
                  echo "<td>".$row['password']."</td>";
                  echo "<td>".$row['immagine_profilo']."</td>";
                  echo "<td>".$row['anno']."</td>";
                  echo "<td>".$row['sezione']."</td>";
                  echo "<td>".$row['indirizzo']."</td>";
                  echo "<td>".$row['numTelefono']."</td>";
                  echo "<td>".$row['sesso']."</td>";                  
              echo"</tr>";*/
              
            }
    }else{
        echo "something went wrong";
    }
    
    mysqli_stmt_close($stmt);
?>  
<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src=<?php echo $row['immagine_profilo']?> alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Change Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                        <br>            
                        <h5>
                        <?php echo $row['nome_utente']?>
                                    </h5>
                                    <br><br><br>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Edit Profile"/>
                    </div>
                </div>
                
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Username</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $row['nome_utente']?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Kshiti Ghelani</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $row['email']?></p>
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
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Experience</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Hourly Rate</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>10$/hr</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Total Projects</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>230</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>English Level</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>Expert</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Availability</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>6 months</p>
                                            </div>
                                        </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label>Your Bio</label><br/>
                                        <p>Your detail description</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>           
        </div>
    </body>
</html>