<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementRequiredFacultyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_required_faculty_lists', function (Blueprint $table) {
            // Default Properties
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

            $table->string('remarks')->nullable();
            $table->string('status')->nullable();
            $table->foreignUuid('requirement_bin_id')->nullable();
            $table->foreignUuid('faculty_id')->nullable();

            $table->foreign('requirement_bin_id')->references('id')->on('requirement_bins');
            $table->foreign('faculty_id')->references('id')->on('faculties');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirement_required_faculty_lists');
    }
}
