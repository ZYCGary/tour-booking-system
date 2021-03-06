<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->times(10)->make();
        $now = Carbon::now();

        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'name' => $user->name,
                'email' => $user->email,
                'password' => $user->password,
                'remember_token' => $user->remember_token,
                'created_at' => $now->toDateTimeString(),
            ];
        }

        User::insert($data);

        // Config a default user
        $defaultUser = User::find(1);
        $defaultUser->name = 'Tester';
        $defaultUser->email = 'test@test.com';
        $defaultUser->save();
    }
}
