<html>
  <head><title>Movie Info Page</title></head>
  <center><h1>J&D's Movie Database</h1></center>
  </head>
<center>
  <table border="1">
    <tr>
      <th BGCOLOR="FFFF99">
        <a href="insertAD.php">Insert New Actor/Director</a>
        </th>
      <th BGCOLOR="FFFF99">
        <a href="insertM.php">Insert New Movie</a>
        </th>
      <th BGCOLOR="FFFF99">
        <a href="insertMC.php">Comment on a Movie</a>
        </th>
      <th BGCOLOR="FFFF99">
        <a href="insertAM.php">Add a New Actor/Movie Relationship</a>
        </th>
      <th BGCOLOR="FFFF99">
        <a href="insertMD.php">Add a New Movie/Director Relationship</a>
        </th>
      <th BGCOLOR="FFFF99">
        <a href="search.php">Search Movies/Actors</a>
        </th>
      </tr>
    </table>
  </center>

<body BGCOLOR="#FF9966">
  <H1>Movie Page</H1>
    <?php

       $db_connection = mysql_connect("localhost", "cs143", "");
       mysql_select_db("CS143", $db_connection);       
       $mid = intval($_REQUEST['ID']);
       $query = "SELECT * FROM Movie WHERE id = " .$mid;
       $movie = mysql_query($query, $db_connection);
       $row = mysql_fetch_row($movie);

       //print information
       echo "Title: ".$row['1']." (".$row['2'].")"."<br>";
       echo "Producer: ".$row['4']. "<br>";
       echo "Rating: ".$row['3']."<br>";
       echo "Director: ";

       //print out the director
       $query = "select * from MovieDirector where mid = " . $mid;
       $did = mysql_query($query, $db_connection);
       $count = 0;
       while($row = mysql_fetch_row($did))
       {
       if($count ==1)
        echo ", ";
       $count = 1;
       $query = "select * from Director where id = " . $row['1'];
       $director = mysql_query($query, $db_connection);
       while($row = mysql_fetch_row($director))
        echo $row['2'] . " " . $row['1'];
       }
       
       echo"<br>";
       echo "Genre: ";
       $query = "select * from MovieGenre where mid = " . $mid;
       $genre = mysql_query($query, $db_connection);
       $count = 0;
       while($row = mysql_fetch_row($genre))
       {
       if($count == 0)
        echo $row['1'];
       else
        echo ", ".$row['1'];
       $count = 1;
       }
       echo "<br>Average Rating: ";
       
       //query for count and average rating
       $query = "SELECT * FROM Review WHERE mid =" . $mid;
       $ratings = mysql_query($query, $db_connection);
       $count =0;
       $total = 0;
       while($row = mysql_fetch_row($ratings))
       {
        $count++;
        $total+=$row['3'];
       }
       if($count != 0)
       {
       $formattedAvgRating = $total/$count;
       echo "$formattedAvgRating out of 5<br/>";
       }
       else
       echo "N/A<br>";

       //print list of actors with there roles
       $query = "select * from MovieActor where mid = " .$mid;
       $actors = mysql_query($query, $db_connection);
       $z = 0;
       while($row = mysql_fetch_row($actors))
        {
         if($z==0)
         {
          echo "<br><br>Actors:<br>";
          $z=1;
         }
         ;
         $actor = mysql_query("select * from Actor where id = ".$row['1'],
                              $db_connection);
         $r = mysql_fetch_row($actor);
         echo "<a href=\"actor.php?ID=".$r['0']."\">".$r['2']." ".$r['1']." (".$r['4'].")"."</a>";
         echo " as ".$row['2'];
         echo "<br>";
        }
       
       echo "<br><br>Movie Ratings:<br>";
       $query = "select * from Review where mid = $mid order by time DESC";
       $reviews = mysql_query($query, $db_connection);
       
       while($row = mysql_fetch_row($reviews))
       {
        echo $row['0']." gave the film ".$row['3']." out of 5 and said: ".$row['4'];
        echo "<br>" .$row['1'];
        echo "<br><br>";
       }
       
       mysql_close($db_connection);
       
       
       ?>
  </body>
</html>
