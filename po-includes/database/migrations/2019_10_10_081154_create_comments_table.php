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
            $table->bigIncrements('id');
			$table->bigInteger('parent')->default('0');
			$table->bigInteger('post_id')->nullable();
			$table->string('name')->nullable();
			$table->string('email')->nullable();
			$table->text('content')->nullable();
			$table->enum('active', ['Y', 'N'])->default('N');
			$table->enum('status', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('comments');
    }
}
