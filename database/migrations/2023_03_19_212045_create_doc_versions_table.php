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
        Schema::create('doc_versions', function (Blueprint $table) {
            $table->id();
            $table->integer('iDoc');
            $table->string('sNomOld')->nullable();
            $table->string('sNomNew')->nullable();
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
        Schema::dropIfExists('doc_versions');
    }
};
