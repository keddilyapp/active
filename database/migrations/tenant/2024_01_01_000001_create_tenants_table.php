
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('name');
            $table->string('email');
            $table->string('plan')->default('basic');
            $table->string('status')->default('active');
            $table->json('settings')->nullable();
            $table->timestamps();
            $table->json('data')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tenants');
    }
};
