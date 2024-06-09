<?php

namespace Database\Seeders\Apply;


use Database\Seeders\DatabaseSeeder;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Recruit;

class ApplySeeder extends DatabaseSeeder
{
    public function run(): void
    {
        $testUser = $this->testUser();

        $companies = Company::factory()->count(10)->for($testUser)->create();

        $companies->each(function (Company $company) use ($testUser) {
            Recruit::factory()->count(10)->for($company)->for($testUser)->create();
        });

    }
}
