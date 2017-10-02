<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
class vw_usuario_resultado_detalhado extends Model {

    //protected $fillable = array('url', 'title', 'description', 'content', 'image', 'blog', 'category_id');

    //protected $primaryKey = 'id';
    // protected $table = 'operacoes_mes';
    protected $fillable = ['user_id','usac_dt_compra','tipo_de_operacao','quantidades_negociadas','ativos_negociados','cotacoes_negociadas','compras_negociadas','vendas_negociadas','negociado_no_dia'];
}
