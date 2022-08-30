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
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('zone_type');
            $table->unsignedBigInteger('zip_code_id');
            $table->unsignedBigInteger('settlement_type_id');
            $table->timestamps();
            $table->index('zip_code_id');
            $table->index('settlement_type_id');
            $table->foreign('settlement_type_id')
                ->references('id')->on('settlement_types')
                ->onUpdate('cascade')            
                ->onDelete('cascade');            
            $table->foreign('zip_code_id')
                ->references('id')->on('zip_codes')
                ->onUpdate('cascade')            
                ->onDelete('cascade');            
        });
        \DB::statement("ALTER TABLE `settlements` ADD `key` SMALLINT(4) NOT NULL AFTER `id`");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settlements');
    }
};
