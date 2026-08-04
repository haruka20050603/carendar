<?php

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
    Schema::create('schedules', function (Blueprint $table) {
    $table->id();
    // 予定を登録したユーザー
    $table->foreignId('user_id')->constrained();
    // 予定のタイトル
    $table->string('title');
    // 予定の説明
    $table->string('description')->nullable();
    // 開始日
    $table->date('start_date');
    $table->time('start_time');

    // 終了日
    $table->date('end_date');
    $table->time('end_time');

    $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
