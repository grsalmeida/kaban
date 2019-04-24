<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_files', function(Blueprint $table)
		{
			$table->integer('id_card')->unsigned()->unique('id_card_UNIQUE');
			$table->integer('id_files')->unsigned()->unique('id_files_UNIQUE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('card_files');
	}

}
