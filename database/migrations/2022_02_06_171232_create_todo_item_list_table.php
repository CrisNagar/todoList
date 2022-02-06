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
        Schema::create('todo_item_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('users_todolist_id');
            $table->string('title');
            $table->boolean('isFinished')->default(false);
            $table->timestamps();

            $table->index(['id', 'users_todolist_id', 'title']);
            $table->foreign('users_todolist_id')->references('id')->on('users_todolist');
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
