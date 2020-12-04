<?php

namespace Database\Seeders;

use App\Models\Tour;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TourSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $now = Carbon::now();
        $status = ['public', 'draft'];

        foreach (range(1, 100) as $index) {
            $tour = Tour::factory()->make([
                'user_id' => rand(1, 10),
                'status' => $status[array_rand($status)]
            ]);

            $data[] = [
                'user_id' => $tour->user_id,
                'name' => $tour->name,
                'itinerary' => $tour->itinerary,
                'status' => $tour->status,
                'created_at' => $now->toDateTimeString(),
            ];
        }

        Tour::insert($data);
    }
}
