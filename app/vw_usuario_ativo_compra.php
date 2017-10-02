<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class vw_usuario_ativo_compra extends Model
{
    public $fillable = ['id','user_id','ativ_cd_id','ativo_cd_ativo','usac_dt_compra','usac_qt_ativo'];
    
    
   
}