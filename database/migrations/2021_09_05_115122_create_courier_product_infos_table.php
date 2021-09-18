<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourierProductInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::enableForeignKeyConstraints();
        Schema::create('courier_product_infos', function (Blueprint $table) {
            $table->id();
            $table->integer('courier_type');
            $table->integer('courier_quantity')->nullable();
            $table->double('courier_fee', 8, 2)->nullable();
            $table->text('courier_details')->nullable();
            $table->string('courier_code');

            $table->unsignedBigInteger('courier_info_id');

            $table->foreign('courier_info_id')
                ->references('id')
                ->on('courier_infos');

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
        Schema::dropIfExists('courier_product_infos');
    }
}
