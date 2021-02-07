<?php

namespace Database\Factories;

use App\Models\Image;
use App\Models\Product;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Image::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $now = Carbon::now();
        return [
            'product_id' => Product::factory(),
            'image_url' => $this->faker->realText(20),
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }
}
