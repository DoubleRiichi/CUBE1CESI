<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ma page PHP avec HTML et CSS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #33CEFF;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        section {
            padding: 20px;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>

    <?php
    $variablePHP = "MétéoCube";
    ?>

    <header>
        <h1>🔆 MétéoCube 🔆</h1>
    </header>

    <section>
        <p>Bienvenue sur votre station météo préférée</p>

        <?php
        echo "<p>$variablePHP</p>";
        ?>
    </section>

    <footer>
        <p>© 2023 Ma Page PHP</p>
    </footer>

</body>
</html>


<?php
echo"Hello World !"


?>

<?php
echo"Droit d'auteur Mael"
?>
