<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('parent')->default('0');
			$table->integer('post_id')->nullable();
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->text('content')->nullable();
			$table->enum('active', ['Y', 'N'])->default('N');
			$table->enum('status', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('comments');
    }
}
