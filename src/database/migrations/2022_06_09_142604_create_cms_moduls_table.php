<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsModulsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_moduls', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('created_at')->useCurrent();
            $table->string('name',115);
            $table->string('icon',80);
            $table->string('path',95);
            $table->uuid('parent_id')->nullable();
            $table->integer('sorting');
            $table->string('table');
            $table->string('controller');
            $table->string('route_prefix');
            $table->string('type');
            $table->string('module_action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_moduls');
    }
}
