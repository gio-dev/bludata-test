<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->enum('type', \App\Enums\PersonsType::listAll())->index();
            $table->enum('model', \App\Enums\ModelPersonType::listAll())->index();
            $table->string('name');
            $table->string('document');
            $table->date('birthdate')->nullable();
            $table->string('rg')->nullable();
            $table->unsignedBigInteger('state_id')->nullable();
            $table->unsignedBigInteger('company_id')->nullable();

            $table->foreign('state_id')
                ->references('id')
                ->on('states')
                ->onDelete('set null');

            $table->foreign('company_id')
                ->references('id')
                ->on('people')
                ->onDelete('set null');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('people');
    }
}
