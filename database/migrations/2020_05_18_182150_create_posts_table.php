<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
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
            $table->bigIncrements('id');
            $table->string('url')->index();
            $table->string('title');
            $table->text('content');
            $table->string('syntax');
            $table->string('expire');
            $table->string('status');
            $table->timestamp('published_at')->nullable();
            $table->integer('user_id')->unsigned();
           // $table->foreign('user_id')->references('id')->on('users');
            $table->softDeletes();
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
        Schema::dropIfExists('posts');
    }
}
