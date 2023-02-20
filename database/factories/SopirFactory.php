<?php

namespace Database\Factories;

use App\Models\Sopir;
use Illuminate\Database\Eloquent\Factories\Factory;

class SopirFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Sopir::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nik' => $this->faker->word,
        'nomor_sim' => $this->faker->word,
        'nama' => $this->faker->word,
        'tanggal_lahir' => $this->faker->word,
        'alamat' => $this->faker->text,
        'hp' => $this->faker->word,
        'ktp' => $this->faker->word,
        'sim' => $this->faker->word,
        'email' => $this->faker->word,
        'password' => $this->faker->word,
        'foto' => $this->faker->word
        ];
    }
}
