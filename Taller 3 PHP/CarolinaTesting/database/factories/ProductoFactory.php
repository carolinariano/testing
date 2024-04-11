// database/factories/ProductFactory.php

namespace Database\Factories;

use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Producto::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'producto' => $this->faker->sentence,
            'descripcion' => $this->faker->sentence,
            'precio' => $this->faker->randomFloat(2, 0, 100),
            'stock' => $this->faker->numberBetween(0, 1000),
        ];
    }
}