<html>
  <head>
    <title>Add New Actor/Director</title>
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
	<th BGCOLOR="99FF99">
          <a href="insertMD.php">Add a New Movie/Director Relationship</a>
        </th>
	<th BGCOLOR="FFFF99">
          <a href="search.php">Search Movies/Actors</a>
        </th>
      </tr>
    </table>
  </center>
  
  <body BGCOLOR="#FF9966">
    <h4>Add New Movie/Director Relationship:</h4>
    
    <form action="./insertMD.php" method = "GET">
      
      <?php
	 $movieOptions = "";
	 $directorOptions ="";
	 
	 $db_connection = mysql_connect("localhost", "cs143", "");
	 mysql_select_db("CS143", $db_connection);
	 
	 $query = "select * from Director order by first ASC";
	 $directors = mysql_query($query, $db_connection);
	 
	 while($row = mysql_fetch_row($directors))
	 {
         $id = $row['0'];
         $first = $row['2'];
         $last = $row['1'];
         $dob = $row['4'];
         $directorOptions.="<option value=\"$id\">".$first." ".$last." [".$dob."]</option>";
	 }
	 
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

      Movie:<select name="mid">
	<?=$movieOptions?>
      </select><br/>
      Director:<select name="did">
      <?=$directorOptions?>
      </select><br/>
      <input type="submit" value="Submit Link"/>
    </form>
    
    <?php
       
       $movie = $_GET["mid"];
       $director = $_GET["did"];

       if($movie=="" && $director=="")
       {
       //nothing
       }
       else if($movie=="" || $director=="")
       {
       echo "Please Fill Out Both Fields";
       }
       else
       {
       
       $query = "INSERT INTO MovieDirector VALUES('$movie', '$director')";
        
        $rs = mysql_query($query, $db_connection);
        echo "Success!";
       }


      mysql_close($db_connection);

       ?>
    
    
  </body>
</html>

