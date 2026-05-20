<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(): void
    {
        Schema::create('customer_sessions', function (Blueprint $table) {

            $table->id();

            $table->string('customer_name');

            $table->string('email');

            $table->string('phone');

            $table->enum('session_status',[
                'waiting',
                'connected',
                'closed'
            ])->default('waiting');

            $table->timestamp('last_activity')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_sessions');
    }
};
