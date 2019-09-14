<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Update1568378624ConsumptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consumptions', function (Blueprint $table) {
            if(Schema::hasColumn('consumptions', 'warning_date')) {
                $table->dropColumn('warning_date');
            }
            if(Schema::hasColumn('consumptions', 'type')) {
                $table->dropColumn('type');
            }
            
        });
Schema::table('consumptions', function (Blueprint $table) {
            
if (!Schema::hasColumn('consumptions', 'liters')) {
                $table->integer('liters')->nullable();
                }
if (!Schema::hasColumn('consumptions', 'cost')) {
                $table->integer('cost')->nullable();
                }
if (!Schema::hasColumn('consumptions', 'date')) {
                $table->date('date')->nullable();
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
        Schema::table('consumptions', function (Blueprint $table) {
            $table->dropColumn('liters');
            $table->dropColumn('cost');
            $table->dropColumn('date');
            
        });
Schema::table('consumptions', function (Blueprint $table) {
                        $table->date('warning_date')->nullable();
                $table->string('type')->nullable();
                
        });

    }
}
