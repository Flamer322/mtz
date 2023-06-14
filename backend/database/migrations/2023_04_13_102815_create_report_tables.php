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

            $table->integer('company_id')
                ->unsigned()
                ->nullable();
            $table->integer('created_by')
                ->unsigned();

            $table->string('name', 255);
            $table->integer('confidence_probability');
            $table->dateTime('period_from_date');
            $table->dateTime('period_to_date');

            $table->foreign('company_id')
                ->references('id')
                ->on('claim_companies')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });

        Schema::create('summary_report_products', function (Blueprint $table) {
            $table->integer('report_id')
                ->unsigned();
            $table->integer('product_id')
                ->unsigned();

            $table->foreign('report_id')
                ->references('id')
                ->on('summary_reports')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['report_id', 'product_id']);
        });

        Schema::create('summary_report_series', function (Blueprint $table) {
            $table->integer('report_id')
                ->unsigned();
            $table->integer('series_id')
                ->unsigned();

            $table->foreign('report_id')
                ->references('id')
                ->on('summary_reports')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('series_id')
                ->references('id')
                ->on('carriage_series')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['report_id', 'series_id']);
        });

        Schema::create('summary_report_types', function (Blueprint $table) {
            $table->integer('report_id')
                ->unsigned();
            $table->integer('type_id')
                ->unsigned();

            $table->foreign('report_id')
                ->references('id')
                ->on('summary_reports')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('type_id')
                ->references('id')
                ->on('carriage_types')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['report_id', 'type_id']);
        });

        Schema::create('explanatory_notes', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')
                ->unsigned();
            $table->integer('created_by')
                ->unsigned();

            $table->string('name', 255);
            $table->integer('confidence_probability');
            $table->dateTime('period_from_date');
            $table->dateTime('period_to_date');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('created_by')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('explanatory_notes');
        Schema::dropIfExists('summary_report_types');
        Schema::dropIfExists('summary_report_series');
        Schema::dropIfExists('summary_report_products');
        Schema::dropIfExists('summary_reports');
        Schema::dropIfExists('reliabilities');
        Schema::dropIfExists('algorithm_parameters');
        Schema::dropIfExists('note_templates');
    }
};
