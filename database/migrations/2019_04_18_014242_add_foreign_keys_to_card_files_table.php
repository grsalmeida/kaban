<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToCardFilesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('card_files', function(Blueprint $table)
		{
			$table->foreign('id_card', 'fk_card_files_1')->references('id')->on('card')->onUpdate('NO ACTION')->onDelete('NO ACTION');
			$table->foreign('id_files', 'fk_card_files_2')->references('id')->on('file')->onUpdate('NO ACTION')->onDelete('NO ACTION');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('card_files', function(Blueprint $table)
		{
			$table->dropForeign('fk_card_files_1');
			$table->dropForeign('fk_card_files_2');
		});
	}

}
