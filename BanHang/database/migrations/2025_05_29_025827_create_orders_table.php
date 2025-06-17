<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->string('fullname', 50);
            $table->string('email', 150);
            $table->string('phone_number', 20);
            $table->string('address', 200);
            $table->string('note', 1000)->nullable();
            $table->dateTime('order_date');
            $table->integer('status')->default(0);
            $table->integer('total_money');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
