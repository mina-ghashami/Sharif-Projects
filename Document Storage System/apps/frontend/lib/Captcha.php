<?php
class Captcha{
	
	public $red;
	public $green;
	public $blue;
	public $width;
	public $height;
	public $string;
	
	public function randomColor(){
		// generate random color
		$this->red = rand(0,255);
		$this->green = rand(0,255);
		$this->blue = rand(0,255);
	}
	
	public function randomLines($im){
		// generate random lines
		$this->randomColor();
		$line_color = imagecolorallocate($im, $this->red, $this->green, $this->blue);
		for($i = 0; $i < 30; $i++) {
		    $rand_x_1 = rand(0, $this->width - 1);
		    $rand_x_2 = rand(0, $this->width - 1);
		    $rand_y_1 = rand(0, $this->height - 1);
		    $rand_y_2 = rand(0, $this->height - 1);
		    imageline($im, $rand_x_1, $rand_y_1, $rand_x_2, $rand_y_2, $line_color);
		}
	}
	
	public function randomString(){
		// generate random string
		$len = 5;
		$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
		$this->string = '';
		for ($i = 0; $i < $len; $i++) {
		    $pos = rand(0, strlen($chars)-1);
		    $this->string .= $chars{$pos};
		}
	}
	
	public function grid($im){
		// grid
		$grid_color = imagecolorallocate($im, $this->red, $this->green, $this->blue);
		$number_to_loop = ceil($this->width / 20);
		for($i = 0; $i < $number_to_loop; $i++) {
		    $x = ($i + 1) * 20;
		    imageline($im, $x, 0, $x, $this->height, $grid_color);
		}
		$number_to_loop = ceil($this->height / 10);
		for($i = 0; $i < $number_to_loop; $i++) {
		    $y = ($i + 1) * 10;
		    imageline($im, 0, $y, $this->width, $y, $grid_color);
		}
	}
	
	public function createCaptcha(){
		header ("Content-type', 'image/jpeg");
		//session_start();
		$this->width = 140;
		$this->height = 70;
		$im = imagecreate($this->width, $this->height);
		$this->randomColor();
		$bg = imagecolorallocate($im, $this->red, $this->green, $this->blue);
		// generate random string
		$this->randomString();
		$_SESSION['captcha_code'] = md5($this->string);
		
		// grid
		$this->grid($im);
		
		// random lines
		$this->randomLines($im);
		
		// write the text
		$text_color = imagecolorallocate($im, 255, 0, 0);
		$rand_x = rand(0, $this->width - 50);
		$rand_y = rand(0, $this->height - 15);
		imagestring($im, 10, $rand_x, $rand_y, $this->string, $text_color);
		
		return $im;
		
		//imagepng($im,"c:/".$this->string.".jpg");
		
	}
}
?> 