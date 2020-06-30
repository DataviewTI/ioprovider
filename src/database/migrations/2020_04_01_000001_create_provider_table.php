<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProviderTable extends Migration
{
    public function up()
    {
      Schema::create('providers', function (Blueprint $table) {
        $table->increments('id');
        $table->char('cpf_cnpj', 14)->unique();
        $table->string('name');
        $table->boolean('isWhatsapp')->default(false);
        $table->boolean('delivery')->default(false);
        $table->boolean('featured')->default(false);
        $table->char('phone', 15);
        $table->string('email')->nullable()->unique();
        $table->string('instagram')->nullable()->unique();
        $table->char('city_id',7)->nullable();
        $table->text('description')->nullable();
        $table->decimal('value')->default(0);
        $table->integer('group_id')->unsigned()->nullable();
        $table->enum('status',['A','I','B'])->default('I');
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
