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
        Schema::create('arch_docs', function (Blueprint $table) {
            $table->id();
            $table->integer('idArch');
            $table->integer('idDoc');
            $table->string('sToken');
            $table->integer('iShare');
            $table->integer('iBy');
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
        Schema::dropIfExists('arch_docs');
    }
};
