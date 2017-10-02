<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class vw_usuario_resultado_saldo extends Model
{
    public $fillable = ['user_id','dt_operacao','compras','vendas','acum_compras','acum_vendas','acum_saldo'];
    
    
   
}