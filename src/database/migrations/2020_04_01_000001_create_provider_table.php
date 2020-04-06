<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderTable extends Migration
{
    public function up()
    {
      Schema::create('providers', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('group_id')->unsigned()->nullable();
        $table->boolean('isWhatsapp')->default(false);
        $table->char('phone', 15);
        $table->string('instagram')->nullable();
        $table->char('city_id',7);
        $table->text('description')->nullable();
        $table->decimal('value')->default(0);
        $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
        $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade')->onUpdate('cascade');
        $table->timestamps();
        $table->softDeletes();
      });
    }
    
    public function down(){
      Schema::dropIfExists('providers');
    }
}
