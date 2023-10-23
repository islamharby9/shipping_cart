<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Customer::query()->create([
            'first_name' => 'Customer',
            'last_name' => 'AA',
            'email' => 'customer.a@gmail.com',
            'store_credit' => '3000'
        ]);
    }
}
