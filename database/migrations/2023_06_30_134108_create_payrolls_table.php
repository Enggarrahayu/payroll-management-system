<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payrolls', function (Blueprint $table) {
            $table->id();
            $table->integer('month');
            $table->year('year');
            $table->enum('status', ['pending', 'paid'])->default('pending');
            $table->integer('overtime_hours');
            $table->integer('bonus_salary');
            $table->integer('deduction');
            $table->integer('absen');
            $table->integer('present');
            $table->integer('total_salary');
            $table->dateTime('payment_date')->nullable();
            $table->unsignedBigInteger('employee_position_id')->nullable();
            $table->foreign('employee_position_id')->references('id')->on('employee_position');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payrolls');
    }
};
