<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBroadcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id(); // Creates an auto-incrementing bigint primary key
            $table->string('alumni_id'); // varchar(255)
            $table->string('api_id'); // varchar(255)
            $table->string('detail'); // varchar(255)
            $table->string('message'); // varchar(255)
            $table->string('target'); // varchar(255)
            $table->timestamps(); // Creates created_at and updated_at columns
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broadcasts');
    }
}
