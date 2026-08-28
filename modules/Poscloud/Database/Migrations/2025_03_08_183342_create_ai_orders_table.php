<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAiOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ai_orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('content');
            $table->string('customer_name')->nullable();
            $table->string('customer_phone')->nullable();

            $table->string('time')->nullable();
            $table->text('delivery_address')->nullable();
            $table->unsignedBigInteger('company_id');
            $table->boolean('processed')->default(false);
            $table->integer('type')->default(1); //1 for pickup, 2 for delivery
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ai_orders');
    }
}
