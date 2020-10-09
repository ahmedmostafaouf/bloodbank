<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientables', function(Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('client_id');
            $table->integer('is_read')->default(0);
            $table->integer('clientable_id');
            $table->string('clientable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
