<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->text('notification_setting_text');
			$table->string('about_app');
			$table->string('long_desc');
			$table->string('short_desc');
			$table->string('phone');
			$table->string('email');
			$table->string('fb_url');
			$table->string('tw_url');
			$table->string('youtube_url');
			$table->string('insta_url');
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
