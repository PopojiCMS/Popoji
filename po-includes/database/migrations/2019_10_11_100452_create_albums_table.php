<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('title')->nullable();
			$table->string('seotitle')->nullable();
			$table->enum('active', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('albums');
    }
}
