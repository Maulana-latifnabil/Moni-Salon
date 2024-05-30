<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('phone_number');
            $table->string('address');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->foreignId('service_id')->constrained();
            $table->foreignId('barber_id')->constrained('users')->onDelete('cascade');
            $table->text('additional_notes')->nullable();
            $table->string('payment_method');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
