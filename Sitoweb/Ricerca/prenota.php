<?php
if(isset($_POST['btn'])){
    echo "bruh";
    if (isset($_GET["id_ripetizione"])&& !empty(trim($_GET["id_alunno"]))) {
        require_once '../Database/config.php';
    
        $sql="INSERT INTO lezioni(id_ripetizione,id_alunno) VALUES (?,?)";
        
    
        if($stmt = mysqli_prepare($link,$sql)){
            mysqli_stmt_bind_param($stmt, "ii", $param_tutor, $param_alunno);
    
            $param_tutor = trim($_GET["id_ripetizione"]);
            $param_alunno = trim($_GET["id_alunno"]);
            echo $param_tutor." ".$param_alunno;
            if(mysqli_stmt_execute($stmt)){
                header("location: ricerca.php");
                exit();
            }else{
                echo "something went wrong";
            }
            mysqli_stmt_close($stmt);
        }
        
    }else{
        if (empty(trim($_GET["id"]))) {
           header("location: error.php");
           exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?id_ripetizione=".trim($_GET["id_ripetizione"])."&id_alunno=".trim($_GET["id_alunno"]);?>" method="post">
        <input type="hidden" name="id_ripetizione" value="<?php echo trim($_GET["id_ripetizione"]); ?>">
        <p>sei sicuro di voler prenotare questo tutor?</p><br>
        <p><input type="submit" value="Yes" name="btn">
        <a href="ricerca.php">No</a>
        </p>
    </form>
</body>
</html>