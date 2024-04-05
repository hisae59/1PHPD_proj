<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8"/>
    <title>Homepage</title>
</head>

<body>
    <header>
        <?php require "header.php";?>
    </header>
    <h1>Hello World !</h1>
    <h1>Env user: <?php echo $_ENV['MYSQL_USER'] ?></h1>
</body>
</html>
