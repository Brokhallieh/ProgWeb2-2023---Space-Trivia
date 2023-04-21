<?php
function executeSQL($pdo, $SQLCode) {
    $stmt = $pdo->prepare($SQLCode);
    $stmt->execute();
}



function executeAllSQL($pdo) {
    executeSQL($pdo, "CREATE TABLE IF NOT EXISTS translations (
            id INTEGER PRIMARY KEY,
            lang VARCHAR(100),
            Title VARCHAR(100),
            Hello VARCHAR(100)
            )");
}

function insertTranslationsSQL($pdo, $dbname) {
    executeSQL($pdo, "INSERT INTO $dbname.translations
                VALUES (1, 'English', 'Trivia Space', 'Hello everyone'),
                (2, 'Francais', 'Trivia Espace', 'Bonjour tout le monde')");
}


/*
CREATE TABLE IF NOT EXISTS questions(
    id int PRIMARY KEY,
    q_id int,
    question varchar(255),
    answer_a VARCHAR(255),
    answer_b VARCHAR(255),
    answer_c VARCHAR(255),
    answer_d VARCHAR(255));
*/

/*
INSERT INTO questions
    VALUES (1, 1, "What is the approximate distance between the Earth and the Sun in kilometers?", "100000", "150000000", "600000000000", "5100000000", "English"),
    (2, 1, "Quelle est la distance approximative entre la Terre et le Soleil en kilometres?", "100000", "150000000", "600000000000", "5100000000", "Francais");

 *
+----+------+---------------------------------------------------------------------------------+----------+-----------+--------------+------------+----------+
| id | q_id | question                                                                        | answer_a | answer_b  | answer_c     | answer_d   | lang     |
+----+------+---------------------------------------------------------------------------------+----------+-----------+--------------+------------+----------+
|  1 |    1 | What is the approximate distance between the Earth and the Sun in kilometers?   | 100000   | 150000000 | 600000000000 | 5100000000 | English  |
|  2 |    1 | Quelle est la distance approximative entre la Terre et le Soleil en kilometres? | 100000   | 150000000 | 600000000000 | 5100000000 | Francais |
+----+------+---------------------------------------------------------------------------------+----------+-----------+--------------+------------+----------+

*/