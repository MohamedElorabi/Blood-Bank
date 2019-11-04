<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->string('patient_name');
			$table->string('age');
			$table->integer('blood_type_id');
			$table->integer('bags_num');
			$table->string('hospital_name');
			$table->integer('city_id');
			$table->decimal('longitude', 10,8);
			$table->decimal('latituede', 10,8);
			$table->string('phone');
			$table->string('notes');
			$table->string('client_id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
