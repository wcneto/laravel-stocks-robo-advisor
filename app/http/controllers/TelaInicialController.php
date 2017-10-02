<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Laracasts\Flash\FlashNotifier;
use App\Ativo;
use App\Grafico_Linha_Tendencia;
use App\Resultados;
use App\Resultado_Semanal;
use App\Resultado_Consolidado;
use App\Operacoes;
use App\Operacoes_Recentes;
use App\Alertas_Segmento;
use App\Operacoes_Recentes_Potencial;
use App\Operacoes_Semanal;
use App\Operacoes_Estruturada;
use App\Operacoes_Composta;
use App\Alertas;
use App\Alertas_Semanal;
use App\Lucro_Mensal_Semanal;
use App\Lucro_Mensal_Spread_Ratio;
use App\Lucro_Mensal_Spread_Ratio_Composta;
use App\Operacoes_Usuario;
use App\Planejamento_Long;
use App\Planejamento_Short;
use App\Planejamento_Long_Semanal;
use App\Planejamento_Short_Semanal;
use App\Planejamento_Operacoes_Usuario;
use App\Planejamento_Operacoes_Usuario_Anterior;
use App\Lucro_Mensal;
use App\Lucro_Mensal_Usuario;
use App\Lucro_Diario;
use App\Lucro_Diario_Semanal;
use App\Tpop_Chart;
use App\Profit_Chart;
use Illuminate\Support\Facades\Auth;
use App\Resultado_Operacoes_Usuario;
use App\Resultado_Carteira_Usuario;
use App\vw_usuario_ativo_novo;
use App\vw_usuario_resultado_rentabilidade;
use App\vw_usuario_resultado_saldo;
use App\vw_usuario_resultado_detalhado;
use App\Rentabilidade;
use App\Rentabilidade_Semanal;
use App\Rentabilidade_Composta;
use App\Crossover;
use App\Crossover_Semanal;
use App\Crossover_Estruturada;
use App\Crossover_Composta;
use App\vw_oper_rent_aber_long_15;
use App\vw_oper_rent_aber_short_15;
use App\vw_oper_rent_fech_long_15;
use App\vw_oper_rent_aber_long_15_dia_perc;
use App\vw_oper_rent_aber_short_15_dia_perc;
use App\vw_oper_rent_fech_long_15_dia_perc;
use App\indicacoes_adicionais;

class TelaInicialController extends Controller
{
    var $fechamento;
    var $perc;
    var $perc_semanal;

    var $alertas;
    var $alertas_semanal;
    var $fechadas;
    var $name;
    var $perc_usa;
    var $tp_op;
    var $user;
    var $ativo_novo;
    var $modal_id;
    var $grupo_novos;
    var $tot_ativos;
    var $id;
   
