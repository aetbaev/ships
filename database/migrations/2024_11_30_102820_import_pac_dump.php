<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        DB::unprepared(file_get_contents(database_path('data/pac-dump.sql')));
    }

    public function down(): void
    {
        Schema::dropIfExists('cabin_categories');
        Schema::dropIfExists('ships_gallery');
        Schema::dropIfExists('ships');
    }
};
