<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Note;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::factory(10)
            ->has(Note::factory()->count(3), 'notes')
            ->create();
    }
}
