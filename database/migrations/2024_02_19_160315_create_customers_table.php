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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name', 50);
            $table->unsignedBigInteger('customertype_id');
            $table->string('customer_code', 50);
            $table->char('sex', 1);
            $table->date('dob');
            $table->string('phone', 50);
            $table->string('passportnumber', 200);
            $table->string('country', 50);
            $table->timestamps();

            $table->foreign('customertype_id')
                ->references('id')
                ->on('customer_types')
                ->onDelete('cascade')
                ->onUpdate('cascade')
                ->comment('customer_type_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
