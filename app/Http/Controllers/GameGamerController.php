<?php

namespace App\Http\Controllers;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamerController;
use Illuminate\Http\Request;
use App\GameGamer;

class GameGamerController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $gameGamer = new GameGamer();
        $gameGamer->game_id = $request->input('game_id');
        $gameGamer->gamer_id = $request->input('gamer_id');
        $gameGamer->save();
        return response()->json($gameGamer,201);
    }

      /**
     * Atualiza a pontuação de um jogador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addScore(Request $request){

        $gameGamer = GameGamer::firstOrFail()->where(['game_id'=>1])->where(['gamer_id'=>1])->first();
        $gameGamer->score++;
        $gameGamer->save();
        return response()->json($gameGamer,200);
    }

       /**
     * Atualiza a pontuação de um jogador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function subScore(Request $request){

        $gameGamer = GameGamer::firstOrFail()->where(['game_id'=>1])->where(['gamer_id'=>1])->first();
        $gameGamer->score--;
        $gameGamer->save();
        return response()->json($gameGamer,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
    }
    /**
     * Criação de usuário quando não existe e adição no jogo
     */
    public function createGamerGame(Request $request){
        /**
         * Busca no banco existencia de gamer
         */
        $game_id = $request->input('game_id');
        $nickname = $request->input('nickname');
        $gamer = new GamerController();
        
        $gr = $gamer->findGamerNick($request);
        
        /**
         * CASO O USUÁRIO NÃO EXISTA NO BANCO, SERÁ CRIADO
         */
        if(!$gr){
            $gr = $gamer->store($request);
            $gr = json_decode($gr->getContent());
        }

        $request->request->add(['gamer_id'=>$gr->id]);

        $gameGamer = $this->store($request);
        
        return response()->json($gameGamer,201);
        
    }
}
