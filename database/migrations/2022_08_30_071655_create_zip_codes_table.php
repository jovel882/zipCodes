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
        Schema::create('zip_codes', function (Blueprint $table) {
            $table->id();
            $table->string('zip_code', 5);
            $table->string('locality');
            $table->unsignedBigInteger('federal_entity_id');
            $table->unsignedBigInteger('municipality_id');
            $table->timestamps();
            $table->index('zip_code');
            $table->index('federal_entity_id');
            $table->index('municipality_id');
            $table->foreign('federal_entity_id')
                  ->references('id')->on('federal_entities')
                  ->onUpdate('cascade')            
                  ->onDelete('cascade');            
            $table->foreign('municipality_id')
                  ->references('id')->on('municipalities')
                  ->onUpdate('cascade')            
                  ->onDelete('cascade');                        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('zip_codes');
    }
};
