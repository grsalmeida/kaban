<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCardTeacherTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('card_teacher', function(Blueprint $table)
		{
			$table->foreign('id_card', 'fk_card_teacher_1')->references('id')->on('card')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_teacher', 'fk_card_teacher_2')->references('id')->on('teacher')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('card_teacher', function(Blueprint $table)
		{
			$table->dropForeign('fk_card_teacher_1');
			$table->dropForeign('fk_card_teacher_2');
		});
	}

}
