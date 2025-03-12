<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->text('name');
            $table->text('company')->nullable();
            $table->text('email')->nullable();
            $table->text('phone_number')->nullable();
            $table->text('message')->nullable();
            $table->string('page')->nullable();
            $table->unsignedBigInteger('product_id')->nullable(); // product_id qo'shildi
            $table->timestamps();
//            $table->for .eign('product_id')->references('id')->on('products');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applications');
    }
}
