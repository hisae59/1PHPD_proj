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
   <h1>Registration</h1>


   <div id="formulaire">
    <form id="inscriptionForm" action="inscription_api.php" method="post">
        <div id="name_content">
            <label id="name_plh">Nom</label><br>
            <input type="text" id="name" name="name" placeholder='Lastname' required><br>
        </div>
        <div id="firstname_content">
            <label id="firstname_plh">Prenom</label><br>
            <input type="text" id="firstname" name="firstname" placeholder='Firstname' required><br>
        </div>  
        <div id="mail_content">
            <label id="mail_plh">Mail</label><br>
            <input type="text" id ="mail" name="mail" placeholder='Mail'required><br>
        </div>
        <div id="mdp_content">
            <label id="mdp_plh">Mot de passe</label><br>
            <input type="text" id="mdp" name="mdp" placeholder='Password' required><br>
        </div>

        <input id="button_content" type="submit" value="Send">
        
    </form> 
    

   </div>
   <?php require_once 'footer.php' ?>
</body>
<script>
        document.getElementById('inscriptionForm').addEventListener('submit', function(event) {
            event.preventDefault(); 

            
            var formData = new FormData(this);

            
            fetch('inscription_api.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                
                if (data.message) {
                    
                    alert(data.message);
                    
                    window.location.href = 'connexion.php';
                } else {
                    
                    alert('An error occurred during registration.');
                }
            })
            .catch(error => {
                
                console.error('Network Error :', error);
            });
        });
    </script>