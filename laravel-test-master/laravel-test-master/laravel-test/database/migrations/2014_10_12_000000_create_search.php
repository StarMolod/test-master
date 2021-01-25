<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSearch extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('search_results', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->timestamps();
        });

        Schema::create('search_rows', function (Blueprint $table) {
            $table->id();
            $table->string('link');
            $table->json('words')->nullable();
            $table->foreignId('search_result_id');

            $table->foreign('search_result_id')->references('id')
                ->on('search_results')->onDelete('CASCADE');

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
        Schema::dropIfExists('search_rows');
        Schema::dropIfExists('search_results');
    }
}
