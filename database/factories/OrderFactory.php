<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'jumlah_pelanggan' => $this->faker->randomNumber(0),
            'nama_pemesan' => $this->faker->text(255),
            'hari_pesan' => $this->faker->dateTime(),
            'status' => '0',
            'customer_id' => \App\Models\Customer::factory(),
            'table_id' => \App\Models\Table::factory(),
        ];
    }
}
