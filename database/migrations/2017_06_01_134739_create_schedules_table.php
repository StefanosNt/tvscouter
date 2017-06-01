<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->increments('id'); 
			$table->integer('user_id');		 
			$table->integer('series_id');		 
            $table->string('series_name');
            $table->text('series_poster');	 
			$table->string('series_network');	 
			$table->string('series_genre');		 
			$table->integer('season_number');		 
			$table->integer('episode_number');	 
			$table->string('episode_name');		 
			$table->text('episode_overview');	 
			$table->date('air_date');			 
			$table->date('updated');
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
        Schema::dropIfExists('schedules');
    }
}
