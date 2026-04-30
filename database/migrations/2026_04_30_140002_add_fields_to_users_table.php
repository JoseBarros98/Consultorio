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
            $table->string('first_name');
            $table->string('last_name_father')->nullable();
            $table->string('last_name_mother')->nullable();
            $table->string('ci')->unique();
            $table->string('ci_extension')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('phone')->nullable();
            $table->string('avatar')->nullable();
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('active')->default(true);

            $table->dropColumn('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name_father',
                'last_name_mother',
                'ci',
                'ci_extension',
                'birth_date',
                'phone',
                'avatar',
                'username',
                'password',
                'active'
            ]);
            $table->string('name');
        });
    }
};
