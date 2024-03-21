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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->date('check_in_date');
            $table->boolean('is_checked_in')->default(false);
            $table->integer('number_of_days');
            $table->integer('number_of_adults');
            $table->integer('number_of_children');
            $table->text('description')->nullable();
            $table->date('check_out_date')->nullable();
            $table->boolean('is_checked_out')->default(false);
            $table->string('category');
            $table->timestamps();

            $table->foreign('customer_id')
                ->references('id')
                ->on('customers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
