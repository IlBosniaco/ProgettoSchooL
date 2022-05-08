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
          <a href="../Ricerca/ricerca.php">Cerca tutor</a> 
        </li>      
        <li>
          <a href="../logout.php">Logout</a>
        </li>

        <li>
        <a href="../Profile/profile.php"><img src='<?= $img_profilo ?>' class="profile"></a>   <?php echo $_SESSION['uname'] ?>
        </li>
      </ul>