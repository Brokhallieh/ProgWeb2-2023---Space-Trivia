To open the php site you need to have a php server running
and a mySQL server running, then go into a terminal at
the project source and type:
"php -S localhost:8000"  
Then go on a Browser and type "localhost:800" into the search bar at the top.

Normally it generates the database and it's contents 
if they are missing but if there is a problem here is my database:  
Name: trivia_space

I have 3 tables: translations, questions and users.

translations contains the translations for the static elements
for the English and the French version.  

Here is the description of the translations table:

+--------+--------------+------+-----+---------+----------------+  
| Field  | Type         | Null | Key | Default | Extra          |  
+--------+--------------+------+-----+---------+----------------+  
| id     | int(11)      | NO   | PRI | NULL    | auto_increment |  
| lang   | varchar(100) | YES  |     | NULL    |                |  
| Title  | varchar(100) | YES  |     | NULL    |                |  
| Button | varchar(255) | YES  |     | NULL    |                |  
+--------+--------------+------+-----+---------+----------------+

And the values of the translations table:

+----+----------+---------------+-----------------------------+  
| id | lang     | Title         | Button                      |  
+----+----------+---------------+-----------------------------+  
|  1 | English  | Trivia Space  | See a random question       |  
|  2 | Francais | Trivia Espace | Voir une question aléatoire |  
+----+----------+---------------+-----------------------------+

The questions table contains the different questions and their different answers
in French and in English.

Here is the description of the questions table:

+----------------+--------------+------+-----+---------+-------+  
| Field          | Type         | Null | Key | Default | Extra |  
+----------------+--------------+------+-----+---------+-------+  
| id             | int(11)      | NO   | PRI | NULL    |       |  
| q_id           | int(11)      | YES  |     | NULL    |       |  
| question       | varchar(255) | YES  |     | NULL    |       |  
| answer_a       | varchar(255) | YES  |     | NULL    |       |  
| answer_b       | varchar(255) | YES  |     | NULL    |       |  
| answer_c       | varchar(255) | YES  |     | NULL    |       |  
| answer_d       | varchar(255) | YES  |     | NULL    |       |  
| lang           | varchar(255) | YES  |     | NULL    |       |  
| correct_answer | int(11)      | YES  |     | NULL    |       |  
+----------------+--------------+------+-----+---------+-------+

And the values of the questions table:

+----+------+----------------------------------------------------------------------------------------------------------------------+-----------------+----------------+-----------------+---------------+----------+----------------+  
| id | q_id | question                                                                                                             | answer_a        | answer_b       | answer_c        | answer_d      | lang     | correct_answer |  
+----+------+----------------------------------------------------------------------------------------------------------------------+-----------------+----------------+-----------------+---------------+----------+----------------+  
|  1 |    1 | What is the approximate distance between the Earth and the Sun in kilometers?                                        | 100 000         | 150 000 000    | 600 000 000 000 | 5 000 000 000 | English  |              2 |  
|  2 |    1 | Quelle est la distance approximative entre la Terre et le Soleil en kilometres?                                      | 100 000         | 150 000 000    | 600 000 000 000 | 5 000 000 000 | Francais |              2 |  
|  3 |    2 | What is the approximate distance between the Earth and the Moon in kilometers?                                       | 35 000          | 1 200 000      | 90 000          | 385 000       | English  |              4 |  
|  4 |    2 | Quelle est la distance approximative entre la Terre et la Lune en kilometres?                                        | 35 000          | 1 200 000      | 90 000          | 385 000       | Francais |              4 |  
|  5 |    3 | Who was the astronaut that was part of the crew of the first moon landing that didn't walk on the moon?              | Michael Collins | Buzz Lightyear | Neil Armstrong  | Buzz Aldrin   | English  |              1 |  
|  6 |    3 | Quel est l'astronaute qui faisait partie de l'équipage du premier atterisage lunaire qui n'a pas marché sur la lune? | Michael Collins | Buzz l'Éclair  | Neil Armstrong  | Buzz Aldrin   | Francais |              1 |  
|  7 |    4 | What is the approximate distance between Jupiter and the Sun in kilometers?                                          | 100 000 000     | 44 000 000     | 740 000 000     | 250 000 000   | English  |              3 |  
|  8 |    4 | Quelle est la distance approximative entre Jupiter et le Soleil en kilometres?                                       | 100 000 000     | 44 000 000     | 740 000 000     | 250 000 000   | Francais |              3 |  
+----+------+----------------------------------------------------------------------------------------------------------------------+-----------------+----------------+-----------------+---------------+----------+----------------+

The users table contains the mail of the different users and their
score. Only the people who put a mail and a score are in the DB.

Here is the description of the users table:

+-------+--------------+------+-----+---------+----------------+  
| Field | Type         | Null | Key | Default | Extra          |  
+-------+--------------+------+-----+---------+----------------+  
| id    | int(11)      | NO   | PRI | NULL    | auto_increment |  
| email | varchar(255) | YES  |     | NULL    |                |  
| score | varchar(255) | YES  |     | NULL    |                |  
+-------+--------------+------+-----+---------+----------------+


And an example of the values that can be contained in the questions table:

+----+-----------+-------+  
| id | email     | score |  
+----+-----------+-------+  
|  1 | yes@it.is | 1     |  
+----+-----------+-------+
