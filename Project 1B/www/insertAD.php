<html>
  <head>
    <title>Add New Actor/Director</title>
<center><h1>J&D's Movie Database</h1></center>
  </head>
<center>
  <table border="1">
    <tr>
      <th BGCOLOR="99FF99">
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
 <h4>Add New Actor/Director:</h4>
  <form action="./insertAD.php" method = "GET">
      Type:
      <input type="radio" name="type" value="Actor"
             <?php echo (htmlspecialchars($_GET['type'])=='Actor')?'checked':''?>>Actor
      <input type="radio" name="type" value="Director"
             <?php echo (htmlspecialchars($_GET['type'])=='Director')?'checked':''?>>Director
      <br/>
      First Name:
      <input type="text" name="first" maxlength="20" value="<?php echo htmlspecialchars($_GET['first']);?>">
      <br/>
      Last Name:
      <input type="text" name="last" maxlength="20" value="<?php echo htmlspecialchars($_GET['last']);?>">
      <br/>
      Sex:
      <input type="radio" name="sex" value="Male"
             <?php echo (htmlspecialchars($_GET['sex'])=='Male')?'checked':''?>>Male
      <input type="radio" name="sex" value="Female"
             <?php echo (htmlspecialchars($_GET['sex'])=='Female')?'checked':''?>>Female
      <br/>
      Date of Birth:
      <input type="text" name="dob" maxlength="10" value="<?php echo htmlspecialchars($_GET['dob']);?>">
      (YYYY-MM-DD)
      <br/>
      Date of Death:
      <input type="text" name="dod" maxlength="10" value="<?php echo htmlspecialchars($_GET['dod']);?>">
      (YYYY-MM-DD, if applicable)<br/>
      <br/>
      <input type="submit" value="Add Person"/>
    </form>


    <?php
       $db_connection = mysql_connect("localhost", "cs143", "");
       mysql_select_db("CS143", $db_connection);

       $type = $_GET["type"];
       $first = $_GET["first"];
       $last = $_GET["last"];
       $sex = $_GET["sex"];
       $dob = $_GET["dob"];
       $dod = $_GET["dod"];
 
       //find max person id
       $query = "select MAX(id) from MaxPersonID";
       $maxidrs = mysql_query($query, $db_connection);
       $row = mysql_fetch_array($maxidrs);
       $maxid = $row[0];
       $newid = $maxid + 1;


       //assemble!
       if($first == "" && $last == "" && $dob == "")
       {
       echo "Enter a New Person";
        //nothing
       }
       else
       {
       if($type == "Actor")
        {
         if($dod == "")
         {
          $query = "INSERT INTO Actor (id, last, first, sex, dob, dod)                                       
                    VALUES ('$newid', '$last', '$first', '$sex', '$dob', NULL);";
         }
         else
         {
          $query = "INSERT INTO Actor (id, last, first, sex, dob, dod)                                       
                    VALUES ('$newid', '$last', '$first', '$sex','$dob', '$dod');";
         }
        }
        else
        {
         if($dod == "")
         {
          $query = "INSERT INTO Director (id, last, first, dob, dod)                                         
                    VALUES ('$newid', '$last', '$first', '$dob', NULL);";
         }
         else
         {
          $query = "INSERT INTO Director (id, last, first, dob, dod)                                         
                    VALUES ('$newid', '$last', '$first', '$dob', '$dod');";
         }
        }

       $rs = mysql_query($query, $db_connection);
       //set to new value
        $query = "update MaxPersonID set id = $newid where id = $maxid";
        mysql_query($query, $db_connection);

        echo "New $type added (with id=$newid).";
       }

       mysql_close($db_connection);
       ?>
</body>
</html>
