<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class long_short_semanal_completo extends Model
{
    public $fillable = ['id','tp_op','situacao','ativo','dt_entrada','vl_entrada','dt_saida','vl_saida','financeiro','percentual','tp_op_ls','financeiro_ls','percentual_ls'];



}