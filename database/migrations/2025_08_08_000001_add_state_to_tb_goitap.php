<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tb_goitap', function (Blueprint $table) {
            if (!Schema::hasColumn('tb_goitap', 'state')) {
                $table->tinyInteger('state')->default(0)->after('thoihan');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tb_goitap', function (Blueprint $table) {
            if (Schema::hasColumn('tb_goitap', 'state')) {
                $table->dropColumn('state');
            }
        });
    }
};



