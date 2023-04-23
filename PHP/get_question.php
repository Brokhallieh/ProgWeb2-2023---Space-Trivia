<?php
include "connect_to_db.php";


$q_id = rand(1, 4);

$string_language = "English";
$data = json_decode(file_get_contents("php://input"));
$string_language= $data->string_language;

// Fetch question from database
$stmt = $pdo->prepare("SELECT * FROM questions 
    WHERE q_id = $q_id AND lang = '$string_language'");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return question as JSON
header('Content-Type: application/json');
echo json_encode($projects);

$pdo = null; //fermeture de la connexion
