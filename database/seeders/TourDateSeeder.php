<?php

namespace Database\Seeders;

use App\Models\TourDate;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TourDateSeeder extends Seeder
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
        $status = ['enabled', 'disabled'];

        foreach (range(1, 500) as $item) {
            $year = $now->year;
            $month = $now->month;
            $day = rand(1, 28);

            $date = date("{$year}-{$month}-{$day}");

            $tourDate = TourDate::factory()->make([
                'tour_id' => rand(1, 100),
                'date' => $date,
                'status' => $status[array_rand($status)]
            ]);

            $data[] = [
                'tour_id' => $tourDate->tour_id,
                'date' => $tourDate->date,
                'status' => $tourDate->status,
                'created_at' => $now->toDateTimeString(),
            ];

            TourDate::upsert($data, ['tour_id', 'date']);
        }
    }
}