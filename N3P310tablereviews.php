<?php
$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));



$query = 'INSERT INTO 
        reviews
    (review_game_id, review_date, reviewer_name, review_comment,
        review_rating)
VALUES 
    (1, "2019-10-10", "Oscar", "ME ENCANTA.", 4.5)';
    

mysqli_query($db,$query) or die(mysqli_error($db));

echo "Game database successfully updated!";
?>
