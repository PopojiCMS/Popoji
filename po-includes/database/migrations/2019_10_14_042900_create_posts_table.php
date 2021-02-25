<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
			$table->bigInteger('category_id')->default('1');
			$table->string('title')->nullable();
			$table->string('seotitle')->nullable();
			$table->text('content')->nullable();
			$table->text('meta_description')->nullable();
			$table->string('picture')->nullable();
			$table->string('picture_description')->nullable();
			$table->string('tag')->nullable();
			$table->enum('type', ['general', 'pagination', 'picture', 'video'])->default('general');
			$table->enum('active', ['Y', 'N'])->default('Y');
			$table->enum('headline', ['Y', 'N'])->default('Y');
			$table->enum('comment', ['Y', 'N'])->default('Y');
			$table->bigInteger('hits')->default('1');
			$table->bigInteger('created_by')->default('1');
			$table->bigInteger('updated_by')->default('1');
            $table->timestamps();
            $table->index(['title', 'seotitle']);
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
