<header>
    <li><a href="accueil.php">Accueil</a></li>
    <li><a href="apropos.php">A propos</a></li>
    <li><a href="formulaire.php">Contact</a></li>
    <li><a href="blog.php">Blog</a></li>
    <li>
        <a href="">
            <?php
                if (isset($_SESSION['nom']))
                {    
                    echo $_SESSION['nom']; 
                }
            ?>
        </a>
    </li>
</header>