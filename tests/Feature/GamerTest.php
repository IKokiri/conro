<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GamerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
    /**
     * Criação do jogador
     */
    public function testStore(){
        $dados = [
            'nickname'=>'lz'
        ];

        $response = $this->json('POST','/api/gamer/criar',$dados);
        $response->assertStatus(201);
    }
}
