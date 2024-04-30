<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <LINK rel="stylesheet" type="text/css" href="styles/categories.css">
</head>
<body>
<?php require "basicheader.php"; ?>

<div id="categ">
    <h1><a href="action.php">Action</a></h1>
    <h1><a href="drama.php">Drama</a></h1>
</div>
<h2 id="categorie">Drama movies:</h2>
<div id="results">
    <?php require_once 'drama_api.php';?> 
</div>
</body>
</html>