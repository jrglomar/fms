<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            // Default Properties
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

            // Fillables
            $table->string('image')->nullable();
            $table->string('salutation')->nullable();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('gender');
            $table->string('birthdate');
            $table->string('birthplace');
            $table->string('hire_date');
            $table->string('phone_number');
            $table->string('province');
            $table->string('city');
            $table->string('barangay');
            $table->string('street');
            $table->string('house_number');

            // Relationship sample
            $table->foreignUuid('user_id')->constrained('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('faculty_type_id')->constrained('faculty_types')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignUuid('academic_rank_id')->constrained('academic_ranks')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignUuid('designation_id')->constrained('designations')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignUuid('specialization_id')->constrained('specializations')->onDelete('cascade')->onUpdate('cascade')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faculties');
    }
}
