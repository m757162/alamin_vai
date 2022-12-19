<?php

namespace Database\Seeders;

use App\Models\SubsubCategory;
use Illuminate\Database\Seeder;
use Database\Factories\SubsubCategoryFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubsubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SubsubCategory::factory(1)->create();
    }
}
