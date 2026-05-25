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
        Schema::table('articles', function (Blueprint $table) {
            // query yang di PDF salah, karena belum dibuatkan foreign key ke table article_categories
            /*
            $table->unsignedBigInteger('article_category_id')
                ->references('id')
                ->on('article_categories')
                ->after('content')
                ->onDelete('cascade');
            */

            $table->foreignId('article_category_id')
                ->default(1) // ID kategori default berisi 1, karena otomatis digenerate menggunakan AUTO_INCREMENT
                ->after('content')
                ->constrained()
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['article_category_id']); // harus drop foreign key dulu, sebelum drop column
            $table->dropColumn('article_category_id');
        });
    }
};
