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
        Schema::create('field_values', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('subscriber_id');
            $table->unsignedBigInteger('field_id');
            $table->string('value');

            $table->timestamps();

            $table->foreign('subscriber_id')->references('id')->on('subscribers')
                ->onDelete('cascade');;
            $table->foreign('field_id')->references('id')->on('fields')
                ->onDelete('cascade');

            $table->unique(['subscriber_id', 'field_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('field_values', function (Blueprint $table) {
            $table->dropUnique(['subscriber_id', 'field_id']);

            $table->dropForeign(['subscriber_id', 'field_id']);
        });

        Schema::dropIfExists('field_values');
    }
};
