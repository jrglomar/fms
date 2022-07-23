<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
             // Default Properties
             $table->uuid('id')->primary();
             $table->timestamps();
             $table->softDeletes();
             $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
             $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 
 
             // Fillables
             $table->string('title');
             $table->string('location');
             $table->date('date');
             $table->time('start_time');
             $table->time('end_time');
             $table->string('agenda')->nullable();
             $table->longText('description')->nullable();
             $table->boolean('is_required')->nullable();
             $table->string('status')->default('Pending');

             // Relationship sample
             $table->foreignUuid('meeting_types_id')->constrained('meeting_types')->onDelete('cascade')->onUpdate('cascade'); 

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
