<?php

namespace Database\Factories\Apply;

use Domain\Apply\Models\Company;
use Domain\Apply\Models\Recruit;
use Domain\Shared\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\Domain\Apply\Models\Recruit>
 */
class RecruitFactory extends Factory
{
    protected $model = Recruit::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->words(3,true),
            'description' => $this->faker->paragraph(),
            'start_date' => $this->faker->date(),
            'end_date' => $this->faker->date(),
            'company_id' => Company::factory(),
            'user_id' => User::factory()
        ];
    }
}
