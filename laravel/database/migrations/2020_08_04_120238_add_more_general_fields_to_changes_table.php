<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreGeneralFieldsToChangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('changes', function (Blueprint $table) {
            //
            $table->text('justification')->nullable();
            $table->integer('factory');
            $table->integer('unit');
            $table->integer('system');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('changes', function (Blueprint $table) {
            //
            $table->dropColumn(['justification', 'factory', 'unit', 'system']);
        });
    }
}
