<?php
session_start();

class cCaptcha {
 
	var $font = 'monofont.ttf';
	var $background_color = 'FFFFFF'; // hex string
	var $text_color = '003359'; // hex string
	var $noise_color = '64A0C8'; // hex string
	var $width = 130;
	var $height = 40;
	var $characters = 6;
	var $font_size;
	var $image_type = IMG_PNG;

	function cCaptcha() {
		$this->font_size = $this->height * 0.8;
	}

	function GenerateCode($characters) {
		$possible = '23456789bcdfghjkmnpqrstvwxyz'; // possible characters
		$code = '';
		$i = 0;
		while ($i < $characters) {
		   $code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
		   $i++;
		}
		return $code;
	}

	function HexToRGB($hexstr) {
		$int = hexdec($hexstr);
		return array("R" => 0xFF & ($int >> 0x10),
			"G" => 0xFF & ($int >> 0x8),
			"B" => 0xFF & $int);
	}

	function Show() {
		$code = $this->GenerateCode($this->characters);
		$image = imagecreate($this->width, $this->height) or die('Cannot initialize new GD image stream');
		$RGB = $this->HexToRGB($this->background_color);
		$background_color = imagecolorallocate($image, $RGB['R'], $RGB['G'], $RGB['B']);
		$RGB = $this->HexToRGB($this->text_color);
		$text_color = imagecolorallocate($image, $RGB['R'], $RGB['G'], $RGB['B']);
		$RGB = $this->HexToRGB($this->noise_color);
		$noise_color = imagecolorallocate($image, $RGB['R'], $RGB['G'], $RGB['B']);
		// generate random dots in background
		for( $i=0; $i<($this->width*$this->height)/3; $i++ ) {
		   imagefilledellipse($image, mt_rand(0,$this->width), mt_rand(0,$this->height), 1, 1, $noise_color);
		}
		// generate random lines in background
		for( $i=0; $i<($this->width*$this->height)/150; $i++ ) {
		   imageline($image, mt_rand(0,$this->width), mt_rand(0,$this->height), mt_rand(0,$this->width), mt_rand(0,$this->height), $noise_color);
		}
		// create textbox and add text
		$textbox = imagettfbbox($this->font_size, 0, $this->font, $code) or die('Error in imagettfbbox function');
		$x = ($this->width - $textbox[4])/2;
		$y = ($this->height - $textbox[5])/2;
		imagettftext($image, $this->font_size, 0, $x, $y, $text_color, $this->font , $code) or die('Error in imagettftext function');
		// output captcha image to browser
		switch($this->image_type) {
      case IMG_JPG:
        header("Content-Type: image/jpeg");
        imagejpeg($image, null, 90);
        break;
      case IMG_GIF:
        header("Content-Type: image/gif");
        imagegif($image);
        break;
      default: // PNG
        header("Content-Type: image/png");
        imagepng($image);
        break;
    }
		imagedestroy($image);
		$_SESSION["EW_CAPTCHA_CODE"] = $code;
	}
}

$captcha = new cCaptcha();
$captcha->Show();
?>