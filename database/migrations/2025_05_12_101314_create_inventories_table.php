<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id')
                ->references('id')
                ->on('events')
                ->onDelete('cascade');

            $table->string('item_name', 50)->nullable(false);
            $table->unsignedBigInteger('quantity_available');
            $table->unsignedBigInteger('quantity_sold');
            $table->double('purchase_price')->nullable(false);
            $table->double('selling_price')->nullable(false);
            $table->string('supplier', 100);
            $table->dateTime('expiration_date');
            $table->string('category', 50);
            $table->string('status', 50);
            $table->string('image_url');
            $table->string('location', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
