<?php

namespace Database\Factories\Apply;

use Domain\Apply\Models\Prefecture;
use Illuminate\Database\Eloquent\Factories\Factory;

class PrefectureFactory extends Factory
{
	protected $model = Prefecture::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'area_name' => $this->faker->address(),
            'name' => $this->faker->address(),
        ];
    }
}
