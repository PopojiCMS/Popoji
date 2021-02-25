<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('title')->nullable();
			$table->string('seotitle')->nullable();
			$table->bigInteger('count')->default('1');
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
        Schema::dropIfExists('tags');
    }
}
