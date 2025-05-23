<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCourierPaymentTypesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courier_payment_types', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name_en');
			$table->string('name_az');
			$table->string('name_ru');
			$table->integer('created_by')->nullable();
			$table->timestamps();
			$table->softDeletes();
			$table->integer('deleted_by')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courier_payment_types');
	}

}
