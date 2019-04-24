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

        $response = $this->post('/api/game/criar');
        $response->assertStatus(201);
        
    }
}
