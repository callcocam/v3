<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('alias')->nullable();
            $table->string('slug')->nullable();
            $table->string('text')->nullable();
            $table->string('view')->nullable()->default('text');
            $table->string('link')->nullable();
            $table->tinyInteger('sortable')->nullable()->default(false);
            $table->tinyInteger('searchable')->nullable()->default(false);
            $table->string('colspan')->nullable()->default('12');
            $table->string('width')->nullable()->default('12');
            $table->string('ordering')->nullable();
            $table->uuidMorphs('configable');
            $table->foreignUuid('user_id')->nullable()->constrained('users')->cascadeOnDelete();        
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
        Schema::dropIfExists('configs');
    }
};
