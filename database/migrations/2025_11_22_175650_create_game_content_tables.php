<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. ตารางเก็บสถานการณ์ (Questions)
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->string('title');        // ชื่อเหตุการณ์ (เช่น "ประตูยักษ์")
            $table->text('scenario');       // เนื้อเรื่องบรรยายสถานการณ์
            $table->string('image_path')->nullable(); // ชื่อไฟล์รูป (เช่น 'gate.jpg')
            $table->integer('order')->default(0);     // ลำดับข้อ
            $table->timestamps();
        });

        // 2. ตารางเก็บตัวเลือก (Choices)
        Schema::create('choices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->constrained()->onDelete('cascade');
            $table->string('text');         // ข้อความตัวเลือก (เช่น "พังประตูเข้าไป")
            $table->string('trait');        // ลักษณะนิสัย/อาชีพแฝง (เช่น 'Warrior', 'Mage')
            // (ค่า trait นี้เราจะไม่โชว์ให้ user เห็น แต่จะส่งให้ AI วิเคราะห์)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('choices');
        Schema::dropIfExists('questions');
    }
};