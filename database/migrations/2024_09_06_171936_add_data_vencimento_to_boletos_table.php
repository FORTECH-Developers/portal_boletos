<?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        /**
         * Run the migrations.
         */
        public function up()
        {
            Schema::table('boletos', function (Blueprint $table) {
                $table->date('data_vencimento')->nullable(); // Adiciona a coluna de data de vencimento
            });
        }
        
        public function down()
        {
            Schema::table('boletos', function (Blueprint $table) {
                $table->dropColumn('data_vencimento');
            });
        }
    };        