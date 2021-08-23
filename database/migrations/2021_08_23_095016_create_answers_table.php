<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->text('content')->nullable(false);
            $table->integer('votes_count')->default(0);
            $table->boolean('status')->default(true);
            $table->boolean('confirm')->default(false);
            $table->integer('question_id')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->timestamps();

            // Add foreign key
            $table->foreign('question_id')->references('id')->on('questions')
            ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')
            ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('answers', function (Blueprint $table) {
            $table->dropForeign(['question_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('answers');
    }
}
