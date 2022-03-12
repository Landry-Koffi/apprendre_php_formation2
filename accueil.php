<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Page accueil</title>
</head>
<body>
    <?php require_once 'include/header.php'; ?>
    <h1>Accueil</h1>
    <p><a href="formulaire.php" style="color: #000">Formulaire</a></p>

    
    <?php
        // On se connecte à notre base de données
        try {
            $db = new PDO('mysql:host=localhost;dbname=utilisateur', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        } catch (Exception $e) {
            die('Erreur de connexion à la base de données : '.$e->getMessage());
        }
        // Recupérer toutes données de la bdd
        $recut = $db->prepare('SELECT * FROM personnelle WHERE id=:id');
        // On associe chaque colonne avec une valeur
        $recut->bindValue(':id', 2, PDO::PARAM_INT);
        // On excecute la requête
        $recut->execute();
        // On insert ligne par ligne dans la variable $row
        $row = $recut->fetch();
        // foreach ($rows as $row) {
        //     echo $row['id'].', '.$row['nom'].', '.$row['prenom'].'<hr>';
        // }

        $req = $db->prepare('SELECT * FROM personnelle');
        $req->execute();
        $rows = $req->fetchAll();

        if (isset($_POST['submit'])){
            $nom = htmlspecialchars(strip_tags(trim($_POST['nom'])));
            $prenom = htmlspecialchars(strip_tags(trim($_POST['prenom'])));
            $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $age = htmlspecialchars(strip_tags(trim($_POST['age'])));
            try {
                $insert = $db->prepare('INSERT INTO personnelle(nom, prenom, email, age) VALUES(:nom, :prenom, :email, :age)');
                $insert->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':age' => $age));
            } catch (Exception $th) {
                die("Erreur lors de l'insertion : ".$th->getMessage());
            }
            echo 'Enregistré avec succès';
        }
        

        if (isset($_POST['modifier'])){
            $nom = htmlspecialchars(strip_tags(trim($_POST['nom'])));
            $prenom = htmlspecialchars(strip_tags(trim($_POST['prenom'])));
            $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
            $age = htmlspecialchars(strip_tags(trim($_POST['age'])));
            try {
                $modif = $db->prepare('UPDATE personnelle SET nom=:nom, prenom=:prenom, email=:email, age=:age WHERE id=:id');
                $modif->execute(array(':nom' => $nom, ':prenom' => $prenom, ':email' => $email, ':age' => $age, ':id' => 1));
            } catch (Exception $th) {
                die("Erreur lors de la modification : ".$th->getMessage());
            }
            echo 'Modification effectuée avec succès';
        }

        // Suppression
        if (isset($_GET['id'])) {
            $id = htmlentities($_GET['id']);
            $delete = $db->prepare('DELETE FROM personnelle WHERE id=:id');
            $delete->bindValue(':id', $id, PDO::PARAM_INT);
            $delete->execute();
            header('Location: accueil.php');
        }

    ?>

    <form action="" method="post">
        <input type="text" name="nom" value="<?= $row['nom']; ?>" placeholder="Entrez votre nom">
        <input type="text" value="<?= $row['prenom']; ?>" name="prenom" placeholder="Entrez votre prenom">
        <input type="email" value="<?= $row['email']; ?>" name="email" placeholder="Entrez votre email">
        <input type="text" value="<?= $row['age']; ?>" name="age" placeholder="Entrez votre age">
        <input type="submit" value="Enregistrer" name="modifier">
    </form>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nom</th>
                <th>Prénoms</th>
                <th>E-mail</th>
                <th>Age</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $value){?>
                <tr>
                    <td><?= $value['id']; ?></td>
                    <td><?= $value['nom']; ?></td>
                    <td><?= $value['prenom']; ?></td>
                    <td><?= $value['email']; ?></td>
                    <td><?= $value['age']; ?></td>
                    <td><a href="accueil.php?id=<?= $value['id']; ?>" style="color: red">Supprimer</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>




</body>
</html>