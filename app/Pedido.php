<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    public function produtos(){
       //return $this->belongsToMany('App\Produto', 'pedidos_produtos');

        return $this->belongsToMany('App\Item', 'pedido_produtos', 'pedido_id', 'produto_id')->withPivot('created_at', 'updated_at', 'id');
        /*
         * 1- Modelo de relacionamento NxN em relação o modelo que estamos implementando
         * 2- É a tabela auxiliar que armazena os registros de relacionamento
         * 3- Representa o nome da FK da tabela mapeada pelo modelo na tabela de relacionamento
         * 4- Representa o nome da FK da tabela mapeada pelo model utilizado no relacionamento que estamos implementando
         */
    }
}
