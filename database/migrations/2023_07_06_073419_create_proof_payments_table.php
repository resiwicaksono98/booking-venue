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
    Schema::create('proof_payments', function (Blueprint $table) {
      $table->id();
      $table->unsignedBigInteger('transaction_id')->nullable();
      $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('CASCADE');
      $table->enum('type', ['dp', 'paid-off']);
      $table->string('bank')->nullable();
      $table->string('account_number')->nullable();
      $table->string('name')->nullable();
      $table->string('phone_number')->nullable();
      $table->enum('status' , ['paid' , 'unpaid'])->default('unpaid');
      $table->string('image')->nullable();
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
    Schema::dropIfExists('proof_payments');
  }
};
