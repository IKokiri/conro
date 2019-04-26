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
            'open'=>true,
            'price'=>0.5,
            'quantity'=>1
        ];

        $response = $this->json('POST','/api/game/criar',$dados);
        $response->assertStatus(201);

    }



}
