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

    /**
     * teste de adição de pontos para um jogador
     */
    public function testeAddScore(){
        $dados = [
            'game_id'=>1,
            'gamer_id'=>1,
            'score'=>1
        ];

        $response = $this->json('POST','/api/gameGamer/addScore',$dados);
        $response->assertStatus(200);
    }

    /**
     * remover 1 ponto do jogador
     */
    public function testeSubScore(){
        $dados = [
            'game_id'=>1,
            'gamer_id'=>1,
            'score'=>1
        ];

        $response = $this->json('POST','/api/gameGamer/subScore',$dados);
        $response->assertStatus(200);
    }
}
