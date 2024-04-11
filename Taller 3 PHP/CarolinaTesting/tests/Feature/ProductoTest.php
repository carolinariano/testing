<?php

namespace Tests\Feature;

use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test para verificar la creación de un nuevo producto.
     *
     * @return void
     */
    public function testCrearProducto()
    {
        $response = $this->post('/productos', [
            'Producto' => 'Nuevo Producto',
            'Descripcion' => 'Descripción del nuevo producto',
            'Stock' => 10,
            'Precio' => 100,
        ]);

        $response->assertStatus(302); // Redirección después de crear un producto
        $this->assertDatabaseHas('productos', ['Producto' => 'Nuevo Producto']);
    }

    /**
     * Test para verificar la visualización de un producto existente.
     *
     * @return void
     */
    public function testMostrarProducto()
    {
        $producto = Producto::create([
            'Producto' => 'Producto de prueba',
            'Descripcion' => 'Descripción del producto de prueba',
            'Stock' => 5,
            'Precio' => 50,
        ]);

        $response = $this->get("/productos/{$producto->id}");

        $response->assertStatus(200);
        $response->assertSee($producto->Producto);
    }

    /**
     * Test para verificar la actualización de un producto existente.
     *
     * @return void
     */
    public function testActualizarProducto()
    {
        $producto = Producto::create([
            'Producto' => 'Producto a actualizar',
            'Descripcion' => 'Descripción del producto a actualizar',
            'Stock' => 10,
            'Precio' => 100,
        ]);

        $response = $this->put("/productos/{$producto->id}", [
            'Producto' => 'Producto actualizado',
            'Descripcion' => 'Descripción actualizada',
            'Stock' => 20,
            'Precio' => 200,
        ]);

        $response->assertStatus(302); // Redirección después de actualizar un producto
        $this->assertDatabaseHas('productos', ['id' => $producto->id, 'Producto' => 'Producto actualizado']);
    }

    /**
     * Test para verificar la eliminación de un producto existente.
     *
     * @return void
     */
    public function testEliminarProducto()
    {
        $producto = Producto::create([
            'Producto' => 'Producto a eliminar',
            'Descripcion' => 'Descripción del producto a eliminar',
            'Stock' => 5,
            'Precio' => 50,
        ]);

        $response = $this->delete("/productos/{$producto->id}");

        $response->assertStatus(302); // Redirección después de eliminar un producto
        $this->assertDatabaseMissing('productos', ['id' => $producto->id]);
    }

/**
 * Test para verificar la creación de un producto con datos incompletos.
 *
 * @return void
 */
public function testCrearProductoConDatosIncompletos()
{
    // Simular petición con datos incompletos
    $response = $this->withHeaders(['Accept' => 'application/json'])
                    ->post('/productos', [
                        'Producto' => 'Nuevo Producto',
                    ]);

    // Verificar que se reciba un código de estado 422
    $response->assertStatus(422); 
}
/**
 * Test para verificar la creación de un producto con nombre largo
 * 
 *
 * @return void
 */

public function testCrearProductoConNombreLargo()
{
    $productoLargo = str_repeat('a', 256); // Crear una cadena de 256 caracteres
    $response = $this->post('/productos', [
        'Producto' => $productoLargo, // Nombre del producto muy largo
        'Descripcion' => 'Descripción del nuevo producto',
        'Stock' => 10,
        'Precio' => 100,
    ]);

    $response->assertStatus(422); // Verificar que se reciba un código de estado 422
}

/**
 * Test para verificar la creación de un producto sin descripcioon.
 *
 * @return void
 */

public function testCrearProductoSinDescripcion()
{
    $response = $this->post('/productos', [
        'Producto' => 'Nuevo Producto',
        'Stock' => 10,
        'Precio' => 100,
    ]);

    $response->assertStatus(302); // Redirección después de crear un producto
    $this->assertDatabaseHas('productos', ['Producto' => 'Nuevo Producto']); // Verificar que se haya creado el producto
}


/**
 * Test para verificar la creación de un producto con datos incompletos.
 *
 * @return void
 */
public function testCrearProductoSinStock()
{
    $response = $this->post('/productos', [
        'Producto' => 'Nuevo Producto',
        'Descripcion' => 'Descripción del nuevo producto',
        'Precio' => 100,
    ]);

    $response->assertStatus(422); // Verificar que se reciba un código de estado 422
}

public function testCrearProductoSinPrecio()
{
    $response = $this->post('/productos', [
        'Producto' => 'Nuevo Producto',
        'Descripcion' => 'Descripción del nuevo producto',
        'Stock' => 10,
    ]);

    $response->assertStatus(422); // Verificar que se reciba un código de estado 422
}
}
