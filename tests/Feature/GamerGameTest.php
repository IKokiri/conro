<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamerGameTest extends TestCase
{
    
    /**
     * Teste de adição de jogador em jogo
     */
    public function testStore(){

        $dados = [
            'game_id'=>1,
            'gamer_id'=>1
        ];

        $response = $this->json('POST','/api/gameGamer/criar',$dados);
        $response->assertStatus(201);
    }

}
