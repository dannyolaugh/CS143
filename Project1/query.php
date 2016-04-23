
<html>
  <head><title>CS143 Project 1A</title></head>
  <body>
    Type an SQL query:
    <p>
      <form method = "GET">
	<textarea name="query" rows="10" cols="80"></textarea>
	
	<input type="submit" value="Submit" />
      </form>
    </p>
    
    <?php       
       if($_GET["query"])
       {
       //get the data from the user
       $input_string = $_GET["query"];

       //connect to the host
       $db_connection = mysql_connect("localhost", "cs143", "");

       //choose the database
       mysql_select_db("CS143", $db_connection);

       //get info from data base
       $rs = mysql_query($input_string, $db_connection);

       $i=0;
       echo '<table border=1 cellspacing=2 cellpadding=2><tr>';
       while($i < mysql_num_fields($rs))
                  {
                  $field = mysql_fetch_field($rs, $i);
                  echo '<td><b>' . $field->name . '</b></td>';
       $i = $i + 1;
       }
       echo '<tr>';

       $a = 0;
       while($row = mysql_fetch_row($rs))
       {
       for($a=0; $a<$i; $a++)
                      {
                      if($row[$a] == NULL)
                      {
                      echo '<td>N/A</td>';
                      }
                      else
                         {
                      echo '<td>' . $row[$a] . '</td>';
                      }
                      }
                      echo '</td><tr>';
                      }
                      echo '</tr></table>';
                      mysql_close($db_connection);
                      }
       
       ?>

  </body>
</html>
