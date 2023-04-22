<?php
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trivia_space";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);



$q_id = rand(1, 2);

$string_language = "English";
$data = json_decode(file_get_contents("php://input"));
$string_language= $data->string_language;

if(isset($_POST['language_selected'])) {
    $string_language = $_POST['language_selected'];
}

// Fetch question from database
$stmt = $pdo->prepare("SELECT * FROM questions 
    WHERE q_id = $q_id AND lang = '$string_language'");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return question as JSON
header('Content-Type: application/json');
echo json_encode($projects);
