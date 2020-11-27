<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function images()
    {
    	return $this->hasMany('App\Models\ProductImage');
    }
    public function category()
    {
    	return $this->belongsTo(Category::class);
    }
    public function user()
  {
    return $this->belongsTo(User::class);
  }

  public function district()
{
  return $this->belongsTo(District::class);
}



}
