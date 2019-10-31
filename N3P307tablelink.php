<?php
// take in the id of a director and return his/her full name
function get_director($director_id) {

    global $db;

    $query = 'SELECT 
            student_fullname 
       FROM
           student
       WHERE
           student_id = ' . $director_id;
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $student_fullname;
}

// take in the id of a lead actor and return his/her full name
function get_leadactor($leadactor_id) {

    global $db;

    $query = 'SELECT
            student_fullname
        FROM
            student 
        WHERE
            student_id = ' . $leadactor_id;
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $student_fullname;
}

// take in the id of a movie type and return the meaningful textual
// description
function get_gametype($type_id) {

    global $db;

    $query = 'SELECT 
            gametype_label
       FROM
           gametype
       WHERE
           gametype_id = ' . $type_id;
    $result = mysqli_query($db, $query) or die(mysqli_error($db));

    $row = mysqli_fetch_assoc($result);
    extract($row);

    return $gametype_label;
}

//connect to mysqli
$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));

// retrieve information
$query = 'SELECT
        game_id, game_name, game_year, game_director,
        game_leadactor, game_type
    FROM
        game
    ORDER BY
        game_name ASC,
        game_year DESC';
$result = mysqli_query($db, $query) or die(mysqli_error($db));

// determine number of rows in returned result


$table = <<<ENDHTML
<div style="text-align: center;">
 <h2>game Review Database</h2>
 <table border="1" cellpadding="2" cellspacing="2"
  style="width: 70%; margin-left: auto; margin-right: auto;">
  <tr>
   <th>game Title</th>
   <th>Year of Release</th>
   <th>game Director</th>
   <th>game Lead Actor</th>
   <th>game Type</th>
  </tr>
ENDHTML;



// loop through the results
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    $director = get_director($game_director);
    $leadactor = get_leadactor($game_leadactor);
    $gametype = get_gametype($game_type);


     $table .='<tr>';
     $table .='<td><a href="N3P308details.php?game_id='.$game_id.'">'.$game_name.'</a></td>';
     $table .='<td color="green">'.$game_year.'</td>';
     $table .= '<td>'.$director.'</td>';
     $table .='<td>'.$leadactor.'</td>';
     $table .='<td>'.$gametype.'</td>';
     $table .='</tr>';

}

$table .= <<<ENDHTML
 </table>
</div>
ENDHTML;

echo $table;
?>
