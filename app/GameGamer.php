<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameGamer extends Model
{

    public function gamers(){
        return $this->belongsToMany('App\Gamer','gamer_id',"id");
    }

}
