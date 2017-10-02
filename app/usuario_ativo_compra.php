<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class usuario_ativo_compra extends Model
{
    public $fillable = ['id','user_id','ativ_cd_id','usac_dt_compra','usac_qt_ativo','usac_vl_compra'];
    
    
   
}
