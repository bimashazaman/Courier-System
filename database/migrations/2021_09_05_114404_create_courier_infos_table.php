<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('courier_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sender_branch_id');

            $table->foreign('sender_branch_id')
                ->references('id')
                ->on('branches');

            $table->string('sender_name');
            $table->string('sender_email')->nullable();
            $table->string('sender_phone');
            $table->text('sender_address')->nullable();
            $table->unsignedBigInteger('receiver_branch_id');

            $table->foreign('receiver_branch_id')
                ->references('id')
                ->on('branches');

            $table->string('receiver_name');
            $table->string('receiver_email')->nullable();
            $table->string('receiver_phone');
            $table->text('receiver_address')->nullable();
            $table->string('invoice_id');
            $table->enum('status', ['Delivered', 'Received','Transit'])->default('Delivered');
            $table->unsignedBigInteger('sender_branch_staff_id')->nullable();

            $table->foreign('sender_branch_staff_id')
                ->references('id')
                ->on('users');

            $table->unsignedBigInteger('receiver_branch_staff_id')->default('1');

            $table->foreign('receiver_branch_staff_id')
                ->references('id')
                ->on('users');

            $table->integer('payment_receiver_id')->nullable();

            $table->integer('payment_branch_id')->nullable();

            $table->enum('payment_status', ['Unpaid', 'Paid'])->default('Unpaid');

            $table->string('payment_method_name')->nullable();

            $table->string('payment_transaction_id')->nullable();

            $table->string('payment_date')->nullable();

            $table->double('payment_balance', 8, 2)->nullable();

            $table->string('payment_transaction_image')->nullable();

            $table->text('payment_note')->nullable();

            $table->string('code');

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
        Schema::dropIfExists('courier_infos');
    }
}
