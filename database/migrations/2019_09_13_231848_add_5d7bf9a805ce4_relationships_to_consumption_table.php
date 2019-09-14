<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d7bf9a805ce4RelationshipsToConsumptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumptions', function(Blueprint $table) {
            if (!Schema::hasColumn('consumptions', 'control_id')) {
                $table->integer('control_id')->unsigned()->nullable();
                $table->foreign('control_id', '337422_5d7bf9a1163bc')->references('id')->on('controls')->onDelete('cascade');
                }
                
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consumptions', function(Blueprint $table) {
            
        });
    }
}