    public function tela_inicial()
    {

        $this->fechamento = operacoes::first();
        $this->cota_dt_amanha_dmy = operacoes::first();
        $this->perc = vw_oper_rent_aber_long_15::first();
        $this->perc_dia = vw_oper_rent_aber_long_15_dia_perc::first();
        $this->perc_dia_fech = vw_oper_rent_aber_short_15_dia_perc::first();
        $this->operacoes = vw_oper_rent_aber_long_15::first();

        $this->perc_fech = vw_oper_rent_aber_short_15::first();
        $this->operacoes_fech = vw_oper_rent_aber_short_15::first();
        $dt1 = null; $dt2 = null;$dt3 = null; $dt4 = null;
        $dt5 = null;$dt6 = null; $dt7 = null;
        $data1 = null; $data2 = null;$data3 = null; $data4 = null;
        $data5 = null;$data6 = null; $data7 = null;

        $data8 = null;$data9 = null; $data10 = null;
        $data11 = null;$data12 = null; $data13 = null; $data14 = null;

        $tp_op="Short";
        $this->operacoes_abertas = Operacoes_Recentes_Potencial::selectRaw('perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Long")
            ->where('duracao','<=', 30)
            ->where('duracao','>', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();
     
        foreach ($this->operacoes_abertas as $key => $value) {
            if ($key === 0) {
                $data1 =  $value->perc_dia_acum;
            }
            if ($key === 1) {
                $data2 =  $value->perc_dia_acum;
            }
            if ($key === 2) {
                $data3 =  $value->perc_dia_acum;
            }
            if ($key === 3) {
                $data4 =  $value->perc_dia_acum;
            }
            if ($key === 4) {
                $data5 =  $value->perc_dia_acum;
            }
            if ($key === 5) {
                $data6 =  $value->perc_dia_acum;
            }
            if ($key === 6) {
                $data7 =  $value->perc_dia_acum;
            }
        }
        ;
        $this->operacoes_long_modal = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Long")
            //  ->where('duracao','<=', 21)
            ->where('duracao','>', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->get();

        $this->operacoes_ultimas = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Long")
            //  ->where('duracao','<=', 21)
            ->where('duracao','>', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('duracao','asc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $this->compras_adicionais = indicacoes_adicionais::selectRaw('cotacao_canvas,atse_nm_empresa,id,  tp_op,  situacao,  ativo,  cota_dt_compra,  cota_dt_venda,  cota_vl_compra,  objetivo,  percentual,  cota_vl_fechamento,  objetivo_1,  potencial_1,  objetivo_2,  potencial_2,  objetivo_3,  potencial_3,  media_movel,  ifc')            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Long")
            ->where('ifc','>=', 0.8)
            // ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $tot_compras = $this->compras_adicionais->count();

        $this->vendas_adicionais = indicacoes_adicionais::selectRaw('cotacao_canvas,atse_nm_empresa,id,  tp_op,  situacao,  ativo,  cota_dt_compra,  cota_dt_venda,  cota_vl_compra,  objetivo,  percentual,  cota_vl_fechamento,  objetivo_1,  potencial_1,  objetivo_2,  potencial_2,  objetivo_3,  potencial_3,  media_movel,  ifc')            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Short")
            ->where('ifc','>=', 0.8)
            // ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $tot_vendas = $this->vendas_adicionais->count();

        $this->compras_hoje = Operacoes_Recentes_Potencial::selectRaw('objetivo_1,objetivo_2,objetivo_3,potencial_1,potencial_2,potencial_3,cotacao_canvas,perc_dia_acum,alvo,potencial,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Long")
            ->where('duracao','<=', 30)
            ->where('duracao','=', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            // ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $tot_compras_hoje = $this->compras_hoje->count();

        $this->vendas_hoje = Operacoes_Recentes_Potencial::selectRaw('objetivo_1,objetivo_2,objetivo_3,potencial_1,potencial_2,potencial_3,cotacao_canvas,perc_dia_acum,alvo,potencial,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Short")
            ->where('duracao','<=',30)
            ->where('duracao','=', 0)
            //    ->where('dias_realizacao','=',0)
            ->where('ativ_cd_mercado','=', "IBOV")
            // ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $tot_vendas_hoje = $this->vendas_hoje->count();

        $this->piores = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Long")
            ->where('duracao','<=', 30)
            ->where('duracao','>', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('percentual','asc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $this->fechadas = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('duracao','<=', 30)
            ->where('duracao','>', 0)
            ->where('tp_op','=',"Short")
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('percentual','desc')
            //  ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();
        foreach ($this->fechadas as $key => $value) {
            if ($key === 0) {
                $data8 =  $value->perc_dia_acum;
            }
            if ($key === 1) {
                $data9 =  $value->perc_dia_acum;
            }
            if ($key === 2) {
                $data10 =  $value->perc_dia_acum;
            }
            if ($key === 3) {
                $data11 =  $value->perc_dia_acum;
            }
            if ($key === 4) {
                $data12 =  $value->perc_dia_acum;
            }
            if ($key === 5) {
                $data13 =  $value->perc_dia_acum;
            }
            if ($key === 6) {
                $data14 =  $value->perc_dia_acum;
            }
        }
        ;
        $this->operacoes_short_modal = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Short")
            //  ->where('duracao','<=', 21)
            ->where('duracao','>', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('percentual','desc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->get();

        $this->fechadas_ultimas = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('tp_op','=',"Short")
            ->where('duracao','<=',30)
            ->where('duracao','>', 0)
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('duracao','asc')
            //   ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $this->fechadas_piores = Operacoes_Recentes_Potencial::selectRaw('cotacao_canvas,perc_dia_acum,alvo,potencial,(case when tp_op = "' . $tp_op . '" then (cota_vl_compra-cota_vl_venda) else (cota_vl_venda-cota_vl_compra) end) as lucro,atse_nm_segmento,ativo,tp_op,(case when tp_op = "' . $tp_op . '" then cota_dt_compra_dmy else cota_dt_compra_dmy end) as cota_dt_compra,(case when tp_op = "' . $tp_op . '" then cota_vl_compra else cota_vl_venda end) as cota_vl_compra,(case when tp_op = "' . $tp_op . '" then data_venda_dmy else data_venda_dmy end) as data_venda,(case when tp_op = "' . $tp_op . '" then cota_vl_venda else cota_vl_compra end) as cota_vl_venda,percentual,financeiro,ativ_cd_mercado')
            ->where('situacao','=', "Aberta")
            ->where('duracao','<=', 30)
            ->where('duracao','>', 0)
            ->where('tp_op','=',"Short")
            ->where('ativ_cd_mercado','=', "IBOV")
            ->orderBy('percentual','asc')
            //  ->whereRaw(' ativo in (SELECT ativ_cd_ativo FROM vw_usuario_ativo where id=' . $user->id . ')')
            ->take(7)->get();

        $this->alertas_compra = Alertas_Segmento::selectRaw('fechamento_canvas,cotacao_canvas,atse_nm_empresa,ativo,tp_oper,cotacao_atual,mm21,perc_mm21,ifc,ativ_cd_mercado,cotacao_estimada,perc_cotacao_estimada,observacao,ifc_semanal')
            ->where('ifc','=', 80)
            ->where('ativ_cd_mercado','=', "IBOV")

            ->where('tp_oper','=', "Long")
            ->orderBy('perc_cotacao_estimada','asc')
            ->take(7)->get();

        $this->alertas_compra_modal = Alertas_Segmento::selectRaw('fechamento_canvas,cotacao_canvas,atse_nm_empresa,ativo,tp_oper,cotacao_atual,mm21,perc_mm21,ifc,ativ_cd_mercado,cotacao_estimada,perc_cotacao_estimada,observacao,ifc_semanal')
            ->where('ifc','=', 80)
            ->where('ativ_cd_mercado','=', "IBOV")

            ->where('tp_oper','=', "Long")
            ->orderBy('perc_cotacao_estimada','asc')
            ->get();



        $this->alertas_venda = Alertas_Segmento::selectRaw('fechamento_canvas,cotacao_canvas,atse_nm_empresa,ativo,tp_oper,cotacao_atual,mm21,perc_mm21,ifc,ativ_cd_mercado,cotacao_estimada,perc_cotacao_estimada,observacao,ifc_semanal')
            ->where('ifc','=', 80)
            ->where('ativ_cd_mercado','=', "IBOV")

            ->where('tp_oper','=', "Short")
            ->orderBy('perc_cotacao_estimada','asc')
            ->take(7)->get();

        $this->alertas_venda_modal = Alertas_Segmento::selectRaw('fechamento_canvas,cotacao_canvas,atse_nm_empresa,ativo,tp_oper,cotacao_atual,mm21,perc_mm21,ifc,ativ_cd_mercado,cotacao_estimada,perc_cotacao_estimada,observacao,ifc_semanal')
            ->where('ifc','=', 80)
            ->where('ativ_cd_mercado','=', "IBOV")

            ->where('tp_oper','=', "Short")
            ->orderBy('perc_cotacao_estimada','asc')
            ->get();


        ;
        $this->Planejamento_Long = Planejamento_Long::selectRaw('eixox,cotacao_estimada, Niv1,(case when ativo1="NULL" then null else ativo1 end) as ativo1, Niv2,(case when ativo2="NULL" then null else ativo2 end) as ativo2, Niv3,(case when ativo3="NULL" then null else ativo3 end) as ativo3, Niv4,(case when ativo4="NULL" then null else ativo4 end) as ativo4, Niv5 ,(case when ativo5="NULL" then null else ativo5 end) as ativo5,analise')
            ->get();

        $result4[] = ['eixox', 'A','ativo1',['role' => 'style'],'B','ativo2',['role' => 'style'], 'C','ativo3',['role' => 'style'],'D','ativo4',['role' => 'style'],'E','ativo5',['role' => 'style']];
        foreach ($this->Planejamento_Long as $key => $value) {
            $result4[++$key] = [$value->eixox,$value->Niv1,$value->ativo1 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv2,$value->ativo2 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv3,$value->ativo3 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv4,$value->ativo4 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv5,$value->ativo5 . '(' . $value->cotacao_estimada . ')',$value->analise];
        }

        $this->Planejamento_Short = Planejamento_Short::selectRaw('eixox,cotacao_estimada, Niv1,(case when ativo1="NULL" then null else ativo1 end) as ativo1, Niv2,(case when ativo2="NULL" then null else ativo2 end) as ativo2, Niv3,(case when ativo3="NULL" then null else ativo3 end) as ativo3, Niv4,(case when ativo4="NULL" then null else ativo4 end) as ativo4, Niv5,(case when ativo5="NULL" then null else ativo5 end) as ativo5,analise')
            ->get();
        $result5[] = ['eixox', 'A','ativo1',['role' => 'style'],'B','ativo2',['role' => 'style'], 'C','ativo3',['role' => 'style'],'D','ativo4',['role' => 'style'],'E','ativo5',['role' => 'style']];

        foreach ($this->Planejamento_Short as $key => $value) {
            $result5[++$key] = [$value->eixox,$value->Niv1,$value->ativo1 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv2,$value->ativo2 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv3,$value->ativo3 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv4,$value->ativo4 . '(' . $value->cotacao_estimada . ')',$value->analise,$value->Niv5,$value->ativo5 . '(' . $value->cotacao_estimada . ')',$value->analise];

        }
        $data = array('planejamento_short' => json_encode($result5),'planejamento_long' => json_encode($result4));

       return view('tela_inicial',$data,array('tot_vendas_hoje' =>$tot_vendas_hoje,'tot_compras_hoje' => $tot_compras_hoje,'tot_vendas' =>$tot_vendas,'tot_compras' => $tot_compras,'vendas_adicionais' => $this->vendas_adicionais,'compras_adicionais' => $this->compras_adicionais,'tot_alerta_venda'=> $this->alertas_venda_modal->count(),'tot_alerta_compra'=> $this->alertas_compra_modal->count(),'operacoes_short_modal'=>$this->operacoes_short_modal,'operacoes_long_modal'=>$this->operacoes_long_modal,'alertas_venda'=>$this->alertas_venda,'alertas_venda_modal'=>$this->alertas_venda_modal,'alertas_compra_modal'=>$this->alertas_compra_modal,'alertas_compra'=>$this->alertas_compra,'posicao'=>$this->fechamento,'vendas_melhores1'=>$data8,'vendas_melhores2'=>$data9,'vendas_melhores3'=>$data10,'vendas_melhores4'=>$data11,'vendas_melhores5'=>$data12,'vendas_melhores6'=>$data13,'vendas_melhores7'=>$data14,'compras_melhores1'=>$data1,'compras_melhores2'=>$data2,'compras_melhores3'=>$data3,'compras_melhores4'=>$data4,'compras_melhores5'=>$data5,'compras_melhores6'=>$data6,'compras_melhores7'=>$data7,'perc_dia_fech'=>$this->perc_dia_fech,'perc_dia'=>$this->perc_dia,'posicao' => $this->cota_dt_amanha_dmy,'operacoes_fech'=>$this->operacoes_fech,'perc_fech'=>$this->perc_fech,'fechadas_ultimas'=>$this->fechadas_ultimas,'operacoes_ultimas'=>$this->operacoes_ultimas,'operacoes'=>$this->operacoes,'perc'=>$this->perc,'vendas_hoje'=>$this->vendas_hoje,'compras_hoje'=>$this->compras_hoje,  'fechadas_piores' => $this->fechadas_piores,'piores' => $this->piores,'operacoes_abertas' => $this->operacoes_abertas, 'fechadas' => $this->fechadas,'compras_hoje1'=>$dt1,'compras_hoje2'=>$dt2,'compras_hoje3'=>$dt3,'compras_hoje4'=>$dt4,'compras_hoje5'=>$dt5,'compras_hoje6'=>$dt6,'compras_hoje7'=>$dt7));

    }
  
   
  
}