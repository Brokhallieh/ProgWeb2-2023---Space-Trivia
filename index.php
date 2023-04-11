<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <link rel="stylesheet" href="style.css" />
        <title>Trivia Space - Project Prog-Web2 Yann Toussaint 2023</title>
        <meta http-equiv="Content-Language" content="fr, en">
    </head>
    <?php 
    //connexion
    $servername = "localhost"; // le nom de votre serveur MySQL
    $username = "root"; // votre nom d'utilisateur MySQL
    $password = "";
    $dbname = "trivia_space_trad"; // le nom de votre base de données

    // Créer une connexion à la base de données
    $conn = mysqli_connect($servername, $username, $password, $dbname);

    // Vérifier si la connexion a réussi
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    

    $string_language = "English";
    if(isset($_POST['language_selected'])) {
        $string_language = $_POST['language_selected'];
    }

    $sql = "SELECT language FROM language";
    $result = $conn->query($sql);
    $id_language = 0;
    while (($row = $result->fetch_assoc()) != NULL) {
        if ($row['language'] == $string_language) {
            break;
        }
        $id_language++;
    }
    function printSelector($selector, $conn, $id_language) {
        $rows = [];
        $sql = "SELECT $selector FROM language";
        $result = $conn->query($sql);
        while (($row = $result->fetch_assoc()) != NULL) {
            $rows[] = $row;
        }
        echo $rows[$id_language][$selector];
    }
    ?>

    <body>
        <h1><?php printSelector('Title', $conn, $id_language)?></h1>

        <?php printSelector('Hello', $conn, $id_language); ?>

        <form method="post" action="index.php">
            <label for="language_selected">language :</label>
            <select id="language_selected" name="language_selected">
                <option value="English">English</option>
                <option value="Francais">Français</option>
            </select>
            <button type="submit">Envoyer</button>
        </form>


        <div class="stars"></div>
        <script src="script.js"></script>
    </body>

    <?php /*fermeture de la connexion*/ $conn->close(); ?>
</html>
