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
        Schema::create('settings_tbl', function (Blueprint $table) {
            $table->id();
            $table->boolean('choose_banner')->default(true);
            $table->boolean('choose_social')->default(true);
            $table->string('text_logo')->default('DevC Blog');
            $table->softDeletes()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings_tbl');
    }
};
