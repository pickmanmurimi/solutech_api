<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('name')->comment('this will be a place holder for what would have been items relationship');
            $table->string('status')->nullable()
                ->comment('pending, loading, dispatched, delivered'); // pending, loading, dispatched, delivered
            $table->dateTime('dispatched_at')->nullable();
            $table->dateTime('loaded_at')->nullable();
            $table->dateTime('delivered_at')->nullable();
            $table->string("address");
            $table->integer("depot_id")->comment('order items are in this depot');

            $table->longText('options')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
