<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActivityAttendanceRequiredFacultyListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('activity_attendance_required_faculty_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->softDeletes();
            $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
            $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');

            $table->time('time_in')->nullable();
            $table->time('time_out')->nullable();

            $table->string('attendance_status')->nullable();
            $table->longText('remarks')->nullable();
            $table->string('status')->nullable();
            $table->string('proof_of_attendance_file_link')->nullable();

            $table->foreignUuid('activity_id')->nullable();
            $table->foreignUuid('faculty_id')->nullable();

            $table->foreign('activity_id')->references('id')->on('activities');
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
        Schema::dropIfExists('activity_attendance_required_faculty_lists');
    }
}
