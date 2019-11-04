<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateClientsTable extends Migration {

	public function up()
	{
		Schema::create('clients', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->date('date_of_birth');
			$table->integer('blood_type_id');
			$table->date('last_donation_date');
			$table->integer('city_id');
			$table->string('phone')->unique();
			$table->string('password');
			$table->string('api_token')->unique()->nullable();
			$table->integer('pin_code')->nullable();
			$table->boolean('is_active')->default(1);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('clients');
	}
}
