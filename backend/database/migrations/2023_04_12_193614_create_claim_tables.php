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
        Schema::create('operating_times', function (Blueprint $table) {
            $table->id();

            $table->integer('carriage_series_id')
                ->unsigned();

            $table->integer('mileage');
            $table->string('unit', 255);
            $table->integer('count_carriage');
            $table->dateTime('date');
            $table->string('note', 255)
                ->nullable();

            $table->foreign('carriage_series_id')
                ->references('id')
                ->on('carriage_series')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('defect_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
        });

        Schema::create('product_nodes', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')
                ->unsigned();

            $table->string('name', 255);

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('claim_companies', function (Blueprint $table) {
            $table->id();

            $table->string('short_name', 255);
            $table->string('full_name', 255);
        });

        Schema::create('claims', function (Blueprint $table) {
            $table->id();

            $table->integer('defect_type_id')
                ->unsigned()
                ->nullable();
            $table->integer('carriage_type_id')
                ->unsigned()
                ->nullable();
            $table->integer('carriage_series_id')
                ->unsigned()
                ->nullable();
            $table->integer('product_id')
                ->unsigned()
                ->nullable();
            $table->integer('product_node_id')
                ->unsigned()
                ->nullable();
            $table->integer('claim_company_id')
                ->unsigned()
                ->nullable();

            $table->string('number', 255);
            $table->string('theme', 255);
            $table->string('address', 255)
                ->nullable();
            $table->dateTime('discover_date')
                ->nullable();
            $table->string('kasant_number', 255)
                ->nullable();
            $table->string('carriage_number', 255)
                ->nullable();
            $table->string('manufacture_number', 255)
                ->nullable();
            $table->dateTime('manufacture_product_date')
                ->nullable();
            $table->string('assembly_serial_number', 255)
                ->nullable();
            $table->dateTime('manufacture_date')
                ->nullable();
            $table->string('time_to_failure', 255)
                ->nullable();
            $table->text('claimed_defect')
                ->nullable();
            $table->text('identified_defect')
                ->nullable();
            $table->text('comment')
                ->nullable();

            $table->foreign('defect_type_id')
                ->references('id')
                ->on('defect_types')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('carriage_type_id')
                ->references('id')
                ->on('carriage_types')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('carriage_series_id')
                ->references('id')
                ->on('carriage_series')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('product_node_id')
                ->references('id')
                ->on('product_nodes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('claim_company_id')
                ->references('id')
                ->on('claim_companies')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('claim_files', function (Blueprint $table) {
            $table->id();

            $table->integer('claim_id')
                ->unsigned();

            $table->string('file', 255);
            $table->string('name', 255);

            $table->foreign('claim_id')
                ->references('id')
                ->on('claims')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claim_files');
        Schema::dropIfExists('claims');
        Schema::dropIfExists('claim_companies');
        Schema::dropIfExists('product_nodes');
        Schema::dropIfExists('defect_types');
        Schema::dropIfExists('operating_times');
    }
};
