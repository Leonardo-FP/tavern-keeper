<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('board_user', function (Blueprint $table) {
            $table->id();

            $table->foreignId('board_id')
                  ->constrained('boards')
                  ->onDelete('cascade');

            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade');

            $table->boolean('is_admin')->default(false);

            $table->timestamps();

            // evita duplicar o mesmo user duas vezes na mesma board
            $table->unique(['board_id', 'user_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('board_user');
    }
};