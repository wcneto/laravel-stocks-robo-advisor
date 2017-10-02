<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class vw_usuario_ativo_venda extends Model
{
    public $fillable = ['id','user_id','ativ_cd_id','ativo_cd_ativo','usav_dt_venda','usav_qt_ativo'];
    
    
   
}