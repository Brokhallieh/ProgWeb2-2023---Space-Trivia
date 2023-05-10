<!DOCTYPE html>
<html lang="en, fr">
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="CSS/style.css" />
        <title>Trivia Space - Project Prog-Web2 Yann Toussaint 2023</title>
        <meta http-equiv="Content-Language" content="fr, en">
        <link rel="icon" type="image/png" href="assets/favicon.png">
    </head>
    <?php
        ini_set('display_errors', 1);
        ini_set('display_startup_errors', 1);
        error_reporting(E_ALL);

        include "PHP/ExecuteSQL.php";

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

        include "PHP/table_names.php";

        $string_language = "English";
        if(isset($_POST['language_selected'])) {
            $string_language = $_POST['language_selected'];
        }

        executeAllSQL($pdo);


        RebuildDBIfNecessary($pdo, $translationsTable, $questionsTable);


        $unfetchedResult = getUnfetchedSQL($pdo, "SELECT lang FROM $translationsTable");

        $id_language = 0;
        while (($row = $unfetchedResult->fetch(PDO::FETCH_ASSOC)) != NULL) {
            if ($row['lang'] == $string_language) {
                break;
            }
            $id_language++;
        }

        function printSelector($selector, $table, $pdo, $id_language) {
            $rows = [];
            $sql = "SELECT $selector FROM $table";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while (($row = $stmt->fetch(PDO::FETCH_ASSOC)) != NULL) {
                $rows[] = $row;
            }
            echo $rows[$id_language][$selector];
        }
    ?>

    <body>
        <input type="hidden" id="string_language" name="string_language" value=<?php echo $string_language ?>>
        <header>
            <h1> <?php printSelector('Title', $translationsTable, $pdo, $id_language)?> </h1>
        </header>

        <form method="post" action="index.php">
            <select id="language_selected" name="language_selected" alt="Select your language">
                <option value="English">English</option>
                <option value="Francais">Français</option>
            </select>
            <button type="submit" alt="Submit button to change language">
                <img src="assets/symbol_traduction.jpg" height="22" width="22" alt="Logo of translation">
            </button>
        </form>
        <br>

        <button id="load_another_question" alt="Button to see another random question">
            <?php printSelector('language_button', $translationsTable, $pdo, $id_language); ?>
        </button>

        <br><br>
        <section id="questions-container"></section>
        <br><br>

        <div method="post" action="index.php" id="link_mail_score" style="display: none">
            <label for="email">
                <?php printSelector('email', $translationsTable, $pdo, $id_language); ?>
            </label>
            <input id="email" type="email" value="email" alt="Your email">
            <p></p>

            <label>
                <?php printSelector('score', $translationsTable, $pdo, $id_language); ?>
                <input type="number" id="score" min="0" max="4" alt="Your score on the questions">
            </label>
            <p></p>

            <button type="submit" id="submit_score" alt="Submit button to link an email and a score">
                <?php printSelector('link_email_score_button', $translationsTable, $pdo, $id_language); ?>
            </button>
        </div>


        <aside id="stars_container"></aside>
        <script src="JavaScript/script.js"></script>
    </body>

    <?php /*fermeture de la connexion*/ $pdo = null; ?>
</html>
