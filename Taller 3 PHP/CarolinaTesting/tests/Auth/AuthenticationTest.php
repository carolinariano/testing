<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase; // Para restablecer la base de datos después de cada prueba
    use WithFaker; // Para generar datos falsos

    /**
     * Verifica que la pantalla de inicio de sesión se pueda renderizar.
     *
     * @return void
     */
    public function testLoginScreenCanBeRendered()
    {
        $response = $this->get('/login');

        $response->assertStatus(200);
    }

    /**
     * Verifica que los usuarios no puedan autenticarse con una contraseña inválida.
     *
     * @return void
     */
    public function testUsersCannotAuthenticateWithInvalidPassword()
    {
        $user = User::factory()->create();

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $response->assertSessionHasErrors();
        $this->assertGuest();
    }

    /**
     * Verifica que los usuarios puedan cerrar sesión.
     *
     * @return void
     */
    public function testUsersCanLogout()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/logout');

        $this->assertGuest();
        $response->assertRedirect('/');
    }
}
