<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // معلومات الموقع
            $table->string('site_name')->nullable();
            $table->text('site_description')->nullable();
            $table->string('site_logo')->nullable();

            // معلومات الاتصال
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();

            // العنوان
            $table->string('address')->nullable();
            $table->string('google_map_link')->nullable();

            // ساعات العمل
            $table->string('working_hours')->nullable();

            // روابط السوشيال ميديا
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('snapchat')->nullable();
            $table->string('linkedin')->nullable();

            // محتوى إضافي
            $table->text('terms')->nullable();
            $table->text('about_us')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
