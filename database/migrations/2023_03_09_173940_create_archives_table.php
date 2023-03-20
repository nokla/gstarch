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
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->string('sTyp', 1);
            $table->string('sNiv', 1);
            $table->integer('vid');
            $table->string('sToken');
            $table->string('sNom');
            $table->string('sPath')->nullable();
            $table->integer('iShare')->default(0);
            $table->integer('iby')->default(0);
            $table->boolean('isVld')->default(1);
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
        Schema::dropIfExists('archives');
    }
};
