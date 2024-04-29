<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>header</title>
    <LINK rel="stylesheet" type="text/css" href="styles/basicheader.css">
</head>
<body>
    <header>
        <nav>
            <h3><a href="index.php"><img src="img/logo_site.png" width=" 120px" /></a></h3>

            <h3><a href="categories.php">Categories</a></h3>
            <h3><a href="connexion.php">Your account</a></h3>
            <h3><a href="panier.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
  <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></a></h3>
            <div class="wrap">
                <div class="search">
                    <form id="searchbar" action="search.php" method="GET">
                        <input type="text" class="searchmov" placeholder="Title, Director..." name="query">
                        <button type="submit" class="searchButton">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                        </svg>
                        </button>


                    </form>
                </div>
            </div>
        </nav>
        <div id="menu-toggle">
                    <div id="spans">

                        <div id="spans3">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <div class="wrap">
                            <div class="search">
                                <form id="searchbar" action="search.php" method="GET">
                                    <input type="text" class="searchmov" placeholder="Title, Director..." name="query">
                                    <button type="submit" class="searchButton">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                                    </svg>
                                    </button>


                                </form>
                    
                            </div>
                        </div>
                    </div>
                    

                    

                    <ul id="js-menu">
                        <li><h3><a href="index.php"><img src="img/logo_site.png" width=" 120px" /></a></h3></li>

                        <li><h3><a href="categories.php">Categories</a></h3></li>
                        <li><h3><a href="connexion.php">Your account</a></h3></li>
           
                        <li><h3><a href="panier.php"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l1.313 7h8.17l1.313-7zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
                            </svg></a></h3>
                        </li>
                    </ul>


                
                
            </div>
    </header>
    <script src="header.js"></script>
</body>
</html>