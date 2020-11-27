<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    public function division()
     {
         return $this->belongsTo('App\Models\Division');
     }

     public function user()
      {
          return $this->hasMany('App\Models\User');
      }
}
