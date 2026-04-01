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
        Schema::table('cities', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('name');
        });

        // Backfill slugs for existing cities
        $cities = \Illuminate\Support\Facades\DB::table('cities')->get();
        foreach ($cities as $city) {
            \Illuminate\Support\Facades\DB::table('cities')
                ->where('id', $city->id)
                ->update(['slug' => \Illuminate\Support\Str::slug($city->name)]);
        }

        // Make slug non-nullable after backfill
        Schema::table('cities', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
