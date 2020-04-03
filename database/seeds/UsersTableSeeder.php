<?php

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Open the file for reading
        if (($h = fopen(__DIR__."/active.csv", "r")) !== FALSE)
        {
            // Convert each line into the local $data variable
            while (($row = fgetcsv($h, 1000, ",")) !== FALSE)
            {
                // Read the data from a single line
                //dump(Carbon::parse($data[8])->toDateTimeString());
                //dump($data[8]);
                //dump(Carbon::parse($row[8])->getTimestamp());
                //dump(Carbon::parse($row[8])->getTimestamp());
                //dump(Carbon::createFromFormat('m/d/Y H:i:s', $row[8].':00')->toDateTime());
                //dump($row);
///*
                User::create([
                    'name' => $row[3],
                    'email' => $row[3],
                    'password' => bcrypt('password'),
                    'stripe_id' => $row[1],
                    'trial_ends_at' => Carbon::createFromFormat('m/d/Y H:i:s', $row[8].':00')->toDateTime(),
                    'ps_src' => $row[2],
                    'ps_subs' => $row[0],
                ]);
//*/
            }

            // Close the file
            fclose($h);
        }
    }
}
