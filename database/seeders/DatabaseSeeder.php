<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test freelancer',
            'user_type' => 'freelancer',
            'email' => 'test@freelancer.com',
            'password' => bcrypt('12345678'),
        ]);

        User::factory()->create([
            'name' => 'Test Client',
            'user_type' => 'client',
            'email' => 'test@client.com',
            'password' => bcrypt('12345678'),
        ]);

        $this->call(AdminSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(SubcategorySeeder::class);
        $this->call(SubsubCategorySeeder::class);
    }
}
