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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->integer('parent_id')
                ->unsigned();

            $table->string('slug', 255)
                ->index();
            $table->string('name', 255);
            $table->string('image', 255)
                ->nullable();
            $table->text('description')
                ->nullable();

            $table->timestamps();

            $table->foreign('parent_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->softDeletes();
        });

        Schema::create('statuses', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);
            $table->string('color', 255);

            $table->timestamps();
        });

        Schema::create('carriage_types', function (Blueprint $table) {
            $table->id();

            $table->string('name', 255);

            $table->timestamps();
        });

        Schema::create('carriage_series', function (Blueprint $table) {
            $table->id();

            $table->integer('type_id')
                ->unsigned();

            $table->string('name', 255);

            $table->timestamps();

            $table->foreign('type_id')
                ->references('id')
                ->on('carriage_types')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carriage_series');
        Schema::dropIfExists('carriage_types');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('categories');
    }
};
