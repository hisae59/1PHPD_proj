<?php
// Inclure le fichier init.php pour démarrer la session automatiquement
require_once 'init.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id=$user['id_user'];
    $fname = $user['fname']; 
    $lname = $user['lname']; 
    $email = $user['email'];
    $cart = $user['cart'];
    $welcome_message = "Bienvenue {$fname} ! Vous êtes connecté(e).";
    $hide_form = true;
}else{
    $hide_form = false;
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="styles/connexion.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <title>Connexion</title>
</head>

<body>
    <h1>Compte</h1>
    <?php if (!$hide_form) : ?>
        <h2>Connexion</h2>
        <div id="formulaire">
            <form action="connexion_api.php" method="post">
                <div id="mail_content">
                    <label id="mail_plh">Mail</label><br>
                    <input type="text" id ="mail" name="mail" placeholder='Mail'required><br>
                </div>
                <div id="mdp_content">
                    <label id="mdp_plh">Mot de passe</label><br>
                    <input type="text" id="mdp" name="mdp" placeholder='Mot de passe' required><br>
                </div>

                <input id="button_content" type="submit" value="Envoyer">
                <a href="inscription.php"><p>Vous n'avez pas de compte ? Inscrivez-vous !</p></a>
            </form>
        </div>
    <?php endif; ?>
    <?php if (isset($error_message)) : ?>
        <p><?= htmlspecialchars($error_message) ?></p>
    <?php endif; ?>
    <?php if (isset($welcome_message)) : ?>
        <div id="compte">
            <p id="welcome"><?php echo $welcome_message; ?></p> 
            <h2>Information du compte</h2>
            <div id="names">
                <h3>Prénom : <?php echo $fname; ?></h3>
                <h3>Nom: <?php echo $lname; ?></h3>
            </div>
            <div id="email"><h3>Mail du compte: <?php echo $email; ?></h3></div>
            <a href="panier.php"><p>Voir votre panier de films</p></a>
            <div id="button_deco"><a href="deconnexion_api.php"><button>Deconnexion</button></a></div>   
        </div>
        
    <?php endif; ?>
</body>
</html>