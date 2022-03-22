<?php

namespace Database\Seeders;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
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

                $payment = new Payment();
                $payment->user_id = $user->id;
                $payment->total_amount = random_int(100, 1000);
                $payment->created_at = now()->toDateTimeString();
                $payment->updated_at = now()->toDateTimeString();
                $payment->deleted_at = null;

                $payment->save();
            }
        }
    }
}
