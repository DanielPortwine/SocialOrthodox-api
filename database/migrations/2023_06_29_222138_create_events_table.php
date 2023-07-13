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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->string('description');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->foreignId('parish_id')->nullable()->constrained();
            $table->string('location');
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('website')->nullable();
            $table->integer('capacity')->nullable();
            $table->dateTime('registration_start')->nullable();
            $table->dateTime('registration_end')->nullable();
            $table->string('registration_link')->nullable();
            $table->integer('price')->nullable();
            $table->enum('visibility', ['public', 'private', 'link'])->default('private');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
