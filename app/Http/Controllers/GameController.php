<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * verifica se existe algum jogo aberto, caso exista não é possivel criar um novo jogo
         */
        $gameCheck = $this->checkOpenGame();
        
        /**
         * Na tentativa de iniciar um novo jogo, caso já exista algum jogo aberto, este será
         * retornado para o usuário
         */
        if($gameCheck->count()){
            return response()->json($gameCheck[0],200);
        }
        
        /**
         * cria o jogo
         */
        $game = new Game();
        $game->price = $request->input('price');
        $game->save();

        return response()->json($game,201);
    }

    /**
     * Verifica se existe algum jogo aberto
     * @return Game
     */
    public function checkOpenGame(){

        $game = Game::where([
            'open'=>1
        ])->get();

        return $game;
    }

  
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $game = Game::find($id);
        $game->delete();
    }

    /**
     * Fecha um jogo aberto
     */
    public function closeGame(Request $request){

        $id = $request->input('id');

        $game = Game::find($id);

        $game->open = false;

        $game->save();

        return response()->json($game,200);

    }

}
