<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="style.css" />
        <title>Trivia Space - Project Prog-Web2 Yann Toussaint 2023</title>
        <meta http-equiv="Content-Language" content="fr, en">
        <link rel="icon" type="image/png" href="favicon.png">
    </head>
    <?php
        //connexion
        $servername = "localhost"; // le nom de votre serveur MySQL
        $username = "root"; // votre nom d'utilisateur MySQL
        $password = "";
        $dbname = "trivia_space"; // le nom de votre base de données

        // Créer la base de donnée si elle n'existe pas déjà
        try {
            $pdo = new PDO("mysql:host=$servername", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            $sql = "CREATE DATABASE IF NOT EXISTS $dbname";
            $pdo->exec($sql);

        }
        catch(PDOException $e)  {
            die("Creation failed: " . $e->getMessage());
        }

        //connexion à la base de donnée
        try {
            $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            // set the PDO error mode to exception
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        }
        catch(PDOException $e)  {
            die("Connection failed: " . $e->getMessage());
        }

        $string_language = "English";
        if(isset($_POST['language_selected'])) {
            $string_language = $_POST['language_selected'];
        }

        $sql = "CREATE TABLE IF NOT EXISTS translations (
                    id INTEGER PRIMARY KEY AUTO_INCREMENT,
                    lang VARCHAR(100),
                    Title VARCHAR(100),
                    Hello VARCHAR(100)
                )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();

        $sql = "SELECT COUNT(*) FROM translations";
        $result = $pdo->query($sql);
        $count = $result->fetchColumn();

        if ($count == 0) {
            $sql = "INSERT INTO $dbname.translations
                     VALUES (1, 'English', 'Trivia Space', 'Hello everyone'),
                     (2, 'Francais', 'Trivia Espace', 'Bonjour tout le monde')";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
        }


        $sql = "SELECT lang FROM translations";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $id_language = 0;
        while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) != NULL) {
            if ($row['lang'] == $string_language) {
                break;
            }
            $id_language++;
        }

        function printSelector($selector, $pdo, $id_language) {
            $rows = [];
            $sql = "SELECT $selector FROM translations";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) != NULL) {
                $rows[] = $row;
            }
            echo $rows[$id_language][$selector];
        }
    ?>

    <body>
        <h1><?php printSelector('Title', $pdo, $id_language)?></h1>

        <?php printSelector('Hello', $pdo, $id_language); ?>

        <form method="post" action="index.php">
            <label for="language_selected">language :</label>
            <select id="language_selected" name="language_selected">
                <option value="English">English</option>
                <option value="Francais">Français</option>
            </select>
            <button type="submit">Envoyer</button>
        </form>

        <button id="load-more">Voir plus de questions</button>
        <div id="questions-container"></div>

        <div class="stars"></div>
        <script src="script.js"></script>
    </body>

    <?php /*fermeture de la connexion*/ $pdo = null; ?>
</html>
