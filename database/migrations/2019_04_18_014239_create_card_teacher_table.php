<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card_teacher', function(Blueprint $table)
		{
			$table->integer('id_card')->unsigned()->index('fk_card_teacher_1_idx');
			$table->integer('id_teacher')->unsigned()->index('fk_card_teacher_2_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('card_teacher');
	}

}
