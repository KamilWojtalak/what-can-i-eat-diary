<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ingredientNames = [
            'kiełki',
            'brokuł',
            'siemię lniane',
            'chia',
            'mleko',
            'orzechy włoskie',
            'orzechy pekan',
            'orzechy brazylijskie',
            'orzechy nerkowca',
            'ser żółty',
            'oliwki',
            'czosnek',
            'szynka krucha',
            'boczek',
            'kefir',
            'gzik',
            'oliwa z oliwek',
            'pierś z kurczaka',
            'jajecznica z cebulą',
            'cebula',
            'szczypiorek',
            'olej lniany',
            'gzik wrzesiński',
        ];

        foreach ($ingredientNames as $name) {
            Ingredient::factory()->create([
                'name' => $name,
            ]);
        }
    }
}
