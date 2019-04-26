<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
  
    /**
     * Testando a criação de jogo
     */
    public function testStore(){

        $dados = [
            'price'=>0.5
        ];

        $response = $this->json('POST','/api/game/criar',$dados);
        $response->assertStatus(201);

    }

    /**
     * @depends testStore
     * Teste para não posibilitar inserção de um novo jogo se o ultimo estiver fechado
     * o testSotore cria um jogo aberto, dessa forma não deve ser necessário abrir outro jogo sem
     * fechar o atual.
     */
    public function testStoreOpen(){

        $dados = [
            'open'=>true,
            'price'=>0.5,
            'quantity'=>1
        ];

        $response = $this->json('POST','/api/game/criar',$dados);
        $response->assertStatus(403);

    }


}
