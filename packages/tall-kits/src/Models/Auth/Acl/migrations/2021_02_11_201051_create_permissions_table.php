<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $name = config('acl.tables.permissions');
        Schema::create($name, function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name', 255)->unique();
            $table->string('slug', 255)->unique();
            $table->foreignUuid('group_id')->nullable()->constrained('groups')->onDelete('cascade');
            $table->enum('status', ['deleted', 'draft', 'published'])->default('published');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $name = config('acl.tables.permissions');
        Schema::dropIfExists($name);
    }
}
