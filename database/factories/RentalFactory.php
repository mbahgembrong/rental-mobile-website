<?php

namespace Database\Factories;

use App\Models\Rental;
use Illuminate\Database\Eloquent\Factories\Factory;

class RentalFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rental::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'pelanggan_id' => $this->faker->word,
        'detail_mobil_id' => $this->faker->word,
        'sopir_id' => $this->faker->word,
        'waktu_peminjaman' => $this->faker->randomDigitNotNull,
        'waktu_mulai' => $this->faker->randomDigitNotNull,
        'waktu_selesai' => $this->faker->randomDigitNotNull,
        'waktu_denda' => $this->faker->randomDigitNotNull,
        'total' => $this->faker->randomDigitNotNull,
        'denda' => $this->faker->randomDigitNotNull,
        'grand_total' => $this->faker->randomDigitNotNull
        ];
    }
}
