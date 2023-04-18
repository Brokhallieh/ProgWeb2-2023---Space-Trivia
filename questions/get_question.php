<?php

// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "trivia_space";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


// Fetch questions from database
$stmt = $pdo->prepare("SELECT * FROM $dbname.translations");
$stmt->execute();
$projects = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Return questions as JSON
header('Content-Type: application/json');
echo json_encode($projects);
