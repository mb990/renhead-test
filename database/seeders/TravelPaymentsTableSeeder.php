<?php

namespace Database\Seeders;

use App\Models\TravelPayment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelPaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {

            for ($i = 0; $i < 101; $i++) {

                $travelPayment = new TravelPayment();
                $travelPayment->user_id = $user->id;
                $travelPayment->amount = random_int(50, 300);
                $travelPayment->created_at = now()->toDateTimeString();
                $travelPayment->updated_at = now()->toDateTimeString();
                $travelPayment->deleted_at = null;

                $travelPayment->save();
            }
        }
    }
}
