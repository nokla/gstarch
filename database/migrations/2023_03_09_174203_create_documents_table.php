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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('sObjet');
            $table->string('sRef');
            $table->date('dDte');
            $table->integer('iAnne');
            $table->integer('iBy');
            $table->string('sFile');
            $table->string('sExt')->nullable();
            $table->string('sPath');
            $table->integer('iCaty');
            $table->integer('iArch')->nullable();
            $table->string('sTags')->nullable();
            $table->integer('iType')->default(1);
            $table->integer('iShare')->default(0);
            $table->integer('isVld')->default(1);
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
        Schema::dropIfExists('documents');
    }
};
