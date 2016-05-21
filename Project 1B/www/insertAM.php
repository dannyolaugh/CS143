<html>
  <head>
    <title>Add New Actor/Movie</title>
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
      <th BGCOLOR="99FF99">
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


 <h4>Add Exsisting Actors to Movies:</h4>
  
  <form action="./insertAM.php" method = "GET">
    
    <?php
       $movieOptions = "";
       $actorOptions ="";
       
       $db_connection = mysql_connect("localhost", "cs143", "");
       mysql_select_db("CS143", $db_connection);
       
       $query = "select * from Actor order by first ASC";
       $actors = mysql_query($query, $db_connection);
       
       while($row = mysql_fetch_row($actors))
       {
        $id = $row['0'];
        $first = $row['2'];
        $last = $row['1'];
        $dob = $row['4'];
        $actorOptions.="<option value=\"$id\">".$first." ".$last." [".$dob."]</option>";
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
    Actor:<select name="aid">
      <?=$actorOptions?>
      </select><br/>
    Role:<input type="text" name="role" value="<?php echo htmlspecialchars($_GET['role']);?>" maxlength="50"><br/>
    <br/>
    <input type="submit" value="Submit Link"/>
    </form>
<?php
       
       $role = $_GET["role"];
       $movie = $_GET["mid"];
       $actor = $_GET["aid"];

       if($movie=="" || $actor=="")
       {
       //nothing
       }
       else
       {
        if($role == "")
        {
         $query = "INSERT INTO MovieActor VALUES('$movie', '$actor', NULL)";
        }
        else
        {
         $query= "INSERT INTO MovieActor VALUES('$movie', '$actor', '$role')";
        }
        $rs = mysql_query($query, $db_connection);
        echo "Success!";
       }


      mysql_close($db_connection);
       
       ?>

  </body>
</html>
