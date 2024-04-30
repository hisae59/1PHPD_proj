<?php

require_once 'init.php';


if (isset($_SESSION['user'])) {
    
    $user = $_SESSION['user'];
    $prenom = $user['fname'];
    $nom = $user['lname'];
    $id_user = $user['id_user'];
    
    $panier_message = "Bienvenue $prenom $nom ! Voici le contenu de votre panier.";
} else {
    
    $panier_message = "Vous devez vous connecter pour accéder à votre panier !";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="styles/panier.css">
    <title>Panier</title>
</head>

<body>
    <?php require "basicheader.php";?>
    
    <h1>Panier</h1>
    <h3><?php echo $panier_message; ?></h3>
    <div id="cart_movie">
        <?php
        
        if (isset($_SESSION['user'])){
            if (isset($_SESSION['user']['cart'])) {
                require_once 'panier_api.php';
                
            }else{
                echo "Votre panier est vide.";
                
            }
        }
        
        ?>

    </div>
    
    
</body>
</html>

