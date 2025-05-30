<?php

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
        Schema::create('letter_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('letter_type_id')->constrained('letter_types')->onDelete('cascade');
            $table->string('nik');
            $table->string('address');
            $table->string('gender');
            $table->string('place_of_birth');
            $table->string('citizenship');
            $table->string('religion');
            $table->string('father_name');
            $table->string('mother_name');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('letter_requests');
    }
};
