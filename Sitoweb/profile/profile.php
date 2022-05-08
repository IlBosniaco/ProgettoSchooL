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
    <title>HomePage</title>
    <link rel="stylesheet" href="profilestyle.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="stylesheet" href="../Stylesheets/style.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="../Registrati/functions.js"></script>

</head>

<body>
    <!--il mio profilo-->
    <?php
        include_once '../header/navbar.php';
    ?>
    
    <?php
    require_once '../Database/config.php';
    $id=$_SESSION['id'];
    $sql="SELECT * FROM utente WHERE id='$id'";

    if($stmt = mysqli_prepare($link,$sql)){

        if(mysqli_stmt_execute($stmt)){
            
            $result = mysqli_stmt_get_result($stmt);   
            $row = mysqli_fetch_array($result);              
            }
    }else{
        echo "something went wrong";
    }
    mysqli_stmt_close($stmt);
?>
    <?php
    if ($_SERVER["REQUEST_METHOD"]=="POST") {
        if(!empty($_FILES['image']['name'])){//se è settato nuova immagine
            $errors= array();
            $file_name = $_FILES['image']['name'];
            $file_size =$_FILES['image']['size'];
            $file_tmp =$_FILES['image']['tmp_name'];
            $file_type=$_FILES['image']['type'];
            //controllo estensione del file (funziona solo il jpg non so perche)
            $file_ext=substr($file_name, strpos($file_name, ".")+1, strlen($file_name));
            $extensions= array("jpg","png");
            if(in_array($file_ext,$extensions)=== false){
                echo "<div class='alert alert-danger' role='alert'>please choose a JPG or PNG file.</div>";
            }
            else{
                if($file_size > 2097152){
                    $errors[]='File size must be excately 2 MB';
                }
                else{
                    //ELIMINO VECCHIA FOTO
                    if (unlink($row['immagine_profilo'])) {
                        //echo "file was successfully deleted";
                    } else {
                        // there was a problem deleting the file
                        //echo "no eliminato";
                    }
                    $new_path="../Immagini_profilo/"."$row[nome_utente]"."_profile.".$file_ext;//salvo immagine con nome utente
                    if(empty($errors)==true){
                    move_uploaded_file($file_tmp,$new_path);
                    //echo "Immagine caricata correttamente";
                    }else{
                    print_r($errors);
                    }
                    //carica nel database path dell'immagine
                    $sql="UPDATE utente SET immagine_profilo='$new_path' WHERE id=$id";
                    if ($link->query($sql) === TRUE) {
                        echo "<div class='alert alert-success' role='alert'>immagine caricata correttamente.</div>";
                    } else {
                        echo "Error updating record: " . $link->error;
                    }
                }
            }
        }
        else{
            echo "<div class='alert alert-danger' role='alert'>Non hai selezionato nulla</div>";
        }
        header("Refresh:1");
    }
?>
    <div class="container emp-profile">
        <form method="post" name="upImage" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="<?php echo $row['immagine_profilo']?>">
                        <div class="file btn btn-lg btn-primary">
                            Seleziona nuova foto profilo
                            <input type="file" name="image" />
                        </div>
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

                <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="editProfile" value="Edit Profile" />
                </div>
            </div>
        </form>
        <form action="editPassword.php" name="" method="post">
            <!--FORM CREDENZIALI-->
            <div class="row">
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
                                    <p><?php echo $row['nome_utente']?></p>
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

                            <div class="col-md-6">
                                <div class="profile-head">
                                    <br>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab">CREDENZIALI</a>
                                        </li>
                                    </ul>
                                </div>
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
                                <label>nuova password</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="password" id="password" onchange="onChange()">
                                <input type="checkbox" onclick='seePassword("password")'>Show Password
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label>conferma password</label>
                            </div>
                            <div class="col-md-6">
                                <input type="password" name="conf_password" id="conf_password" onchange="onChange()" >
                                <input type="checkbox" onclick='seePassword("conf_password")'>Show Password
                            </div>
                        </div>
                        <div class="row">
                            <!--COMPARE PASSWORD-->
                            <div class="col-md-6">
                            </div>
                            <div class="col-md-6">
                                <p id="demo"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            <center><input type="hidden" class="profile-edit-btn" id="editPwd" value="Edit Password" /></center>
        </form>
    </div>
</body>

</html>