<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingAttendanceRequiredFacultyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_attendance_required_faculty_lists', function (Blueprint $table) {
            // Default Properties
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

            // Fillables
            $table->time('time_in')->nullable();;
            $table->time('time_out')->nullable();;
            $table->string('attendance_status')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('proof_of_attendance_file_directory')->nullable();
            $table->string('proof_of_attendance_file_link')->nullable();

            // Relationship sample
            $table->foreignUuid('faculty_id')->constrained('faculties')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignUuid('meeting_id')->constrained('meetings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_attendance_required_faculty_lists');
    }
}
