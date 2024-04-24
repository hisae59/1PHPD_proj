

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Homepage</title>
    <LINK rel="stylesheet" type="text/css" href="style/index.css">
</head>

<body>
    <?php require "header.php";?>
   
    <h1 id="latestmov"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-camera-reels" viewBox="0 0 16 16">
  <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0M1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0"/>
  <path d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2zm6 8.73V7.27l-3.5 1.555v4.35zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1"/>
  <path d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6M7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
</svg> <span>Our latest movies:</span></h1>
    <div class="listmov">
        <div class="movie">
            <h4>Dune, partie 2</h4>
            <?php 
            require "database.php";
            $conn = Database::getInstance();
            $sql = "SELECT image FROM movie WHERE id = 3"; 
            $stmt = $conn->query($sql);
            $row = $stmt->fetch();

            if ($stmt->rowCount() > 0) {
                // Affichage de l'image
                $imageData = $row['image'];// Assurez-vous d'adapter le type MIME selon le type d'image que vous avez stocké
                echo "<img src='./img/" . $imageData . ".jpg'  width='300px'>";
            } else {
                echo "Aucune image trouvée.";
            } ?>
            <div id="learnmore">
                    <button type="button">
                    <a href="movie.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                    <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                    </svg>  <span> Learn more</span></a>
                    </button>
            </div>
        </div>
        <div class="movie">
            <h4>Kung Fu Panda 4</h4>
            <?php 
            $sql = "SELECT image FROM movie WHERE id = 2"; 
            $stmt = $conn->query($sql);
            $row = $stmt->fetch();

            if ($stmt->rowCount() > 0) {
                // Affichage de l'image
                $imageData = $row['image'];// Assurez-vous d'adapter le type MIME selon le type d'image que vous avez stocké
                echo "<img src='./img/" . $imageData . ".jpg'  width='300px'>";
            } else {
                echo "Aucune image trouvée.";
            } ?>
            <div id="learnmore">
                    <button type="button">
                    <a href="movie.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                    <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                    </svg>  <span> Learn more</span></a>
                    </button>
            </div>
        </div>
        <div class="movie">
            <h4>Pas de vagues</h4>
            <?php 
            $sql = "SELECT image FROM movie WHERE id = 4"; 
            $stmt = $conn->query($sql);
            $row = $stmt->fetch();

            if ($stmt->rowCount() > 0) {
                // Affichage de l'image
                $imageData = $row['image'];// Assurez-vous d'adapter le type MIME selon le type d'image que vous avez stocké
                echo "<img src='./img/" . $imageData . ".jpg'  width='300px'>";
            } else {
                echo "Aucune image trouvée.";
            } ?>
            <div id="learnmore">
                    <button type="button">
                    <a href="movie.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                    <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                    </svg>  <span> Learn more</span></a>
                    </button>
            </div>
            <div class="movie">
            <h4>Godzilla X Kong, The New Empire</h4>
            <?php 
            $sql = "SELECT image FROM movie WHERE id = 1"; 
            $stmt = $conn->query($sql);
            $row = $stmt->fetch();

            if ($stmt->rowCount() > 0) {
                // Affichage de l'image
                $imageData = $row['image'];// Assurez-vous d'adapter le type MIME selon le type d'image que vous avez stocké
                echo "<img src='./img/" . $imageData . ".jpg'  width='300px'>";
            } else {
                echo "Aucune image trouvée.";
            } ?>
            <div id="learnmore">
                    <button type="button">
                    <a href="movie.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-film" viewBox="0 0 16 16">
                    <path d="M0 1a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm4 0v6h8V1zm8 8H4v6h8zM1 1v2h2V1zm2 3H1v2h2zM1 7v2h2V7zm2 3H1v2h2zm-2 3v2h2v-2zM15 1h-2v2h2zm-2 3v2h2V4zm2 3h-2v2h2zm-2 3v2h2v-2zm2 3h-2v2h2z"/>
                    </svg>  <span> Learn more</span></a>
                    </button>
            </div>
        </div>
        </div>
    </div>
    <?php require "footer.php";?>
</body>
</html>
