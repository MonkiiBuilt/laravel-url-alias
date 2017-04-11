<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableUrlAlias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_alias', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();

            $table->string('path');
            $table->string('system_path')->nullable();
            $table->integer('aliasable_id')->unsigned()->nullable();
            $table->string('aliasable_type', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_alias');
    }
}
