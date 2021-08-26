<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('questions', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');
            $table->unsignedInteger('views')->default(0);
            $table->unsignedInteger('answers')->default(0);
            $table->integer('up_vote')->default(0);
            $table->integer('down_vote')->default(0);
            $table->unsignedInteger('best_answer_id')->nullable(true);
            $table->integer('user_id');
            $table->integer('tag_id');
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            // Add foreign key and delete cascade
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('questions');
    }
}
