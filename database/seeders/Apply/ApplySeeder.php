<?php

namespace Database\Seeders\Apply;

use Database\Seeders\DatabaseSeeder;
use Domain\Apply\Models\Company;
use Domain\Apply\Models\Entry;
use Domain\Apply\Models\Prefecture;
use Domain\Apply\Models\Recruit;
use Domain\Apply\Models\ShokushuItem;

class ApplySeeder extends DatabaseSeeder
{
	public function run(): void
	{
		$user = $this->testUser();

		$companies = Company::factory(10)->for($user)->create();

		$companies->each(
			function (Company $company) {
				Entry::factory(10)->for($company)->create();
			}
		);

		Prefecture::factory(10)->create();

		$shokushuItems = ShokushuItem::factory(40)->create();
		$recruits = Recruit::factory(100)->create();

		$shokushuItems->each(function ($shokushuItem) use ($recruits) {
            $shokushuItem->recruits()->attach(
                $recruits->random(rand(1, 4))->pluck('id')->toArray()
            );
        });
	}
}
