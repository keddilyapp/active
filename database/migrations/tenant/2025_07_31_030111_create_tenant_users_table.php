<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->nullable();
            $table->string('provider_id')->nullable();
            $table->string('verification_code')->nullable();
            $table->enum('user_type', ['customer', 'seller', 'admin'])->default('customer');
            $table->enum('status', ['active', 'inactive', 'pending'])->default('active');
            $table->decimal('wallet_balance', 10, 2)->default(0);
            $table->integer('club_points')->default(0);
            $table->timestamp('last_login_at')->nullable();
            $table->string('avatar')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->boolean('newsletter_subscription')->default(false);
            $table->rememberToken();
            $table->timestamps();
            
            $table->index(['email', 'user_type']);
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};
