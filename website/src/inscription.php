<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="styles/inscription.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
    <title>Inscription</title>
</head>

<body>
    <?php require_once 'basicheader.php' ?>
   <h1>Inscription</h1>


   <div id="formulaire">
    <form id="inscriptionForm" action="inscription_api.php" method="post">
        <div id="name_content">
            <label id="name_plh">Nom</label><br>
            <input type="text" id="name" name="name" placeholder='Nom' required><br>
        </div>
        <div id="firstname_content">
            <label id="firstname_plh">Prenom</label><br>
            <input type="text" id="firstname" name="firstname" placeholder='Prénom' required><br>
        </div>  
        <div id="mail_content">
            <label id="mail_plh">Mail</label><br>
            <input type="text" id ="mail" name="mail" placeholder='Mail'required><br>
        </div>
        <div id="mdp_content">
            <label id="mdp_plh">Mot de passe</label><br>
            <input type="text" id="mdp" name="mdp" placeholder='Mot de passe' required><br>
        </div>

        <input id="button_content" type="submit" value="Envoyer">
        
    </form> 

   </div>

</body>
<script>
        document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Empêcher l'envoi par défaut du formulaire

            // Créer un objet FormData à partir du formulaire
            var formData = new FormData(this);

            // Effectuer une requête AJAX vers inscription_api.php
            fetch('inscription_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Vérifier la réponse de l'API
                if (data.message) {
                    // Afficher le message de confirmation
                    alert(data.message);
                    // Rediriger vers la page de connexion
                    window.location.href = 'connexion.php';
                } else {
                    // Afficher un message d'erreur si la réponse de l'API est invalide
                    alert('Une erreur est survenue lors de l\'inscription.');
                }
            })
            .catch(error => {
                // Afficher un message d'erreur en cas d'échec de la requête
                console.error('Erreur de réseau :', error);
            });
        });
    </script>