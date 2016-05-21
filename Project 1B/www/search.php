
<html>
  <head><title>Search Page</title></head>
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
      <th BGCOLOR="99FF99">
        <a href="search.php">Search Movies/Actors</a>
        </th>
      </tr>
    </table>
  </center>

<body BGCOLOR="#FF9966">
 <h4>Search for Actor/Movie:</h4>
    <p>
      <form method = "GET">
	<textarea name="search" rows="1" cols="40"></textarea>
	
	<input type="submit" value="Search" />
      </form>
    </p>
    
    <?php       
       if($_GET["search"])
       {
       //get the data from the user
       $input_string = $_GET["search"];
       
       //connect to the host
       $db_connection = mysql_connect("localhost", "cs143", "");

       //choose the database
       mysql_select_db("CS143", $db_connection);

       //set up array that will check for the actors
       $actor_array = array();
       $temp = "";
       for($x = 0; $x < strlen($input_string); $x++)
	{
	//check if there are two spaces between a word
	if(substr($input_string, $x, 1) == " " && 
	   substr($input_string, $x + 1, 1) == " ")
	 continue;

	//if a space, add the word stored in temp to the array
	if(substr($input_string, $x, 1) == " ")
	 {
	 $actor_array[] = $temp;
	 $temp = "";
	 continue;
	 }

	$temp .= substr($input_string, $x, 1);
			
	//add last word
	if($x +1 == strlen($input_string))
	 {
	  $actor_array[] .= $temp;
          continue;
         }
	}
	
	//change input string
	$query = "select * from Actor where ";
	//print_r($actor_array);
	
	for($i = 0; $i < count($actor_array); $i++)
	{
	 if(($i+1) == count($actor_array))
	  {
	   $query = $query . "(first like '%" . $actor_array[$i] . 
		   "%' or last like '%" . $actor_array[$i] . "%')" ;
	  }
	 else
	  {
	   $query = $query . "(first like '%" . $actor_array[$i] .
                   "%' or last like '%" . $actor_array[$i] . "%') and ";
	  }
	}

	//echo $query;
	$query2 = "select * from Movie where title like '%" . $input_string . "%'";
	
        //get info from data base
	$movies = mysql_query($query2, $db_connection);
        $actors = mysql_query($query, $db_connection);

	//2nd column last, 3rd column first
	//2nd column title

       $z = 0;
       while($row = mysql_fetch_row($actors))
       {
	if($z == 0)
	{
	 echo "<br>Actors:<br>";
	 $z = 1;
	}

        echo "<a href=\"actor.php?ID=".$row['0']."\">".$row['2']." " .$row['1'].
		" (".$row['4'].")" ."</a>";
	echo "<br>";
       }

	$z = 0;
	while($row = mysql_fetch_row($movies))
        {
	 if($z == 0)
	 {       
          echo "<br>Movies:<br>";
	  $z = 1;
         }
	 echo "<a href=\"movie.php?ID=".$row['0']."\">".$row['1'].
			 " (".$row['2'].")"."</a>";
	 echo "<br>";
        }
			 


	mysql_close($db_connection);
	}
			

       ?>

  </body>
</html>
