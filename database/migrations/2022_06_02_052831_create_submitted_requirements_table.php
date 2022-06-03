<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubmittedRequirementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submitted_requirements', function (Blueprint $table) {
            // Default Properties
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

            $table->dateTime('date_submitted');
            $table->longText('remarks')->nullable();
            $table->string('status');
            $table->string('file_link');
            $table->string('file_link_directory');

            $table->foreignUuid('submitted_requirement_folder_id')->nullable();
            $table->foreign('submitted_requirement_folder_id')->references('id')->on('submitted_requirement_folders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submitted_requirements');
    }
}
