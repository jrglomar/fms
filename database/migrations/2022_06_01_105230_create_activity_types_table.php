<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_types', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_types');
    }
}
