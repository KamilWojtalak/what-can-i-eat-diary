<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Day;
use Carbon\Carbon;

class DaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $startDate = Carbon::create(2024, 12, 7);
        $endDate = Carbon::now();

        while ($startDate->lte($endDate)) {
            Day::factory()->create([
                'date' => $startDate->toDateString(),
                'day_of_the_week' => $startDate->format('l'),
            ]);

            $startDate->addDay();
        }
    }
}
