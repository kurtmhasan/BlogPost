<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('views')->default(0)->after('content');
            // İsmi elle veriyoruz
            $table->index('views', 'idx_posts_views');
        });
    }

    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Aynı isimle siliyoruz
            $table->dropIndex('idx_posts_views');
            $table->dropColumn('views');
        });
    }
};
