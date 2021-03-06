<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PIF</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
</head>
<body>

<div class="card text-center">
  <div class="card-header">

    <div class="row">
      <div class="col-3">
        <button type="button" class="btn btn-light">
          <i class="fas fa-dice" data-id="" id="numJogo"></i>
        </button>
      </div>

      <div class="col-3">
        <button type="button" id="headerAddJogador" class="btn btn-light">
          <i class="fas fa-user-plus"></i>
        </button>
      </div>

      <div class="col-3">
        <button type="button" class="btn btn-light">
          <i class="fas fa-dollar-sign" id="valorGame"></i>
        </button>
      </div>

      <div class="col-3">
        <button type="button" id="fecharJogo" data-id="" class="btn btn-light" onclick="fecharJogo(this.getAttribute('data-id'))">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>
    
  </div>
  <div class="card-body">

    <div class="row">
      <!-- JOGADORES CADASTRADOS PARA JOGO ATUAL -->


      <table class="table table-striped tableJogadoresJogo">
        <thead>
          <tr>
            <th scope="col"><i class="fas fa-minus"></i></th>
            <th scope="col">Sigla</th>
            <th scope="col">Pontos</th>
            <th scope="col">Total</th>
            <th scope="col"><i class="fas fa-plus"></i></th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>  
        <!-- ADICIONAR JOGADOR AO JOGO -->
      <div class='col-12 row divAddJogador'>
        <div class="col-6 ">        
          <div class="alert alert-primary" role="alert">
            <input class="form-control" id="nickname" type="text">
          </div>
        </div>  
        <div class="col-6">        
          <div class="alert alert-secondary" role="alert">
            <button class="btn btn-link" id="adicionarJogadorJogo">
              <i class="fas fa-plus"></i>
            </button>
          </div>
        </div> 
      </div>

    </div>

    <!-- TODOS OS JOGADORES CADASTRADOS -->
    <div class="row divJogadoresCadastrados" id="jogadores">
    </div>
    
  </div>

  <div class="card-footer text-muted divAbrirJogo">
  <footer>

  <button type="button" class="btn btn-light btn-block" onclick="criarJogo()">
    <i class="fas fa-plus"></i>
  </button>

</footer>
  </div>
</div>

</body>
</html>

<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

<script>
// var url = "http://localhost:8000/";
var url="";



function criarJogo(){
  axios({
    method: 'post',
    url: url+'api/game/criar',
    data: {
      price: '0.5'
    }
  }).then(function(response){
    dados = response.data;
    document.getElementById('numJogo').innerHTML = dados.id;
    document.getElementById('valorGame').innerHTML = dados.price;
    document.querySelector('#fecharJogo').setAttribute('data-id',dados.id);
    document.querySelector('#numJogo').setAttribute('data-id',dados.id);
    carregarJogadores();
    carregarJogadoresJogo(dados.id);
  }).catch(function(response){
    
  })
}
setTimeout(function(){
  carregarJogadores()
},1000)

function carregarJogadores(){

  axios({
    method: 'get',
    url: url+'api/gameGamer/gamersValues'
  }).then(function(response){
    
    gamers = response.data;
    
    game_id = document.querySelector('#numJogo').getAttribute('data-id');

    listGamers = "";
    for(gamer in gamers){

      total = gamers[gamer][0].total.toFixed(2);
      color = 'primary';
      if(gamers[gamer][0].total < 0){
        color = 'danger';
      }

      listGamers += `<div class="col-6 text-center">     
                      <div class="alert alert-`+color+`" onclick='adicionarJogadorJogo("`+gamers[gamer][0].nickname+`",`+game_id+`)' role="alert"><h5>`+gamers[gamer][0].nickname+'</h5><h5>'+total+'</h5>'+`</div>
                    </div>`;
    }
    
    document.querySelector('#jogadores').innerHTML = listGamers;

  })

}

function carregarJogadoresJogo(game_id){
  axios({
    method:'get',
    url:url+'api/gameGamer/gamers/'+game_id
  }).then(function(response){
    gamers = response.data;
    tbody = "";
    for(gamer in gamers){

        tbody += `<tr>
        <td onclick='subScore(`+gamers[gamer].gamer_id+`,`+gamers[gamer].game_id+`)'><i class="fas fa-minus"></i></td>
        <td>`+gamers[gamer].nickname+`</td>
        <td>`+gamers[gamer].score+`</td>
        <td>`+gamers[gamer].total+`</td>
        <td onclick='addScore(`+gamers[gamer].gamer_id+`,`+gamers[gamer].game_id+`)'><i class="fas fa-plus"></i></td>
        </tr>`;
    }
    document.querySelector("table>tbody").innerHTML = tbody;
  })
}

function fecharJogo(game){

  axios({
    method:'post',
    url: url+'/api/game/close',
    data:{
      id:game
    }
  }).then(function(response){
    document.querySelector("table>tbody").innerHTML = "";
    document.querySelector(".divAddJogador").style.visibility = "collapse";
    document.querySelector(".divAbrirJogo").style.visibility = "initial";
    document.querySelector(".divJogadoresCadastrados").style.visibility = "initial";
    document.querySelector(".tableJogadoresJogo").style.visibility = "collapse";
    carregarJogadores();

  })
}

document.querySelector('#adicionarJogadorJogo').addEventListener("click",function(){
    
  nickname = document.querySelector("#nickname").value;
  game_id = document.querySelector("#numJogo").getAttribute('data-id');
    
  adicionarJogadorJogo(nickname,game_id);

})

function adicionarJogadorJogo(nickname,game_id){
  axios({
      method:'post',
      url: url+'/api/gameGamer/createGamerGame',
      data:{
        nickname:nickname,
        game_id:game_id
      }
    }).then(function(response){
      carregarJogadores();
      game_id = response.data.original.game_id
      carregarJogadoresJogo(game_id);
    })
}

function subScore(gamer_id,game_id){
  axios({
    method:'post',
    url:url+'/api/gameGamer/subScore',
    data:{
      gamer_id:gamer_id,
      game_id:game_id
    }
  }).then(function(response){
    carregarJogadoresJogo(game_id)
  })
}

function addScore(gamer_id,game_id){
  axios({
    method:'post',
    url:url+'/api/gameGamer/addScore',
    data:{
      gamer_id:gamer_id,
      game_id:game_id
    }
  }).then(function(response){
    carregarJogadoresJogo(game_id)
  })
}

document.querySelector("#numJogo").addEventListener('click',function(){
  
  document.querySelector(".divAddJogador").style.visibility = "collapse";
  document.querySelector(".divAbrirJogo").style.visibility = "collapse";
  document.querySelector(".divJogadoresCadastrados").style.visibility = "collapse";
  document.querySelector(".tableJogadoresJogo").style.visibility = "initial";

})
document.querySelector("#headerAddJogador").addEventListener('click',function(){
  document.querySelector(".divAddJogador").style.visibility = "initial";
  document.querySelector(".divAbrirJogo").style.visibility = "collapse";
  document.querySelector(".divJogadoresCadastrados").style.visibility = "initial";
  document.querySelector(".tableJogadoresJogo").style.visibility = "initial";
  
})

document.querySelector("#fecharJogo").addEventListener('click',function(){
  document.querySelector(".divAddJogador").style.visibility = "initial";
  document.querySelector(".divAbrirJogo").style.visibility = "initial";
  document.querySelector(".divJogadoresCadastrados").style.visibility = "initial";
  document.querySelector(".tableJogadoresJogo").style.visibility = "initial";
  
})
</script>
