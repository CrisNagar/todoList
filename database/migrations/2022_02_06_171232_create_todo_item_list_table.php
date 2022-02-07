<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodoItemListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('task_id');
            $table->string('title');
            $table->boolean('isFinished')->default(false);
            $table->boolean('php')->default(false);
            $table->boolean('js')->default(false);
            $table->boolean('css')->default(false);
            $table->timestamps();

            $table->index(['id', 'task_id', 'title']);
            $table->foreign('task_id')->references('id')->on('tasks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todo_item_list');
    }
}
