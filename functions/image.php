<?php
/*
Yes, randomly generated image, very simple code. 
If you use it please credit to fedekiller.
*/
header ("Content-type: image/gif");
$string = htmlspecialchars(strip_tags(stripslashes($_GET['code'])), ENT_QUOTES);
$image = @imagecreate (50,15) ;
$black = imagecolorallocate ($image, 0, 0, 0);
$white = imagecolorallocate ($image, 255, 255, 255);
imageline ($image, 0, 8.5, 50, 8.5, $white);
imagestring ($image, 2, 10, 1, $string, $white);
imagegif ($image);
imagedestroy ($image);
?>