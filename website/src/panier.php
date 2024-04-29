<?php
// Inclure le fichier init.php pour démarrer la session automatiquement
require_once 'init.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    // Utilisateur connecté, afficher le contenu du panier
    $user = $_SESSION['user'];
    $prenom = $user['fname'];
    $nom = $user['lname'];
    $id_user = $user['id_user'];
    // Code pour afficher le contenu du panier
    $panier_message = "Bienvenue $prenom $nom ! Voici le contenu de votre panier.";
} else {
    // Utilisateur non connecté, afficher un message invitant à se connecter
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
        // Vérifier si le panier existe dans la session
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

