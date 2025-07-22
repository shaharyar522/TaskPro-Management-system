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
        Schema::create('userdata_cci', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id'); // From Auth::id()
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('master_order')->nullable();
            $table->text('job_notes')->nullable();

            $table->string('work_type')->nullable();
            $table->string('unit')->nullable();
            $table->integer('qty')->nullable();
            $table->decimal('w2')->nullable();

            $table->string('in')->nullable();   // Consider changing to time if needed
            $table->string('out')->nullable();  // Consider changing to time if needed
            $table->decimal('hours')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userdata_cci');
    }
};
