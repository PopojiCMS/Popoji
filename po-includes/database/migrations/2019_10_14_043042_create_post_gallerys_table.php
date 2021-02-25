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
            $table->bigIncrements('id');
			$table->bigInteger('post_id')->default('1');
			$table->string('title')->nullable();
			$table->string('picture')->nullable();
			$table->bigInteger('created_by')->default('1');
			$table->bigInteger('updated_by')->default('1');
            $table->timestamps();
            $table->index(['post_id']);
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
