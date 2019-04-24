<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCardTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('card', function(Blueprint $table)
		{
			$table->increments('id');
			$table->smallInteger('type')->unsigned()->default(1)->comment('1- aula regular
2- aula livre');
			$table->smallInteger('educational_material')->comment('1-apostila
2-video
3-ambos');
			$table->date('year')->default(2019);
			$table->smallInteger('status')->default(1)->comment('1-demanda
2- material recebido
3 -para conferencia
4 - conferodp
0- inativo	');
			$table->integer('id_course')->unsigned()->index('fk_card_1_idx');
			$table->integer('id_discipline')->unsigned()->index('fk_card_2_idx');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('card');
	}

}
