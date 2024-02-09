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
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('role');
            $table->string('expertise')->default('all');;
            $table->boolean('can_assign_ticket')->default(false);
            $table->boolean('can_change_status')->default(false);
            $table->boolean('is_staff_free')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
