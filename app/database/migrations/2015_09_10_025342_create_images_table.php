<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('images', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('path')->unique();
            $table->string('title');
            $table->integer('category_id');
            $table->integer('album_id');
            $table->integer('count_share');
            $table->integer('count_like');
            $table->integer('count_unlike');
            $table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('images');
	}

}
