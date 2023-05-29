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
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->integer('status_id')
                ->unsigned();

            $table->string('article', 255);
            $table->string('name', 255);
            $table->string('slug', 255);
            $table->text('description')
                ->nullable();
            $table->string('note', 255)
                ->nullable();
            $table->boolean('is_spare_part')
                ->default(false);

            $table->timestamps();

            $table->foreign('status_id')
                ->references('id')
                ->on('statuses')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->softDeletes();
        });

        Schema::create('product_spare_parts', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned();
            $table->integer('spare_part_id')
                ->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('spare_part_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['product_id', 'spare_part_id']);
        });

        Schema::create('product_modifications', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned();
            $table->integer('modification_id')
                ->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('modification_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['product_id', 'modification_id']);
        });

        Schema::create('product_categories', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned();
            $table->integer('category_id')
                ->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['product_id', 'category_id']);
        });

        Schema::create('product_series', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned();
            $table->integer('series_id')
                ->unsigned();

            $table->integer('quantity');

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('series_id')
                ->references('id')
                ->on('carriage_series')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['product_id', 'series_id']);
        });

        Schema::create('product_details', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')
                ->unsigned();

            $table->string('okp', 255)
                ->nullable();
            $table->string('reference_document', 255)
                ->nullable();
            $table->string('dimension', 255)
                ->nullable();
            $table->string('weight', 255)
                ->nullable();
            $table->double('average_failure_time')
                ->nullable();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('product_additional_fields', function (Blueprint $table) {
            $table->id();

            $table->integer('product_id')
                ->unsigned();

            $table->string('name', 255);
            $table->text('value');
            $table->integer('sort_order');

            $table->timestamps();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('images', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('alt', 255)
                ->nullable();

            $table->timestamps();
        });

        Schema::create('product_images', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned();
            $table->integer('image_id')
                ->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('image_id')
                ->references('id')
                ->on('images')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['product_id', 'image_id']);
        });

        Schema::create('files', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('type', 20);

            $table->timestamps();
        });

        Schema::create('product_files', function (Blueprint $table) {
            $table->integer('product_id')
                ->unsigned();
            $table->integer('file_id')
                ->unsigned();

            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('file_id')
                ->references('id')
                ->on('files')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['product_id', 'file_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_files');
        Schema::dropIfExists('files');
        Schema::dropIfExists('product_images');
        Schema::dropIfExists('images');
        Schema::dropIfExists('product_additional_fields');
        Schema::dropIfExists('product_details');
        Schema::dropIfExists('product_series');
        Schema::dropIfExists('product_categories');
        Schema::dropIfExists('product_modifications');
        Schema::dropIfExists('product_spare_parts');
        Schema::dropIfExists('products');
    }
};
