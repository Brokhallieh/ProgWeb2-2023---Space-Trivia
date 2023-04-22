To open the php site you need to have a php server running
and a mySQL server running, then go into a terminal at
the project source and type:
"php -S localhost:8000"  
Then go on a Browser and type "localhost:800" into the search bar at the top.

Normally it generates the database and it's contents 
if they are missing but if there is a problem here is my database:  
Name: trivia_space

I have 2 tables: translations and questions.

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

+----+----------+---------------+-------------------------+  
| id | lang     | Title         | Button                  |  
+----+----------+---------------+-------------------------+  
|  1 | English  | Trivia Space  | See another question    |  
|  2 | Francais | Trivia Espace | Voir une autre question |  
+----+----------+---------------+-------------------------+

The questions table contains the different questions and their different answers
in French and in English.

Here is the description of the questions table:

+----------+--------------+------+-----+---------+-------+  
| Field    | Type         | Null | Key | Default | Extra |  
+----------+--------------+------+-----+---------+-------+  
| id       | int(11)      | NO   | PRI | NULL    |       |  
| q_id     | int(11)      | YES  |     | NULL    |       |  
| question | varchar(255) | YES  |     | NULL    |       |  
| answer_a | varchar(255) | YES  |     | NULL    |       |  
| answer_b | varchar(255) | YES  |     | NULL    |       |  
| answer_c | varchar(255) | YES  |     | NULL    |       |  
| answer_d | varchar(255) | YES  |     | NULL    |       |  
| lang     | varchar(255) | YES  |     | NULL    |       |  
+----------+--------------+------+-----+---------+-------+

And the values of the questions table:

+----+------+---------------------------------------------------------------------------------+----------+-------------+-----------------+---------------+----------+  
| id | q_id | question                                                                        | answer_a | answer_b    | answer_c        | answer_d      | lang     |  
+----+------+---------------------------------------------------------------------------------+----------+-------------+-----------------+---------------+----------+  
|  1 |    1 | What is the approximate distance between the Earth and the Sun in kilometers?   | 100 000  | 150 000 000 | 600 000 000 000 | 5 000 000 000 | English  |  
|  2 |    1 | Quelle est la distance approximative entre la Terre et le Soleil en kilometres? | 100 000  | 150 000 000 | 600 000 000 000 | 5 000 000 000 | Francais |  
|  3 |    2 | What is the approximate distance between the Earth and the Moon in kilometers?  | 35 000   | 1 200 000   | 90 000          | 385 000       | English  |  
|  4 |    2 | Quelle est la distance approximative entre la Terre et la Lune en kilometres?   | 35 000   | 1 200 000   | 90 000          | 385 000       | Francais |  
+----+------+---------------------------------------------------------------------------------+----------+-------------+-----------------+---------------+----------+