<?php

require_once 'init.php';


if (isset($_SESSION['user'])) {
    
    $user = $_SESSION['user'];
    $prenom = $user['fname'];
    $nom = $user['lname'];
    $id_user = $user['id_user'];
    
    $panier_message = "Welcome $prenom $nom ! Here is your cart's content.";
} else {
    
    $panier_message = "You need to be connected to access to your cart !";
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="style/panier.css">
    <title>Panier</title>
</head>

<body>
    <?php require "basicheader.php";?>
    
    <h1>Cart</h1>
    <h3><?php echo $panier_message; ?></h3>
    <div id="cart_movie">
        <?php
        
        if (isset($_SESSION['user'])){
            if (isset($_SESSION['user']['cart'])) {
                require_once 'panier_api.php';
                
            }else{
                echo "Your cart is empty";
                
            }
        }
        
        ?>

    </div>
    
    
</body>
</html>
