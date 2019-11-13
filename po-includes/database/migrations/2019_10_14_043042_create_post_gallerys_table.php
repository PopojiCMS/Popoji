<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostGallerysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_gallerys', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('post_id')->default('1');
			$table->string('title')->nullable();
			$table->string('picture')->nullable();
			$table->integer('created_by')->default('1');
			$table->integer('updated_by')->default('1');
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
        Schema::dropIfExists('post_gallerys');
    }
}
