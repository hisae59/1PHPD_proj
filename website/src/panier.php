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
    <title>Panier</title>
</head>

<body>
    <h1>Panier</h1>
    <?php echo $panier_message; ?>
    <?php
    // Vérifier si le panier existe dans la session
    require_once 'panier_api.php';
    if (isset($_SESSION['user']['cart'])) {
        // Parcourir les films du panier
        foreach ($_SESSION['user']['cart'] as $movie) {
            
            ?>
            
            <div class="movie">
                <h2><?php echo $movie['title']; ?></h2>
                <img src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
                <p>Prix : <?php echo $movie['price']; ?> €</p>
                <!-- Ajoutez d'autres informations sur le film ici -->
            </div>
            <?php
        }
    }else{
        echo "Votre panier est vide.";
    }
    ?>
</body>

</html>