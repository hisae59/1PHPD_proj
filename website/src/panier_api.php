<?php

if ($_SERVER['REQUEST_METHOD'] == 'GET') { 
    
    $id_user = $_SESSION['user']['id_user'] ?? null; 
  
    if ($id_user) {
        
        $curl = curl_init("http://php-api/cart?id_user=$id_user"); 
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);

        if ($response) {
            $movies = json_decode($response, true);
            $total_price = 0;
            
            if ($movies !== null) {
            
                foreach ($movies as $movie) {
                    ?>
                    <div class="movie">
                    <img src="<?php echo './img/'.$movie['image'].'.jpg'; ?>" alt="<?php echo $movie['title']; ?>">
                        <h2><?php echo $movie['title']; ?></h2>
                        <p>Prix : <?php echo $movie['price']; ?> €</p>
                        <form action="panier_api.php" method="POST">
                            <input type="hidden" name="id_cart" value="<?php echo $movie['id']; ?>">
                            <button type="submit" name="delete_movie">🗑️Supprimer</button>
                        </form>
                    </div>
                    <?php
                    $total_price += $movie['price'];
            }
            ?>
            <div class="total">
                <h3>Total du panier : <?php echo $total_price; ?> €</h3>
            </div>
            <?php
            
            } else {
                echo "Erreur lors de la conversion de la réponse JSON.";
            }
        } else {
            echo json_encode(["message" => "Erreur lors de la récupération du panier."]);
        }
    } else {
        echo json_encode(["message" => "ID utilisateur non disponible."]);
    }

} else if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addmovie'])) { 
    $id_user = $_SESSION['user']['id_user'] ?? null; 
    $id_movie = $_POST['id_movie'] ?? null;
    
    
    if ($id_user && $id_movie) {
        $postData = json_encode(array('id_user' => $id_user, 'id_movie' => $id_movie));

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "http://php-api/cart?id_user=$id_user&id_movie=$id_movie");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        $response = curl_exec($curl);
        curl_close($curl);
        echo '<script>window.location.href = "panier.php";</script>';
        exit;
        
    } else {
        echo "Missing user ID or movie ID";
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_movie'])) {
    
    $id_cart = $_POST['id_cart'] ?? '';
    
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, "http://php-api/cart?id_cart=$id_cart");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    curl_close($curl);
    echo '<script>window.location.href = "panier.php";</script>';
    exit;
    
    
}

else {
    http_response_code(405);
    echo json_encode(["message" => "Méthode non autorisée."]);
}

