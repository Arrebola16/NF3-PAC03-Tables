6<?php
//connect to mysqli
$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));

// retrieve information
$query = 'SELECT
        game_name, game_year, game_director, game_leadactor,
        game_type
    FROM
        game
    ORDER BY
        game_name ASC,
        game_year DESC';
$result = mysqli_query($db,$query) or die(mysqli_error($db));

// determine number of rows in returned result
$num_games = mysqli_num_rows($result);
?>
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
<?php
// loop through the results
while ($row = mysqli_fetch_assoc($result)) {
    extract($row);
    echo '<tr>';
    echo '<td>' . $game_name . '</td>';
    echo '<td>' . $game_year . '</td>';
    echo '<td>' . $game_director . '</td>';
    echo '<td>' . $game_leadactor . '</td>';
    echo '<td>' . $game_type . '</td>';
    echo '</tr>';
}     
?>
 </table>
<p><?php echo $num_games; ?> games</p>
</div>
