<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('card', function(Blueprint $table)
		{
			$table->foreign('id_course', 'fk_card_1')->references('id')->on('course')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_discipline', 'fk_card_2')->references('id')->on('discipline')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('card', function(Blueprint $table)
		{
			$table->dropForeign('fk_card_1');
			$table->dropForeign('fk_card_2');
		});
	}

}
