<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoteablesTable extends Migration
{
    public function up()
    {
        Schema::create('voteables', function (Blueprint $table) {
            $table->integer('voteable_id')->nullable(false);
            $table->string('voteable_type')->nullable(false);
            $table->integer('user_id')->nullable(false);
            $table->integer('up_vote');
            $table->integer('down_vote');
            $table->timestamps();
            $table->unique(['user_id', 'voteable_id', 'voteable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('voteables');
    }
}
