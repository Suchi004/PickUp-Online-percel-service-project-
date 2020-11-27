<?php
namespace App\Helpers;
/**
*ImageHelper Class
*/
use App\Models\User;
use App\Helpers\GravatarHelper;
class ImageHelper
{
	public static function getUserIamge($id)
	{
      $user=User::find($id);
      $avatar_url="";
      if(!is_null($user)){
      	if($user->avatar==NULL){
      		//return him gravatar image
      		if(GravatarHelper::validate_garavatar($user->email)){
              $avatar_url=GravatarHelper::gravatar_image($user->email,100);
      		}
      		else{
      			//when there is no garavatar image
      			$avatar_url=url('images/defaults/icon.png');
      		}
      	}
      	else{
      		//return that image
      		$avatar_url=url('images/users/'.$user->avatar);
      	}

      }
      else{
      	//return redirect()
      }
      return $avatar_url;
	}
}
