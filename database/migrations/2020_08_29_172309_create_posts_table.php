<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('description');
            $table->integer('weight');
            $table->integer('quantity')->default(1);
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('brand_id');
            $table->unsignedInteger('user_id');
            $table->string('user_phone_no');
            $table->string('user_email');

        $table->string('source_stoppage');
        $table->unsignedBigInteger('source_district_id');
        $table->unsignedBigInteger('source_division_id');
        $table->string('destination_stoppage');
        $table->unsignedBigInteger('destination_district_id');
        $table->unsignedBigInteger('destination_division_id');

        $table->string('slug');
        $table->integer('price');
        $table->tinyInteger('status')->default(0);
        $table->tinyInteger('is_urgent')->default(0)->comment('product delivery is urgent or not');
        $table->timestamps();

        $table->foreign('user_id')
        ->references('id')->on('users')
        ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
