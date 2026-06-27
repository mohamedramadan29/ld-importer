<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_contents', function (Blueprint $table) {
            $table->id();
            $table->string('page');      // اسم الصفحة: home, about, contact
            $table->string('section');   // اسم القسم: hero, features, categories, philosophy, showroom
            $table->string('key');       // المفتاح: title, description, image, icon
            $table->text('value')->nullable(); // القيمة
            $table->integer('sort_order')->default(0); // ترتيب العنصر
            $table->timestamps();

            $table->unique(['page', 'section', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_contents');
    }
};
