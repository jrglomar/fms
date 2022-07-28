<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClassAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('class_attendances', function (Blueprint $table) {
            // Default Properties
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

            $table->date('date_of_class');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('status')->default('Submitted');
            $table->string('proof_of_attendance_link')->nullable();
            $table->string('proof_of_attendance_file')->nullable();
            $table->string('proof_of_attendance_file_name')->nullable();
            $table->longText('remarks')->nullable();

            // Relationship sample
            $table->foreignUuid('checked_by')->nullable();
            $table->foreign('checked_by')->references('id')->on('faculties');
            $table->foreignUuid('faculty_id')->constrained('faculties')->onDelete('cascade')->onUpdate('cascade')->nullable();
            $table->foreignUuid('class_schedule_id')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('class_attendances');
    }
}
