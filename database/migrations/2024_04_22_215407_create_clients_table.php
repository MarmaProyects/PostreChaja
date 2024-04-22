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
        Schema::create('clients', function (Blueprint $table) { 
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->primary('user_id');
            $table->string('fullname'); 
            $table->string('address'); 
            $table->string('phone'); 
            $table->integer('stars')->default(0); 
            $table->text('notifications')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
