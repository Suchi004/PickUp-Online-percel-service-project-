<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use willvincent\Rateable\Rateable;

class User extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name','last_name','username','phone_no','division_id','district_id','street_address','ip_address','remember_token', 'email','status', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function districts()
  {
    return $this->belongsTo(District::class);
  }
    public function divisions()
  {
    return $this->belongsTo(Division::class);
  }

  public function reviews()
{
  return $this->hasMany(UserReview::class);
}

public function getStarRating(){
     $count=$this->reviews()->count();
     if(empty($count)){
       return 0;
     }else{
     $starCount=$this->reviews()->sum('rating');
     $average=$starCount/ $count;
     return $average;
   }

}


}
