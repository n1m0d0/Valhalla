<?php

use App\Models\Patient;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname');
            $table->string('identity_card');
            $table->enum('issued', [
                'CH',
                'LP',
                'CB',
                'OR',
                'PT',
                'TJ',
                'SC',
                'BE',
                'PD'
            ]);
            $table->date('birthdate');
            $table->enum('sex', [
                Patient::Male,
                Patient::Female
            ]);
            $table->string('photo_path', 2048)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
