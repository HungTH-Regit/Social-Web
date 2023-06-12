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
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained("users");
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
         // Schema::table('password_reset_tokens', function (Blueprint $table) {
        //     $table->dropForeign('password_reset_tokens_users_id_foreign	');

        //     $table->dropColumn('users_id');
        // });
    }
};