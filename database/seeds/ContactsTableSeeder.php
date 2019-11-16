<?php

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Contact::truncate(); // เคลีย์ ข้อมูล

        $faker = \Faker\Factory::create();

        $faker->locale('th_TH');

        // And now, let's create a few articles in our database:
        for ($i = 0; $i < 50; $i++) {
            Contact::create([
                'name' => $faker->name,
                'birthdate' => $faker->date($format = 'Y-m-d', $max = 'now'),

                'phone_number' => $faker->phoneNumber,
                'email' => $faker->email,
                'line' => $faker->userName,

                'address' => $faker->address,
                // 'current_location' => $faker->address,

                // 'ssn' => $faker->ssn,
                'company' => $faker->company,
                'job' => $faker->jobTitle,

                'remarks' => $faker->paragraph,
            ]);
        }
        // factory(Contact::class, 50)->create();
    }
}
