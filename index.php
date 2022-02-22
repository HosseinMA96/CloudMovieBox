<?php
$servername = "sql109.ihweb.ir";
$username = "ihweb_31084399";
$password = "17m3fsnt";
$dbname= "ihweb_31084399_main";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully <br>";
?>

<!DOCTYPE html>
<html lang="en" xmlns:https="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8">

    <title>MoviesJoy</title>
<!--    <link rel="stylesheet" href="style.css">-->
    <style>
        body
        {
            /*background-color: lightgoldenrodyellow;*/
        }
        #main_div{
            height: 80vh;
            background-color: white;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
        }

        .row_div{
            height: 30%;
            /*background-color: teal;*/
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .poster_div
        {
            height: 100%;
            width: 20%;
            background-size: cover;
        }

        img {
        max-width: 100%;
        max-height: 100%;
         }

        /* #fight\ club
        {
            background: url(https://s23.picofile.com/file/8447484318/fight_club.JPG);
            background-size: cover;
        }

        #scarface
        {
            background: url(https://s23.picofile.com/file/8447484226/scarface.JPG);
            background-size: cover;
        }

        #shaolin
        {
            background: url(https://s23.picofile.com/file/8447484326/shaolin.JPG);
            background-size: cover;
        } */

        .button_div
        {
            height: 100%;
            width: 10%;
            /*background-color: rebeccapurple;*/
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .info_div
        {
            height: 100%;
            width: 20%;
            /*background-color: chocolate;*/
            display: flex;
            flex-direction: column;
        }


    </style>
</head>
<body>

<?php

$sql = "SELECT id, movie_name, movie_producer, movie_poster FROM movies_list";
$result = $conn->query($sql);

// echo "$result->num_rows <br>";
// echo "$dbname <br>";
// echo count($row["movie_name"]);
// echo "<br>";
$movieName = array();
$movieProducer = array();
$moviePoster = array();

// $row = $result->fetch_assoc();
$idx=0;

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    // echo "id: " . $row["movie_name"]. " - Name: " . $row["movie_producer"]. " " . $row["movie_poster"]. "<br>";
    // echo $row["movie_name"];
    $movieName[$idx]=$row["movie_name"];
    $movieProducer[$idx]=$row["movie_producer"];
    $moviePoster[$idx]=$row["movie_poster"];
    $idx++;
  }

} else {
  echo "0 results";
}
// // echo count($movieName);
// for ($i=0;$i<3;$i++)
// {
//     echo $movieName[$i].$movieProducer[$i]. $moviePoster[$i] ."<br>";
// }
// $conn->close();
// $film_name="fight club";
?>


<h2>My sincere movie box</h2>
<div id="main_div">
    <div class="row_div">
        <div class="poster_div">
        <img src=<?php echo $moviePoster[0] ?> >
        </div>
        <div class="info_div">
            <?php echo "<h2>" .$movieName[0]. "</h2>"; ?>
            <?php echo "<p>" .$movieProducer[0]. "</p>"; ?>
        </div>
        <div class="button_div">
        
        
        <a href="http://sinceremoviebox.ihweb.ir/first.php?film_name=<?php echo $movieName[0] ?>">

            <button >Add a comment</button></a>

        <a href="http://sinceremoviebox.ihweb.ir/second.php?film_name=<?php echo $movieName[0] ?>">
            <button >View comments</button></a>
           
        </div>
    </div>

        <div class="row_div">
        <div class="poster_div">
        <img src=<?php echo $moviePoster[1] ?> >
        </div>
        <div class="info_div">
            <?php echo "<h2>" .$movieName[1]. "</h2>"; ?>
            <?php echo "<p>" .$movieProducer[1]. "</p>"; ?>
        </div>
       <div class="button_div">
        
        
        <a href="http://sinceremoviebox.ihweb.ir/first.php?film_name=<?php echo $movieName[1] ?>">

            <button >Add a comment</button></a>

        <a href="http://sinceremoviebox.ihweb.ir/second.php?film_name=<?php echo $movieName[1] ?>">
            <button >View comments</button></a>
           
        </div>
    </div>

        <div class="row_div">
        <div class="poster_div">
        <img src=<?php echo $moviePoster[2] ?> >
        </div>
        <div class="info_div">
            <?php echo "<h2>" .$movieName[2]. "</h2>"; ?>
            <?php echo "<p>" .$movieProducer[2]. "</p>"; ?>
        </div>
         <div class="button_div">
        
        
        <a href="http://sinceremoviebox.ihweb.ir/first.php?film_name=<?php echo $movieName[2] ?>">

            <button >Add a comment</button></a>

        <a href="http://sinceremoviebox.ihweb.ir/second.php?film_name=<?php echo $movieName[2] ?>">
            <button >View comments</button></a>
           
        </div>
    </div>
</div>
</body>
</html>
