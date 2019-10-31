<?php

$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));

//alter the movie table to include running time, cost and takings fields


//insert new data into the movie table for each movie
$query = 'UPDATE game SET
        
        game_cost = 1
        
    WHERE
        game_id = 3';
        
mysqli_query($db, $query) or die(mysqli_error($db));
/*
$query = 'UPDATE game SET
        game_running_time = 89,
        game_cost = 10,
        game_takings = 10.8
    WHERE
        game_id = 2';
mysqli_query($db, $query) or die(mysqli_error($db));

$query = 'UPDATE game SET
        game_running_time = 134,
        game_cost = NULL,
        game_takings = 33.2
    WHERE
        game_id = 3';
mysqli_query($db, $query) or die(mysqli_error($db));
*/
echo 'game database successfully updated!';


?>
