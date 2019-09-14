<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add5d7bf9a8d64b3RelationshipsToControlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('controls', function(Blueprint $table) {
            if (!Schema::hasColumn('controls', 'created_by_id')) {
                $table->integer('created_by_id')->unsigned()->nullable();
                $table->foreign('created_by_id', '337424_5d7b8f541654a')->references('id')->on('users')->onDelete('cascade');
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
        Schema::table('controls', function(Blueprint $table) {
            if(Schema::hasColumn('controls', 'created_by_id')) {
                $table->dropForeign('337424_5d7b8f541654a');
                $table->dropIndex('337424_5d7b8f541654a');
                $table->dropColumn('created_by_id');
            }
            
        });
    }
}
