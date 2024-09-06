<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssociadosTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('associados', function (Blueprint $table) {
            $table->id(); 
            $table->string('nome');  
            $table->string('cpf')->unique(); 
            $table->string('email')->unique();  
            $table->string('password');  
            $table->string('sexo')->default('M');  
            $table->date('data_nascimento')->nullable();  
            $table->string('rg_associado')->nullable(); 
            $table->string('telefone_celular')->nullable();  
            $table->timestamps();  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('associados');
    }
}

