<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nip' => $this->faker->text(255),
            'nik' => $this->faker->text(255),
            'nama' => $this->faker->text(255),
            'jenis_kelamin' => 'laki_laki',
            'tempat_lahir' => $this->faker->text(255),
            'tanggal_lahir' => $this->faker->date(),
            'telepon' => $this->faker->text(255),
            'agama' => $this->faker->text(255),
            'status_nikah' => 'belum_nikah',
            'alamat' => $this->faker->text(),
        ];
    }
}
