<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('username')->unique();
            $table->string('phone_no')->unique();
            $table->string('email')->unique();

            $table->string('street_address');
            $table->unsignedInteger('division_id')->comment('Division Table Id');
            $table->unsignedInteger('district_id')->comment('District Table Id');
            $table->timestamp('email_verified_at')->nullable();
            
             $table->unsignedTinyInteger('status')->comment('0=inactive|1=active|2=ban')->default('0');
            $table->string('ip_address')->nullable();
            $table->string('avatar')->nullable();
            $table->string('shipping_address')->nullable();
            
 
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
  
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
