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
        Customer::has(Note::factory(3)->create())->factory(10)->create();
    }
}
