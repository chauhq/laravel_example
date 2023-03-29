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
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::table('tasks', function (Blueprint $table) {
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop columns users
        if (Schema::hasColumn('users', 'created_at')) {
            Schema::dropColumns('users', 'created_at');
        }
        if (Schema::hasColumn('users', 'updated_at')) {
            Schema::dropColumns('users', 'updated_at');
        }

        // Drop columns tasks
        if (Schema::hasColumn('tasks', 'created_at')) {
            Schema::dropColumns('tasks', 'created_at');
        }
        if (Schema::hasColumn('tasks', 'updated_at')) {
            Schema::dropColumns('tasks', 'updated_at');
        }
    }
};
