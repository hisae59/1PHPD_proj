<?php
require_once 'init.php';

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $id=$user['id_user'];
    $fname = $user['fname']; 
    $lname = $user['lname']; 
    $email = $user['email'];
    $cart = $user['cart'];
    $welcome_message = "Welcome {$fname} ! You are connected.";
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
    <?php require "basicheader.php";?>
    <h1>Account</h1>
    <?php require_once 'connexion_api.php' ?>
    <?php if (isset($error_message)) : ?>
        <p id="Erreur"><?php echo $error_message ?></p>
    <?php endif; ?>
    <?php if (!$hide_form) : ?>
        <h2>Connexion</h2>
        <div id="formulaire">
            <form action="connexion_api.php" method="post">
                <div id="mail_content">
                    <label id="mail_plh">E-mail</label><br>
                    <input type="text" id ="mail" name="mail" placeholder='Mail'required><br>
                </div>
                <div id="mdp_content">
                    <label id="mdp_plh">Password</label><br>
                    <input type="text" id="mdp" name="mdp" placeholder='Password' required><br>
                </div>

                <input id="button_content" type="submit" value="Send">
                <a href="inscription.php"><p>You do not have an account ? Sign up!</p></a>
            </form>
        </div>
    <?php endif; ?>
    
    
    <?php if (isset($welcome_message)) : ?>
        <div id="compte">
            <p id="welcome"><?php echo $welcome_message; ?></p> 
            <h2>Account Information</h2>
            <div id="names">
                <h3>Firstname : <?php echo $fname; ?></h3>
                <h3>Lastname: <?php echo $lname; ?></h3>
            </div>
            <div id="email"><h3>Account E-mail: <?php echo $email; ?></h3></div>
            <a href="panier.php"><p>See your movies cart</p></a>
            <div id="button_deco"><a href="deconnexion_api.php"><button>Log out</button></a></div>   
        </div>
        
    <?php endif; ?>
    <?php require_once 'footer.php'?>
</body>
</html>