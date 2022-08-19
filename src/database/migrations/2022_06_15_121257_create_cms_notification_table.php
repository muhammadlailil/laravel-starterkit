<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCmsNotificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_notification', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->text('description');
            $table->boolean('is_read')->default(0);
            $table->string('url')->nullable();
            $table->foreignUuid('cms_users_id')->nullable()->constrained('cms_users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_notification');
    }
}
