<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingSubmittedProofOfAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_submitted_proof_of_attendances', function (Blueprint $table) {
            // Default Properties
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

            // Fillables
            $table->timestamp('date_submitted')->useCurrent();
            $table->longText('remarks')->nullable();
            $table->string('status')->nullable();
            $table->string('file_name')->nullable();
            $table->string('proof_of_attendance_file_directory')->nullable();
            $table->string('proof_of_attendance_file_link')->nullable();

            // Relationship sample
            $table->foreignUuid('mar_faculty_list_id')->nullable();
            $table->foreign('mar_faculty_list_id')->references('id')->on('meeting_attendance_required_faculty_list');

            // Fillables
            // $table->string('proof_of_attendance_file_directory')->nullable();
            // $table->string('proof_of_attendance_file_link')->nullable();
            // $table->string('status')->nullable();
            // $table->string('remarks')->nullable();
            
            // Relationship sample
            // $table->foreignUuid('faculty_id')->constrained('faculties')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_submitted_proof_of_attendances');
    }
}
