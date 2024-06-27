<?php

use App\Enums\Ask;
use App\Enums\Gender;
use App\Enums\Status;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
//            $table->string('username')->unique();
            $table->unsignedMediumInteger('points');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('device_token')->nullable();
            $table->string('web_token')->nullable();
            $table->unsignedTinyInteger('status')->default(Status::ACTIVE);
            $table->date('birthday');
            $table->unsignedTinyInteger('gender')->default(Gender::MALE);
            $table->string('country_code')->nullable();
            $table->unsignedTinyInteger('is_guest')->default(Ask::NO);
            $table->decimal('balance', 13, 6)->default(0);
            $table->rememberToken();
            $table->string('creator_type')->nullable();
            $table->bigInteger('creator_id')->nullable();
            $table->string('editor_type')->nullable();
            $table->bigInteger('editor_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
