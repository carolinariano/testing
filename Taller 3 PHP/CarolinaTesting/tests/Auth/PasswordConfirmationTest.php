<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ConfirmPasswordTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Verifica que se pueda renderizar la pantalla de confirmación de contraseña.
     *
     * @return void
     */
    public function testConfirmPasswordScreenCanBeRendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/confirm-password');

        $response->assertStatus(200);
    }

    /**
     * Verifica que se pueda confirmar la contraseña.
     *
     * @return void
     */
    public function testPasswordCanBeConfirmed()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'password',
        ]);

        $response->assertRedirect();
    }

    /**
     * Verifica que la contraseña no se confirme con una contraseña incorrecta.
     *
     * @return void
     */
    public function testPasswordIsNotConfirmedWithInvalidPassword()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post('/confirm-password', [
            'password' => 'wrong-password',
        ]);

        $response->assertSessionDoesntHaveErrors();
    }
}

