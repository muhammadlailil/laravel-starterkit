<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPrivilegesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_privileges', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('created_at')->useCurrent();
            $table->string('name',150);
            $table->boolean('is_superadmin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_privileges');
    }
}
