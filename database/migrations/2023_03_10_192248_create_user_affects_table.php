<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_affects', function (Blueprint $table) {
            $table->id();
            $table->integer('iUser');
            $table->integer('iNiv')->default(1);
            $table->integer('iDiv')->default(1);
            $table->integer('iServ')->nullable();
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
        Schema::dropIfExists('user_affects');
    }
};
