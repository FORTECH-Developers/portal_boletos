<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletosTable extends Migration
{
    public function up()
    {
        Schema::create('boletos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_associado');
            $table->date('data_emissao');
            $table->decimal('valor', 10, 2);
            $table->string('status');
            $table->string('link_download');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('boletos');
    }
}
