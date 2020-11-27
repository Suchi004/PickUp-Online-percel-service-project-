<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserReview extends Model
{
    protected $fillable=['headline','description','rating','user_id'];
}
