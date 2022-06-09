<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequirementListTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requirement_list_types', function (Blueprint $table) {
             // Default Properties
             $table->uuid('id')->primary();
             $table->timestamps();
             $table->softDeletes();
             $table->foreignUuid('created_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade');   
             $table->foreignUuid('updated_by')->nullable()->constrained('users')->onDelete('cascade')->onUpdate('cascade'); 

             $table->foreignUuid('requirement_bin_id')->nullable();
             $table->foreignUuid('requirement_type_id')->nullable();
 
             $table->foreign('requirement_bin_id')->references('id')->on('requirement_bins');
             $table->foreign('requirement_type_id')->references('id')->on('requirement_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requirement_list_types');
    }
}
