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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();           //primary key
            // An option to the one below $table->integer('user_id')->unsigned()->index();  //foreign key?? how does it know it's a foreign key, Index for speed in the db
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  //foreign key from user table, Id column, Cascade: when A user is deleted his posts are deleted too
            $table->text('body');
            $table->timestamps();       //gives us created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
