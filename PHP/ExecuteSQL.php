<?php
function executeSQL($pdo, $SQLCode) {
    $stmt = $pdo->prepare($SQLCode);
    $stmt->execute();
}

function getUnfetchedSQL($pdo, $SQLCode) {
    $retour = $pdo->prepare($SQLCode);
    $retour->execute();
    return $retour;
}

function getSQLResult($pdo, $SQLCode) {
    return $pdo->query($SQLCode)->fetchColumn();
}


function executeAllSQL($pdo) {
    executeSQL($pdo, "CREATE TABLE IF NOT EXISTS translations (
        id INTEGER PRIMARY KEY,
        lang VARCHAR(100),
        Title VARCHAR(100),
        Hello VARCHAR(100))");
    executeSQL($pdo, "CREATE TABLE IF NOT EXISTS questions(
        id int PRIMARY KEY,
        q_id int,
        question varchar(255),
        answer_a VARCHAR(255),
        answer_b VARCHAR(255),
        answer_c VARCHAR(255),
        answer_d VARCHAR(255),
        lang VARCHAR(255))");
    executeSQL($pdo,  "CREATE TABLE IF NOT EXISTS users(
        id int PRIMARY KEY AUTO_INCREMENT, 
        email VARCHAR(255),                
        score VARCHAR(255))");
}

function insertTranslationsSQL($pdo, $translationsTable) {
    executeSQL($pdo, "INSERT INTO $translationsTable
        VALUES (1, 'English', 'Trivia Space', 'See a random question'),
        (2, 'Francais', 'Trivia Espace', 'Voir une question aléatoire')");
}

function insertQuestionsSQL($pdo, $questionsTable) {
    executeSQL($pdo, "INSERT INTO $questionsTable
        VALUES (1, 1, 'What is the approximate distance between the Earth and the Sun in kilometers?', '100 000', '150 000 000', '600 000 000 000', '5 000 000 000', 'English', 2),
        (2, 1, 'Quelle est la distance approximative entre la Terre et le Soleil en kilometres?', '100 000', '150 000 000', '600 000 000 000', '5 000 000 000', 'Francais', 2),
        (3, 2, 'What is the approximate distance between the Earth and the Moon in kilometers?', '35 000', '1 200 000', '90 000', '385 000', 'English', 4),
        (4, 2, 'Quelle est la distance approximative entre la Terre et la Lune en kilometres?', '35 000', '1 200 000', '90 000', '385 000', 'Francais', 4),
        (5, 3, 'Who was the astronaut that was part of the crew of the first moon landing that didn\'t walk on the moon?', 'Michael Collins', 'Buzz Lightyear', 'Neil Armstrong', 'Buzz Aldrin', 'English', 1),
        (6, 3, 'Quel est l\'astronaute qui faisait partie de l\'équipage du premier atterisage lunaire qui n\'a pas marché sur la lune?', 'Michael Collins', 'Buzz l\'Éclair', 'Neil Armstrong', 'Buzz Aldrin', 'Francais', 1),
        (7, 4, 'What is the approximate distance between Jupiter and the Sun in kilometers?', '100 000 000', '44 000 000', '740 000 000', '250 000 000', 'English', 3),
        (8, 4, 'Quelle est la distance approximative entre Jupiter et le Soleil en kilometres?', '100 000 000', '44 000 000', '740 000 000', '250 000 000', 'Francais', 3)");
}


function RebuildDBIfNecessary($pdo, $translationsTable, $questionsTable) {
    $nb_translations = getSQLResult($pdo, "SELECT COUNT(*) FROM $translationsTable");
    if ($nb_translations < 2) { //reconstruit la DB de traductions si elle n'est pas complète
        executeSQL($pdo, "DELETE FROM $translationsTable");
        insertTranslationsSQL($pdo, $translationsTable);
    }

    $nb_questions = getSQLResult($pdo, "SELECT COUNT(*) FROM $questionsTable");
    if ($nb_questions < 8) { //reconstruit la DB de questions si elle n'est pas complète
        executeSQL($pdo, "DELETE FROM $questionsTable");
        insertQuestionsSQL($pdo, $questionsTable);
    }
}
