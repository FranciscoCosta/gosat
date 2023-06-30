<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('offer', function (Blueprint $table) {
            $table->id();
            $table->string('cpf',11);
            $table->string('institution');
            $table->integer('institution_id');
            $table->string('name_modal');
            $table->string('cod');
            $table->integer('PMax')->nullable();
            $table->integer('PMin')->nullable();
            $table->integer('PMedium')->nullable();
            $table->integer('VMin')->nullable();
            $table->integer('VMax')->nullable();
            $table->integer('VMedium')->nullable();
            $table->decimal('TaxesMonth', 4, 4)->nullable();
            $table->decimal('ValueToPay', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offer');
    }
};
