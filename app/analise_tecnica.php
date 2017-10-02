<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class usuario_ativo_venda extends Model
{
    public $fillable = ['id','user_id','ativ_cd_id','usav_dt_venda','usav_qt_ativo'];
    
   

}

