<?php

namespace Database\Seeders;

use App\Models\Partners;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartnersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partners::factory()->count(10)->create();
    }
}
