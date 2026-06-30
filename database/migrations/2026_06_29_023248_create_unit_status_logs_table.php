<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('unit_status_logs', function (Blueprint $table) {

            $table->id();
            $table->foreignId('unit_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('project_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('activity_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();
            $table->enum('status',[

                'ON',
                'BD',
                'STB READY',
                'STS NO OP',
                'NO INFO'

            ]);
            $table->string('position')
                  ->nullable();
            $table->datetime('start_bd')
                  ->nullable();
            $table->text('note')
                  ->nullable();
            $table->foreignId('updated_by')
                  ->constrained('users');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('unit_status_logs');
    }

};