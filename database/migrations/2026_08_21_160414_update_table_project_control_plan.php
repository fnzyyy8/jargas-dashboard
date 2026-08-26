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
        Schema::table('project_control_plan', function (Blueprint $table) {
            $table->string('category')->nullable(true)->change();
            $table->string('sub_category')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('project_control_plan', function (Blueprint $table) {
            //
        });
    }
};
