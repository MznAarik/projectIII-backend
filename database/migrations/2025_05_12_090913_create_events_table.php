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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name', 50)->nullable(false);
            $table->string('venue', 100)->nullable(false);
            $table->integer('capacity')->nullable(false);
            $table->double('ticket_price')->nullable(false);
            $table->text('description');
            $table->string('category')->nullable(false);
            $table->string('status', 20)->nullable(false);
            $table->string('organizer', 100);
            $table->string('image_url', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
