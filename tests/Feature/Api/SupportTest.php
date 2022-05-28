<?php

namespace Tests\Feature\Api;

use App\Models\Support;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SupportTest extends TestCase
{
    use UtilsTrait;

    public function test_get_my_supports_unathenticated()
    {
        $response = $this->getJson('/my-supports');

        $response->assertStatus(401);
    }

    public function test_get_my_supports()
    {
        $user = $this-> createUser();
        $token = $user->createToken('teste')->plainTextToken;
        
        //para o usuário
        Support::factory()->count(50)->create([
            'user_id' => $user->id,
        ]);
        
        //aleatorio para testar se response pega o usuário
        Support::factory()->count(50)->create();
        
        $response = $this->getJson('/my-supports', [
            'Authorization' => "Bearer {$token}",
        ]);

        $response->assertStatus(200)
                 ->assertJsonCount(50, 'data');
    }
}
