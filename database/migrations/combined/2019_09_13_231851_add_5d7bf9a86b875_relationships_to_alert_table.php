<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d7bf9a86b875RelationshipsToAlertTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerts', function(Blueprint $table) {
            if (!Schema::hasColumn('alerts', 'controller_id')) {
                $table->integer('controller_id')->unsigned()->nullable();
                $table->foreign('controller_id', '337423_5d7b8fdcd8fa9')->references('id')->on('controls')->onDelete('cascade');
                }
                if (!Schema::hasColumn('alerts', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '337423_5d7b8e89902df')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('alerts', function(Blueprint $table) {
            if(Schema::hasColumn('alerts', 'controller_id')) {
                $table->dropForeign('337423_5d7b8fdcd8fa9');
                $table->dropIndex('337423_5d7b8fdcd8fa9');
                $table->dropColumn('controller_id');
            }
            if(Schema::hasColumn('alerts', 'created_by_id')) {
                $table->dropForeign('337423_5d7b8e89902df');
                $table->dropIndex('337423_5d7b8e89902df');
                $table->dropColumn('created_by_id');
            }
            
        });
    }
}
