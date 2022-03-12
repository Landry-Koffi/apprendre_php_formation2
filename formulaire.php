<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>FQORMULAIRE</title>
</head>
<body>
    <?php include 'include/header.php'; ?>
    <h1>Contact</h1>


    <form action="traitement.php" method="post">
        <p>
            <input type="text" name="email" placeholder="Entrez votre email">
        </p>
        <p>
            <input type="password" name="password" placeholder="Entrez votre password">
        </p>    
        <p>
            <input type="submit" name="submit" value="Envoyer">
        </p>
    </form>

    <?php require_once 'include/footer.php'; ?>

</body>
</html>