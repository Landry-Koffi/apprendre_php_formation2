<?php session_start();
$password_verify = "1234567";
if(isset($_POST['submit']))
{

   

    // htmlspecialchars(), htmlentities(), strip_tags(), trim()
   $email = htmlspecialchars(strip_tags(trim($_POST['email'])));
   $password = htmlspecialchars(strip_tags(trim($_POST['password'])));
   if($email and $password)
   {
        if(!is_numeric($email))
        {
            if($password == $password_verify)
            {
                $_SESSION['email'] = $email;
                // header('Location: membre.php');
                echo "<script>window.location.replace('membre.php')</script>";
            }else{
                echo "Mot de passe inccorecte";
            }
        }else{
            echo "Veuillez entrez des caractères valides";
        }
   }else{
        echo "Veuillez renseigner tous champs";
   }


}

    
// }else{
//     echo "Veuillez cliquer sur le bouton d'envoi";
// }
