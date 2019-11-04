<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSettingsTable extends Migration {

	public function up()
	{
		Schema::create('settings', function(Blueprint $table) {
			$table->increments('id');
			$table->string('logo')->nullable();
			$table->string('phone')->nullable();
			$table->string('email')->unique()->nullable();
			$table->string('fb_url')->nullable();
			$table->string('tw_url')->nullable();
			$table->string('yt_url')->nullable();
			$table->string('ins_url')->nullable();
			$table->string('wa_url')->nullable();
			$table->string('go_url')->nullable();
			$table->longText('about')->nullable();
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('settings');
	}
}
