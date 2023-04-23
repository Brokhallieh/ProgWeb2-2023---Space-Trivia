<?php
include "connect_to_db.php";
include "ExecuteSQL.php";

$data = json_decode(file_get_contents("php://input"));
$email = $data->email;
$score = $data->score;

if (gettype($email) == "string" && strlen($email) < 255 && gettype($score) == "integer" && $score>=0 && $score <= 4) {
    executeSQL($pdo, "INSERT INTO users (email, score) VALUES ('$email', $score);");
}

$pdo = null;
