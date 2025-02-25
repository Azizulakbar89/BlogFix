<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");
        DB::table("kategoris")->truncate();
        DB::statement("SET FOREIGN_KEY_CHECKS=1;");

        $categories = [
            'adventure',
            'travelling'
        ];

        foreach ($categories as $category) {
            Kategori::create([
                'kategori' => $category
            ]);
        }
    }
}