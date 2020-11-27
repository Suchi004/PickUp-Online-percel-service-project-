<?php
namespace App\Helpers;
/*
*Gravatar Helper
*/
class GravatarHelper
{

/*
*validate Gravatar
*
*Check if the email has any gravatar image or not
* @param string $email Email of the user
* @return boolean true,if there is an image.false otherwise
*/
   public static function validate_garavatar($email)
   {
   	$hash=md5($email);
   	$url='http://www.gravatar.com./avatar/' .$hash.'?d=404';
   	$headers=@get_headers($url);
   	if(!preg_match("|200|", $headers[0])){
   		$has_valid_avatar=FALSE;
   	}
   	else{
   		$has_valid_avatar=TRUE;
   	}
   	return $has_valid_avatar;
   }

 /*
*Gravater image
*
*get the gravatar Image From an email address
* @param string $email   user Email
* @param integer $size size of image
* @param string $d type of image if not gravatar image
* @return string gravatar image url
*/

 public static function gravatar_image($email,$size=0,$d="")
 {
   $hash =md5($email);
   $image_url='http://www.gravatar.com/avatar/'.$hash.'?s='.$size.'&d='.$d;
   return $image_url;
 }


}
