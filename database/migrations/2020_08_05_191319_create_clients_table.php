<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('phone');
			$table->string('password');
			$table->string('email');
			$table->string('name');
			$table->date('dop');
			$table->integer('blood_type_id')->unsigned();
			$table->date('last_donation_date');
			$table->integer('pin_code');
			$table->integer('city_id')->unsigned();
			$table->integer('governorate_id')->unsigned();
            $table->tinyInteger('status');

        });
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
