<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   public function parent()
   {
   	return $this->belongsTo(Category::class,'parent_id');
   }

    public function posts()
   {
   	return $this->hasMany(Post::class);
   }

   /**
   *ParentorNotCategory
   *
   *check if the  category is  the child category of parent category
   *
   *@param int $parent_id
   *@param int $child_id
   */

   public static function ParentorNotCategory($parent_id,$child_id)
   {
      $categories=Category::where('id',$child_id)->where('parent_id',$parent_id)->get();
      if(!is_null( $categories))
      {
      	return true;
      }
      else{
      	return false;
      }
   }
}
