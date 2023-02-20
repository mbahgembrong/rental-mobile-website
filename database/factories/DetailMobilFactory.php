<?php

namespace Database\Factories;

use App\Models\DetailMobil;
use Illuminate\Database\Eloquent\Factories\Factory;

class DetailMobilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DetailMobil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'mobil_id' => $this->faker->word,
        'plat' => $this->faker->word,
        'stnk' => $this->faker->word,
        'tahun_mobil' => $this->faker->word,
        'status' => $this->faker->word
        ];
    }
}
