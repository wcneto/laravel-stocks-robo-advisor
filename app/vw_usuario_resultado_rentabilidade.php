<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class vw_usuario_resultado_rentabilidade extends Model
{
    public $fillable = ['user_id','limite','financeiro','rentabilidade'];
    
    
   
}