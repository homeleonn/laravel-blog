<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_terms', function (Blueprint $table) {
            $table->bigInteger('term_id')->unsigned();
            $table->bigInteger('post_id')->unsigned();
            $table->timestamps();
            
            $table->unique(['term_id', 'post_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_terms');
    }
}
