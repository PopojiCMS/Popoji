<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('title')->nullable();
			$table->string('seotitle')->nullable();
			$table->text('content')->nullable();
			$table->string('picture')->nullable();
			$table->enum('active', ['Y', 'N'])->default('Y');
			$table->bigInteger('created_by')->default('1');
			$table->bigInteger('updated_by')->default('1');
            $table->index(['title', 'seotitle']);
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
        Schema::dropIfExists('pages');
    }
}
