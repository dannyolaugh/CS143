<html>
  <head>
    <title>Add New Movie Comments</title>
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
      <th BGCOLOR="99FF99">
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
 <h4>Add Comments to Movies:</h4>
  
  <form action="./insertMC.php" method = "GET">
    
    <?php
       $movieOptions = "";
       
       $db_connection = mysql_connect("localhost", "cs143", "");
       mysql_select_db("CS143", $db_connection);
       
       $query = "select * from Movie order by title ASC";
       $movies = mysql_query($query, $db_connection);
       
       while($row = mysql_fetch_row($movies))
       {
        $id = $row['0'];
        $title =$row['1'];
        $year = $row['2'];
        $movieOptions.="<option value=\"$id\">".$title." [".$year."]</option>";
       }
       
       ?>

    Movie:<select name="id">
      <?=$movieOptions?>
    </select><br/>
    Your Name:<input type="text" name="name" value="<?php echo htmlspecialchars($_GET['name']);?>" maxlength="20"><br/>
    Rating:<select name="rating">
      <option value="5"> 5 </option>
      <option value="4"> 4 </option>
      <option value="3"> 3 </option>
      <option value="2"> 2 </option>
      <option value="1"> 1 </option>
    </select><br/>
    Comments: <br/><textarea name="comment" cols="60" rows="10" value=><?php echo htmlspecialchars($_GET['comment']);?></textarea><br/>
    <br/>
    <input type="submit" value="Comment"/>
  </form>

  <?php
       
     $comment = $_GET["comment"];
     $movie = $_GET["id"];
     $name = $_GET["name"];
     $rating = $_GET["rating"];
     
     if($movie=="" && $rating=="" && $name =="")
     {
     //nothing
     }
     else if($movie == "" || $rating == "" || $comment == "")
     {
     echo "Please fill out all fields";
     }
     else
     {
     if($name == "")
      $name = "Anonymous";
     $query = "INSERT INTO Review VALUES('$name', now(), '$movie', '$rating', '$comment')";

     $rs = mysql_query($query, $db_connection);

     echo "Success!";
       }
     
     
     mysql_close($db_connection);
       
     ?>
  
  </body>
</html>
