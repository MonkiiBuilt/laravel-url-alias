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
            $table->string('system_path');
            $table->string('aliased_path');
            $table->enum('type', ['alias', 'permanent', 'temporary']);
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
