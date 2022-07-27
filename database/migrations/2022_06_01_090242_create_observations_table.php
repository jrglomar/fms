<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('observations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->dateTime('date_of_observation');
            $table->longText('remarks')->nullable();
            $table->longText('status')->nullable()->default('Pending');
            $table->string('proof_of_observation_file_directory')->nullable();
            $table->string('proof_of_observation_file_link')->nullable();

            $table->foreignUuid('class_schedule_id')->nullable();
            $table->foreign('faculty_id')->references('id')->on('faculties');
            // $table->foreign('class_schedule_id')->references('id')->on('class_schedule');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('observations');
    }
}
