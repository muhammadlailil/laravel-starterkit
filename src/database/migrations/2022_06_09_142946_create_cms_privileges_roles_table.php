<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsPrivilegesRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_privileges_roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('created_at')->useCurrent();
            $table->foreignUuid('cms_privileges_id')->constrained('cms_privileges')->onDelete('cascade');
            $table->foreignUuid('cms_moduls_id')->constrained('cms_moduls')->onDelete('cascade');
            $table->boolean('can_view');
            $table->boolean('can_add');
            $table->boolean('can_edit');
            $table->boolean('can_delete');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_privileges_roles');
    }
}
