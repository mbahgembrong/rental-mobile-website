<?php

namespace Database\Factories;

use App\Models\Mobil;
use Illuminate\Database\Eloquent\Factories\Factory;

class MobilFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mobil::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'kategori_id' => $this->faker->word,
        'nama' => $this->faker->word,
        'jenis' => $this->faker->word,
        'type' => $this->faker->word,
        'merk' => $this->faker->word,
        'harga' => $this->faker->randomDigitNotNull,
        'satuan' => $this->faker->word,
        'denda' => $this->faker->randomDigitNotNull
        ];
    }
}
