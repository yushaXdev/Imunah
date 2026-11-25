<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Vaccine;

class VaccineSeeder extends Seeder
{
    public function run(): void
    {
        $vaccines = [
            ['vaccine_name' => 'Pfizer-BioNTech', 'status' => 'Available'],
            ['vaccine_name' => 'Moderna', 'status' => 'Available'],
            ['vaccine_name' => 'AstraZeneca', 'status' => 'Available'],
            ['vaccine_name' => 'Sinopharm', 'status' => 'Available'],
            ['vaccine_name' => 'Johnson & Johnson', 'status' => 'Available'],
            ['vaccine_name' => 'Covaxin', 'status' => 'Available'],
        ];

        foreach ($vaccines as $vaccine) {
            Vaccine::create($vaccine);
        }
    }
}