<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->foreignId('equipment_category_id')
                  ->constrained()
                  ->cascadeOnDelete();
            $table->string('unit_code');
            $table->enum('current_status',[

                'ON',
                'BD',
                'STB READY',
                'STS NO OP',
                'NO INFO'

            ])
            ->default('NO INFO');
            $table->foreignId('current_activity_id')
                  ->nullable()
                  ->constrained('activities')
                  ->nullOnDelete();
            $table->string('current_position')
                  ->nullable();
            $table->foreignId('last_updated_by')
                  ->nullable()
                  ->constrained('users')
                  ->nullOnDelete();
            $table->timestamp('last_updated_at')
                  ->nullable();
            $table->boolean('is_active')
                  ->default(true);
            $table->timestamps();
        });

    }
    public function down(): void
    {
        Schema::dropIfExists('units');
    }

};