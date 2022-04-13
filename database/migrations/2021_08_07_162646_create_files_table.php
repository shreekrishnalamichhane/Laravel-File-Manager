<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slugName');
            $table->string('sizeInBytes');
            $table->string('sizeFormatted');
            $table->string('extension');
            $table->string('type')->default('other');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('dimension')->nullable();
            $table->string('parentFolder')->nullable(false)->default('my-drive');
            $table->foreignId('userId')->nullable(false);
            $table->boolean('starred')->default(false);
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
        Schema::dropIfExists('files');
    }
}
