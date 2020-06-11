<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('cost_price');
            $table->timestamps();
        });

        Schema::create('pizza_ingredients', function(Blueprint $table)
        {
            $table->unsignedBigInteger('pizza_id')->primary();
            $table->unsignedBigInteger('ingredient_id');
            $table->integer('sort')->default(0);

            $table->index(['sort']);

            $table->foreign('pizza_id')->references('id')->on('pizzas')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('ingredient_id')->references('id')->on('ingredients')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pizza_ingredients', function (Blueprint $table) {
            $table->dropForeign(['ingredient_id']);
            $table->dropForeign(['pizza_id']);
        });
        Schema::dropIfExists('ingredients');
        Schema::dropIfExists('pizza_ingredients');
    }
}
