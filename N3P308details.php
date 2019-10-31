<?php
function generate_ratings($rating) {
$media=0;
   $game_rating= ' '; 
   $hola=0;
 
   for ($i = 1; $i <= $rating; $i++) {
        $game_rating .= '<img src="star.png" alt="star" width="20" height="20"/> ';
        
        $entera = intval($rating);
        $decimal = $rating - $entera;
        
        if (is_int($decimal)==false){
            $hola=$decimal*20;
            $game_rating .= '<img src="star.png" alt="star" width="20" height="20" style="clip:rect(0px,'.$hola.'px,100px,0px); position:absolute;"/> ';
            
        }

    } 
    return $game_rating;
    
    
}

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

// function to calculate if a movie made a profit, loss or just broke even
function calculate_differences($takings, $cost) {

    $difference = $takings - $cost;

    if ($difference < 0) {     
        $color = 'red';
        $difference = '$' . abs($difference) . ' million';
    } elseif ($difference > 0) {
        $color ='green';
        $difference = '$' . $difference . ' million';
    } else {
        $color = 'blue';
        $difference = 'broke even';
    }

    return '<span style="color:' . $color . ';">' . $difference . '</span>';
}

$db = mysqli_connect('localhost', 'root') or die ('Unable to connect.
Check your connection parameters.');
//make sure you're using the correct database
mysqli_select_db($db,'gamesite') or die(mysqli_error($db));

// retrieve information

$mahe=intval($_GET['game_id']);  // para comprobar poner = a cualquier numero de la tabla un puto 6 si quiero crack fiera omar el dios 

$query = 'SELECT
        game_id,game_name, game_year, game_director, game_leadactor,
        game_type, game_running_time, game_cost, game_takings
    FROM game
   WHERE game_id = '. $mahe ;
       
$result = mysqli_query($db,$query) or die(mysqli_error($db));
/*
extract($row);
$row = mysqli_fetch_assoc($result);
$game_name         = $game_name;
$game_director     = $get_director;
$game_leadactor    = $get_leadactor;
$game_year         = $game_year;
$game_running_time = $game_running_time;
$game_takings      = $game_takings;
$game_cost         = $game_cost;
$game_health       = $calculate_differences;
  */                      
    

$row = mysqli_fetch_assoc($result);
$game_name = $row['game_name'];
$game_director = get_director($row['game_director']);
$game_leadactor = get_leadactor($row['game_leadactor']);
$game_year = $row['game_year'];
$game_running_time = $row['game_running_time'] .' mins';
$game_takings = $row['game_takings'] . ' million';
$game_cost = $row['game_cost'] . ' million';
$game_health = calculate_differences($row['game_takings'],
$row['game_cost']);                       

// display the information

$table.= <<<ENDHTML

<html>
 <head>
  <title>Details and Reviews for: $game_name</title>
 </head>
 <body>
  <div style="text-align: center;">
   <h2>$game_name</h2>
   <h3><em>Details</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 70%; margin-left: auto; margin-right: auto;">
    <tr>
     <td><strong>Title</strong></strong></td>
     <td>$game_name</td>
     <td><strong>Release Year</strong></strong></td>
     <td>$game_year</td>
    </tr><tr>
     <td><strong>game Director</strong></td>
     <td>$game_director</td>
     <td><strong>Cost</strong></td>
     <td>$$game_cost</td>
    </tr><tr>
     <td><strong>Lead Actor</strong></td>
     <td>$game_leadactor</td>
     <td><strong>Takings</strong></td>
     <td>$$game_takings</td>
    </tr><tr>
     <td><strong>Running Time</strong></td>
     <td>$game_running_time</td>
     <td><strong>Health</strong></td>
     <td>$game_health</td>
    </tr>
   </table>
ENDHTML;

// retrieve reviews for this movie
 $query = "SELECT
        review_game_id, review_date, reviewer_name, review_comment,
        review_rating
    FROM
        reviews
    WHERE review_game_id = ".$mahe;


  
if ($_GET[orden1]==review_date){
    
 $query = 'SELECT
        review_game_id, review_date, reviewer_name, review_comment,
        review_rating
    FROM
        reviews
    WHERE review_game_id = '.$mahe.' ORDER BY review_date ASC' ;
}

if ($_GET[orden2]==reviewer_name){
    
    $query = 'SELECT
        review_game_id, review_date, reviewer_name, review_comment,
        review_rating
    FROM
        reviews
    WHERE review_game_id = '.$mahe.' ORDER BY reviewer_name ASC' ;
}

if ($_GET[orden3]==review_comment){
    
    $query = 'SELECT
        review_game_id, review_date, reviewer_name, review_comment,
        review_rating
    FROM
        reviews
    WHERE review_game_id = '.$mahe.' ORDER BY review_comment ASC' ;
}

if ($_GET[orden4]==review_rating){
    
    $query = 'SELECT
        review_game_id, review_date, reviewer_name, review_comment,
        review_rating
    FROM
        reviews
    WHERE review_game_id = '.$mahe.' ORDER BY review_rating ASC' ;
}



$result = mysqli_query($db, $query) or die(mysqli_error($db));

// display the reviews
$table.=<<<ENDHTML
   <h3><em>Reviews</em></h3>
   <table cellpadding="2" cellspacing="2"
    style="width: 90%; margin-left: auto; margin-right: auto;">
    <tr>
    
     <th style="width: 7em;"><a href="N3P308details.php?game_id=$mahe&orden1=review_date">Date</a></th>
     <th style="width: 10em;"><a href="N3P308details.php?game_id=$mahe&orden2=reviewer_name">Reviewer</th>
     <th><a  href="N3P308details.php?game_id=$mahe&orden3=review_comment">Comments</th>
     <th style="width: 5em;"><a href="N3P308details.php?game_id=$mahe&orden4=review_rating">Rating</th>
    </tr>
ENDHTML;


        
$result = mysqli_query($db, $query) or die(mysqli_error($db));
$cont=0;
$total=0;
$cont2=0;
$media=0;
$estrellas=0;
while ($row = mysqli_fetch_assoc($result)) {
    
    extract($row);
    $date = $review_date;
    $name = $reviewer_name;
    $comment =$review_comment;
    $rating =generate_ratings($review_rating);
    $media_valoracion=$review_rating;
     if(($cont%2)!=0){
            $color_fondo= "background-color:#FF5733";
        }else{
            $color_fondo= "background-color:#33FFE3";
        }
    $cont++;
    $cont2++;
    $media2=$media2+$media_valoracion;
   $table.= <<<ENDHTML
    <tr>
      <td style="vertical-align:top; text-align: center;$color_fondo">$date</td>
      <td style="vertical-align:top;text-align: center;$color_fondo">$name</td>
      <td style="vertical-align:top;text-align: center;$color_fondo">$comment</td>
      <td style="vertical-align:top;text-align: center;$color_fondo">$rating</td>
      
    </tr>
ENDHTML;
}
$media2=$media2/$cont2;//calculo de la media

$estrellas=generate_ratings($media2);



//$entero=intval($media);//discriminar parte entera
//$decimal=$media-$entero;//discriminar parte decimal
//$media_estrella=generar_valoracion($entero);//conseguir las estrellas completas de la parte entera
//$porcentaje=0;
$table.= <<<ENDHTML
    <tr>
        <td style="vertical-align:top;text-align: center;$color_fondo">Media de ratings</td>
        <td style="vertical-align:top;text-align: center;$color_fondo">$estrellas</td>
    </tr>
    </table>
  </div>
 </body>
</html>
ENDHTML;
echo $table;

?>




