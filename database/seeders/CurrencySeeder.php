<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currencies = [
            // PKR base currency
            [
                'id' => 1,
                'name' => 'PKR',
                'symbol' => '₨',
                'code' => 'PKR',
                'rate' => 1,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 0,
                'is_default' => 'Yes',
                'is_active' => 'Yes',
            ],
            // Other currencies (1 PKR as base)
            [
                'id' => 2,
                'name' => 'USD',
                'symbol' => '$',
                'code' => 'USD',
                'rate' => 0.0064,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 1,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 3,
                'name' => 'EUR',
                'symbol' => '€',
                'code' => 'EUR',
                'rate' => 0.0058,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 2,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 4,
                'name' => 'GBP',
                'symbol' => '£',
                'code' => 'GBP',
                'rate' => 0.0051,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 3,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 5,
                'name' => 'SAR',
                'symbol' => null,
                'code' => 'SAR',
                'rate' => 0.024,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 4,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 6,
                'name' => 'AUD',
                'symbol' => '$',
                'code' => 'AUD',
                'rate' => 0.0095,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 5,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 7,
                'name' => 'PHP',
                'symbol' => null,
                'code' => 'PHP',
                'rate' => 0.34,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 6,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 8,
                'name' => 'SGD',
                'symbol' => null,
                'code' => 'SGD',
                'rate' => 0.0089,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 7,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 9,
                'name' => 'JPY',
                'symbol' => null,
                'code' => 'JPY',
                'rate' => 0.88,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 8,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 10,
                'name' => 'INR',
                'symbol' => null,
                'code' => 'INR',
                'rate' => 0.49,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 9,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 11,
                'name' => 'CNY',
                'symbol' => null,
                'code' => 'CNY',
                'rate' => 0.046,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 10,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 12,
                'name' => 'TRY',
                'symbol' => null,
                'code' => 'TRY',
                'rate' => 0.037,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 11,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 13,
                'name' => 'RUB',
                'symbol' => null,
                'code' => 'RUB',
                'rate' => 0.41,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 12,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
            [
                'id' => 14,
                'name' => 'AED',
                'symbol' => null,
                'code' => 'AED',
                'rate' => 0.023,
                'decimals' => 4,
                'symbol_placement' => 'before',
                'primary_order' => 13,
                'is_default' => 'No',
                'is_active' => 'Yes',
            ],
        ];

        // Add timestamps
        $timestamp = now();
        foreach ($currencies as &$currency) {
            $currency['created_at'] = $timestamp;
            $currency['updated_at'] = $timestamp;
        }

        DB::table('currencies')->insert($currencies);
    }
}
