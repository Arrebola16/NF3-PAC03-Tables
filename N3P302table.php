<?php
//connect to MySQL
$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));
?>
<div style="text-align: center;">
 <h2>Movie Review Database</h2>
 <table border="1" cellpadding="2" cellspacing="2"
  style="width: 70%; margin-left: auto; margin-right: auto;">
  <tr>
   <th>Game Title</th>
   <th>Game of Release</th>
   <th>Game Director</th>
   <th>Game Lead Actor</th>
   <th>Game Type</th>
  </tr>
 </table>
</div>
