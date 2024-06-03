<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveServiceIdForeignKeyFromBookingsTable extends Migration
{
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['service_id']);

            // Drop the service_id column
            $table->dropColumn('service_id');
        });
    }

    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add the service_id column
            $table->foreignId('service_id')->constrained()->onDelete('cascade');
        });
    }
}
