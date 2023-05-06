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
        Schema::create('client_companies', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')
                ->unsigned();

            $table->string('legal_name', 255);
            $table->string('legal_address', 255)
                ->nullable();
            $table->string('post_address', 255)
                ->nullable();
            $table->string('inn', 255)
                ->nullable();
            $table->string('okpo', 255)
                ->nullable();
            $table->string('kpp', 255)
                ->nullable();
            $table->string('ogrn', 255)
                ->nullable();
            $table->string('bik', 255)
                ->nullable();
            $table->string('corr_account', 255)
                ->nullable();
            $table->string('bank_account', 255)
                ->nullable();
            $table->string('main_organization', 255)
                ->nullable();
            $table->string('short_name', 255)
                ->nullable();
            $table->string('bank_name', 255)
                ->nullable();
            $table->string('director_post', 255)
                ->nullable();
            $table->string('director_name', 255)
                ->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->integer('user_id')
                ->unsigned();
            $table->integer('buyer_company_id')
                ->unsigned();
            $table->integer('payer_company_id')
                ->unsigned();
            $table->integer('recipient_company_id')
                ->unsigned();

            $table->string('contact_name', 255)
                ->nullable();
            $table->string('contact_phone', 255)
                ->nullable();
            $table->string('contact_email', 255)
                ->nullable();
            $table->string('document_type', 255)
                ->nullable();
            $table->string('comment', 255)
                ->nullable();
            $table->string('end_user_of_product', 255)
                ->nullable();
            $table->string('delivery_date', 255)
                ->nullable();
            $table->smallInteger('status')
                ->nullable();

            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('buyer_company_id')
                ->references('id')
                ->on('client_companies')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('payer_company_id')
                ->references('id')
                ->on('client_companies')
                ->cascadeOnUpdate()
                ->restrictOnDelete();
            $table->foreign('recipient_company_id')
                ->references('id')
                ->on('client_companies')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->softDeletes();
        });

        Schema::create('order_files', function (Blueprint $table) {
            $table->id();

            $table->integer('order_id')
                ->unsigned();

            $table->string('file', 255);
            $table->string('name', 255)
                ->nullable();

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });

        Schema::create('order_lines', function (Blueprint $table) {
            $table->id();

            $table->integer('order_id')
                ->unsigned();
            $table->integer('product_id')
                ->unsigned();

            $table->integer('quantity');

            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->unique(['order_id', 'product_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_lines');
        Schema::dropIfExists('order_files');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('client_companies');
    }
};
