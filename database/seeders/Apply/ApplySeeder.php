<?php

namespace Database\Seeders\Apply;

use Database\Seeders\DatabaseSeeder;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;
use Domain\Apply\Models\Recruit;

class ApplySeeder extends DatabaseSeeder
{
    public function run(): void
    {
        $user = $this->testUser();

        $companies = Company::factory(10)->for($user)->create();

        $companies->each(function(Company $company) {
            Recruit::factory(10)->for($company)->create();
			Entry::factory(10)->for($company)->create();
		}
        );

    }

}
