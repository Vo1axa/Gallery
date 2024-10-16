<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('albums', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default('Untitled Album'); // Nama Album
            $table->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade'); // Ralasi ke user
            $table->timestamps();
        });
    
        // Table pivot untuk hubungan many-to-many antara albums dan galleries
        Schema::create('album_gallery', function (Blueprint $table) {
            $table->id();
            $table->foreignId('album_id')->constrained()->onDelete('cascade');
            $table->foreignId('gallery_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('album_gallery');
        Schema::dropIfExists('albums');
    }
    
};
