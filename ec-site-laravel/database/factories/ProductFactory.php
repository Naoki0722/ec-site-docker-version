<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = Carbon::now();
        return [
            'category_id' => Category::factory(),
            'title' => $this->faker->word(),
            'description' => $this->faker->text(50),
            'price' => $this->faker->randomNumber,
            'created_at' => $now,
            'updated_at' => $now,

        ];
    }
}
