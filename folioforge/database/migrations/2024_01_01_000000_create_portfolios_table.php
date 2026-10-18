<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('tagline')->nullable();
            $table->string('email');
            $table->string('phone', 50);
            $table->string('address');
            $table->text('about');
            $table->longText('photo')->nullable();
            $table->json('education')->nullable();
            $table->json('skills')->nullable();
            $table->json('projects')->nullable();
            $table->json('experience')->nullable();
            $table->json('links')->nullable();
            $table->unsignedTinyInteger('template')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
