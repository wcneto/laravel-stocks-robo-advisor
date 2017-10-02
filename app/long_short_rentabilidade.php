<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class long_short_rentabilidade extends Model
{
    public $fillable = ['id','correlacao','financeiro','percentual','financeiro_ls','percentual_ls','limite_qt_ativo','descricao','data_entrada','data_saida','ativo','tipo_operacao'];

    
   
}