<?php

$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));
create the reviews table
$query = 'CREATE TABLE reviews (
review_game_id INTEGER UNSIGNED NOT NULL,
review_date DATE NOT NULL,
reviewer_name VARCHAR(255) NOT NULL,
review_comment VARCHAR(255) NOT NULL,
review_rating FLOAT UNSIGNED NOT NULL DEFAULT 0,
KEY (review_game_id)
)
ENGINE=MyISAM';
mysqli_query($db, $query) or die(mysqli_error($db));

*/


//insert new data into the reviews table

$sql= "INSERT INTO reviews (review_game_id, review_date, reviewer_name,
review_comment, review_rating)
VALUES
(1, '2018-05-15', 'Alejandro', 'Es increible este juego.', 4.5),
(2, '2009-12-30', 'Eloy', 'El juego es decente.', 2),
(3, '2010-11-14', 'Andy', 'El mejor juego que he jugado nunca', 5),
(4, '2019-02-01', 'Mell', 'Es un juego muy bueno, me ecanta! .', 5),
(5, '2001-10-03', 'Marc', 'Mejorable.', 3)";


mysqli_query($db, $sql) or die(mysqli_error($db));


echo 'game database successfully updated!';
?>