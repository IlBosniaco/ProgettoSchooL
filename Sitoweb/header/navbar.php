<ul class="menu-bar">
        <li>
          <a href="../Homepage/index.php"><img src="../logo/logo_white_large.png" class="logo"></a> 
        </li>    
        <li>
          <a href="../Lezioni/index.php">Le mie Lezioni</a> 
        </li>
        <li>
         <a href="../DiventaTutor/index.php">Diventa Tutor</a> 
        </li>
        <li>
          <a href="../Ricerca/ricerca.php">Cerca tutor</a> 
        </li>      
        <li>
          <a href="../logout.php">Logout</a>
        </li>

        <li>
        <a href="../profile/profile.php"><img src='<?= $_SESSION['img'] ?>' class="profile"> <?php echo $_SESSION['uname'] ?></a>   
        </li>
</ul>