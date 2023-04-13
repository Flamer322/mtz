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
        Schema::create('note_templates', function (Blueprint $table) {
            $table->id();
            $table->string('type', 255);
        });

        Schema::create('algorithm_parameters', function (Blueprint $table) {
            $table->id();
            $table->string('key', 255);
            $table->string('name', 255);
            $table->double('value');
        });

        Schema::create('reliabilities', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')
                ->unsigned();

            $table->integer('failure_number');
            $table->integer('total_operating');
            $table->double('point_rate');
            $table->double('top_rate');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('summary_reports', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
        });

        Schema::create('explanatory_notes', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explanatory_notes');
        Schema::dropIfExists('summary_reports');
        Schema::dropIfExists('reliabilities');
        Schema::dropIfExists('algorithm_parameters');
        Schema::dropIfExists('note_templates');
    }
};
