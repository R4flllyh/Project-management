<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_name');
            $table->text('project_description');
            $table->date('timeline');
            $table->string('link')->nullable();
            $table->string('assets')->nullable();
            $table->string('priority');
            $table->string('status');
            // $table->string('assignee')->default('default_assignee_value');
            $table->string('project_type');
            $table->string('project_image')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects', function (Blueprint $table) {
            $table->dropColumn('checkbox_names');
        });
    }
};
