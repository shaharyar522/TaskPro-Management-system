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
        Schema::create('userdata_frontier', function (Blueprint $table) {
            $table->id();  

            $table->string('corp_id')->nullable();
            $table->string('address')->nullable();
            $table->string('billing_TN')->nullable();
            $table->string('order_number')->nullable();
            $table->string('install_T_T_Soc_TTC')->nullable();
            $table->string('ont_Ntd')->nullable();
            $table->string('comp_or_refer')->nullable();
            $table->string('billing_code')->nullable();

            $table->integer('qty')->nullable();
            $table->string('description')->nullable();
            $table->string('rate')->nullable();
            $table->string('total_billed')->nullable();

            $table->string('aerial_buried')->nullable();
            $table->string('fiber')->nullable();
            $table->string('closeout_notes')->nullable();

            $table->string('in')->nullable();
            $table->string('out')->nullable();
            $table->integer('hours')->nullable();

            // Foreign key to users table
             $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_data');
    }
};
