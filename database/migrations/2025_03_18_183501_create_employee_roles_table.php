<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('employee_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // Populate with common roles in coffee agriculture
        DB::table('employee_roles')->insert([
            ['name' => 'Gerente de Fazenda'],
            ['name' => 'Trabalhador Agrícola'],
            ['name' => 'Operador de Máquinas'],
            ['name' => 'Técnico de Irrigação'],
            ['name' => 'Colhedor'],
            ['name' => 'Supervisor de Plantio'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('employee_roles');
    }
};