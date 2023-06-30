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
            $table->integer('PMax');
            $table->integer('PMin');
            $table->integer('PMedium');
            $table->integer('VMin');
            $table->integer('VMax');
            $table->integer('VMedium');
            $table->decimal('TaxesMonth', 4, 4);
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
