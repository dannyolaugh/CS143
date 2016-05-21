<html>
  <head>
    <title>Add New Movie</title>
<center><h1>J&D's Movie Database</h1></center>
  </head>
<center>
  <table border="1">
    <tr>
      <th BGCOLOR="FFFF99">
        <a href="insertAD.php">Insert New Actor/Director</a>
        </th>
      <th BGCOLOR="99FF99">
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
    <h4>Add New Movie:</h4>
    <form action="./insertM.php" method="GET">
      Title:
      <input type="text" name="title" maxlength="20" value="<?php echo htmlspecialchars($_GET['title']);?>">
      <br/>
      Company:
      <input type="text" name="company" maxlength="50" value="<?php echo htmlspecialchars($_GET['company']);?>">
      <br/>
      Year: 
      <input type="text" name="year" maxlength="4" value="<?php echo htmlspecialchars($_GET['year']);?>">
      <br/>
      MPAA Rating: <select name="mpaarating">
	<option value="G" <?php echo (htmlspecialchars($_GET['mpaarating'])=='G')?'selected':''?>>G</option>
	<option value="NC-17" <?php echo (htmlspecialchars($_GET['mpaarating'])=='NC-17')?'selected':''?>>NC-17</option>
	<option value="PG" <?php echo (htmlspecialchars($_GET['mpaarating'])=='PG')?'selected':''?>>PG</option>
	<option value="PG-13" <?php echo (htmlspecialchars($_GET['mpaarating'])=='PG-13')?'selected':''?>>PG-13</option>
	<option value="R" <?php echo (htmlspecialchars($_GET['mpaarating'])=='R')?'selected':''?>>R</option>
		</select><br/>
      Genre:
      <table border="0" style="width:600px">
	<tr>
	  <td><input type="checkbox" name="genre[]" value="Action">Action</input></td>
	  <td><input type="checkbox" name="genre[]" value="Adult">Adult</input></td>
	  <td><input type="checkbox" name="genre[]" value="Adventure">Adventure</input></td>
	  <td><input type="checkbox" name="genre[]" value="Animation">Animation</input></td>
	  <td><input type="checkbox" name="genre[]" value="Comedy">Comedy</input></td>
	</tr>
	<tr>
	  <td><input type="checkbox" name="genre[]" value="Crime">Crime</input></td>
	  <td><input type="checkbox" name="genre[]" value="Documentary">Documentary</input</td>
	  <td><input type="checkbox" name="genre[]" value="Drama">Drama</input></td>
	  <td><input type="checkbox" name="genre[]" value="Family">Family</input></td>
	  <td><input type="checkbox" name="genre[]" value="Fantasy">Fantasy</input></td>
	</tr>
	<tr>
	  <td><input type="checkbox" name="genre[]" value="Horror">Horror</input></td>
	  <td><input type="checkbox" name="genre[]" value="Musical">Musical</input></td>
	  <td><input type="checkbox" name="genre[]" value="Mystery">Mystery</input></td>
	  <td><input type="checkbox" name="genre[]" value="Romance">Romance</input></td>
	  <td><input type="checkbox" name="genre[]" value="Sci-Fi">Sci-Fi</input></td>
	  </tr>
	<tr>
	  <td><input type="checkbox" name="genre[]" value="Short">Short</input></td>
	  <td><input type="checkbox" name="genre[]" value="Thriller">Thriller</input></td>
	  <td><input type="checkbox" name="genre[]" value="War">War</input></td>
	  <td><input type="checkbox" name="genre[]" value="Western">Western</input></td>
	  </tr>
	</table> 

      <br/>
      <input type="submit" value="Add Movie"/>
    </form>    
    <?php
       $db_connection = mysql_connect("localhost", "cs143", "");
       mysql_select_db("CS143", $db_connection);
       
       $title = $_GET["title"];
       $rating = $_GET["mpaarating"];
       $company = $_GET["company"];
       $year = $_GET["year"];
       $genreArr = $_GET["genre"];

       $query = "select MAX(id) from MaxMovieID";
       $maxidrs = mysql_query($query, $db_connection);
       $row = mysql_fetch_array($maxidrs);
       $maxid = $row[0];
       $newid = $maxid + 1;
	 
       if($title =="")
       {
       echo "Enter a New Movie";
       }
       else if(!is_numeric($year))
       {
       echo "Year Needs to be a Number";
       }
       else
       {
       $query = "INSERT INTO Movie VALUES ( $newid, '$title', $year, '$rating', '$company')";
       $rs = mysql_query($query, $db_connection);
       //set to new value
       $query = "update MaxMovieID set id = $newid where id = $maxid";
       mysql_query($query, $db_connection);
       
       foreach($genreArr as $genre)
       {
       $query ="INSERT INTO MovieGenre VALUES ($newid, '$genre')";
       mysql_query($query, $db_connection);
       }


       echo "New Movie added (with id=$newid).";
       }
       ?>

    
    
  </body>
</html>
