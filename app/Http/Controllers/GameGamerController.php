<?php

namespace App\Http\Controllers;
use App\Http\Controllers\GameController;
use App\Http\Controllers\GamerController;
use Illuminate\Http\Request;
use App\GameGamer;
use Illuminate\Support\Facades\DB;


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
        
        if($this->checkGameGamer($gameGamer)){            
            return response()->json($gameGamer,403);
        }else{            
            $gameGamer->save();
            return response()->json($gameGamer,201);
        }
        
    }
    /**
     * Verifica se game e gamer ja existe
     * @return boolean
     */
    public function checkGameGamer($gameG){
       
        $game_id = $gameG->game_id;
        $gamer_id = $gameG->gamer_id;

        return $gameGamer = GameGamer::where(['game_id'=>$game_id,'gamer_id'=>$gamer_id])->count();
    }

      /**
     * Atualiza a pontuação de um jogador
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addScore(Request $request){

        $game_id = $request->input('game_id');
        $gamer_id = $request->input('gamer_id');

        $gameGamer = GameGamer::firstOrFail()->where(['game_id'=>$game_id])->where(['gamer_id'=>$gamer_id])->first();
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


        $game_id = $request->input('game_id');
        $gamer_id = $request->input('gamer_id');

        $gameGamer = GameGamer::firstOrFail()->where(['game_id'=>$game_id])->where(['gamer_id'=>$gamer_id])->first();
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

    /**
     * busca todos os jogadores de um jogo
     */
    public function findGamers($id){

        $dados = DB::table('game_gamers')
        ->join('gamers','gamer_id','=','gamers.id')
        ->select('gamers.nickname','gamers.id','game_gamers.score')->where(['game_id'=>$id])->get();
        
        return response($dados,200);
    }
}
