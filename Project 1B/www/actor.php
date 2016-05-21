<html>
  <head><title>Actor Info Page</title></head>
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
    <h1>Actor Page</h1>
    <?php
       $db_connection = mysql_connect("localhost", "cs143", "");
       mysql_select_db("CS143", $db_connection);
       $aid = intval($_REQUEST['ID']);
       $query = "SELECT * FROM Actor WHERE id = " .$aid;
       $actor = mysql_query($query, $db_connection);
       $row = mysql_fetch_row($actor);

       echo "Name: ".$row['2']. " ".$row['1']. "<br>";
       echo "Gender: ".$row['3']. "<br>";
       echo "DOB: ".$row['4']. "<br>";
       if($row['5'] != NULL)
        echo "DOD: ".$row['5']. "<br>";
       else
        echo "DOD: Still Alive";

       $query = "select * from MovieActor where aid = " .$aid;
       $movies = mysql_query($query, $db_connection);
       $z = 0;
       while($row = mysql_fetch_row($movies))
        {
         if($z==0)
         {
          echo "<br><br>Movies:<br>";
          $z=1;
         }
         $movie = mysql_query("select * from Movie where id = ".$row['0'], 
                              $db_connection);
         $r = mysql_fetch_row($movie);
         echo $row['2']." in "; 
         echo "<a href=\"movie.php?ID=".$row['0']."\">".$r['1']." (".$r['2'].")"."</a>";
         echo "<br>";
        }


       

       mysql_close($db_connection);


       ?>
  </body>
</html>


