<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
  public function up()
  {
    Schema::create('comments', function (Blueprint $table) {
      $table->increments('id');
      $table->integer('user_id');
      $table->integer('content_id');
      $table->string('comment');
      $table->timestamps();

      $table
        ->foreign('content_id')
        ->references('id')
        ->on('contents')
        ->onDelete('cascade'); 
    });
  }

  public function down()
  {
    Schema::dropIfExists('comments');
  }
}
