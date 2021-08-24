<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commentables', function (Blueprint $table) {
            $table->text('content')->nullable(false);
            $table->integer('commentable_id')->nullable(false);
            $table->string('commentable_type')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique(['user_id', 'commentable_id', 'commentable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentables');
    }
}
