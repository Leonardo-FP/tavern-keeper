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
        Schema::table('users', function (Blueprint $table) {
            $table->string('nickname')->after('password');

            $table->unsignedBigInteger('gender_id')->after('nickname')->nullable();
            $table->foreign('gender_id')->references('id')->on('genders');

            $table->unsignedBigInteger('icon_id')->after('gender_id')->nullable();
            $table->foreign('icon_id')->references('id')->on('icons');
            
            $table->boolean('status')->default(1)->after('updated_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['gender_id']);
            $table->dropColumn('gender_id');
            
            $table->dropForeign(['icon_id']);
            $table->dropColumn('icon_id');

            $table->dropColumn('nickname');

            $table->dropColumn('status');
        });
    }
};
