<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GameTest extends TestCase
{
  
    private $id;
    /**
     * Testando a criação de jogo
     */
    public function testStore(){

        $dados = [
            'id'=>7000,
            'open'=>true,
            'price'=>0.5,
            'quantity'=>1
        ];

        $response = $this->json('POST','/api/game/criar',$dados);
        $response->assertStatus(201);

    }

    public function testDestroy(){

        $response = $this->json('DELETE','/api/game/remover/7000');
        $response->assertStatus(200);
    }

}
