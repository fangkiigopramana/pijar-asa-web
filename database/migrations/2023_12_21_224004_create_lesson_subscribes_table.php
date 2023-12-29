<?php

use App\Models\Lesson;
use App\Models\User;
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
        Schema::create('lesson_subscribes', function (Blueprint $table) {
            $table->id('subscribe_id');
            $table->foreignIdFor(User::class,'user_id');
            $table->foreignIdFor(Lesson::class,'lesson_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson_subscribes');
    }
};
