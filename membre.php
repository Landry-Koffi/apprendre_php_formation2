<?php session_start();

if(!isset($_SESSION['email'])){
    header("Location: accueil.php");
}

echo $_SESSION['email'].'<br>';

echo "<a href='deconnexion.php'>Déconnexion</a>";