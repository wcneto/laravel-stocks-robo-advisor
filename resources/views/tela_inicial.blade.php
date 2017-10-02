{{-- Load Layout Body Classes --}}
@extends('layouts.tela_inicial')

{{-- Load Auth Layout Head --}}
@section('layout-head')
    {{-- Load Common Admin Head --}}
    @include('admin.structure.head')


@stop
@section('layout-header')
    @include('admin.partials.header')
    @include('admin.partials.dashboard-sidebar')
@stop

@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/css/bootstrap.min.css">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css">

    <!-- Metis core stylesheet -->
    <link rel="stylesheet" href="http://simulador.simpleinvest.com.br/public/assets/css/main.min.css">

    <!-- metisMenu stylesheet -->
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/metisMenu/1.1.3/metisMenu.min.css">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.2.5/fullcalendar.min.css">


    <div id="page-wrapper">
        <div class="row" >


            <div class="col-md-6">
                <!-- Line chart -->
                <div class="box box-primary" style="height: 385px">
                    <div class="box-header with-border">
                        <i class="fa fa-download"></i>
                        <h3 class="box-title">Oportunidades para Compra - HOJE - {!!$posicao['cota_dt_amanha_dmy']!!}</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="modal" data-target="#AlertaCompra">
                                <small>Ver Avaliações</small>
                                <span class="caret"></span>
                            </button>

                        </div>

                    </div>
                    <div class="tab-content">
                        <ul class="nav nav-tabs" id="TabComprasHoje" role="tablist">

                            <li class="active"><a href="#actives" role="tab" data-toggle="tab"><i class="fa fa-flash"></i><small> Indicações ({{$tot_compras_hoje}})</small></a></li>
                            <li><a href="#gainers" role="tab" data-toggle="tab"><i class="fa fa-pencil-square-o "></i><small> Em avaliação</small></a></li>
                            <li><a href="#losers" role="tab" data-toggle="tab"><i class="fa fa-binoculars"></i><small> Planejamento</small></a></li>
                            <li><a href="#followers" role="tab" data-toggle="tab"><i class="fa fa-hand-o-up"></i><small> Indicações Adicionais ({{$tot_compras}})</small></a></li>


                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="actives">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Obj. #1</small></th>
                                        <th><small>% Pot. #1</small></th>
                                        <th><small>Obj. #2</small></th>
                                        <th><small>% Pot. #2</small></th>

                                        <th><small>Gráfico</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($compras_hoje  as $index =>  $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>

                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>

                                            <td><small>{{number_format($operacao->objetivo_3,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial_3,2)}}</small></td>



                                            <td> <a href="#" data-toggle="modal" data-target="#Grafico_compras_hoje<?php echo $index+1;?>"><small> Abrir</small></a></td>


                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de compra foi confirmada em {!!$posicao['fechamento']!!} .</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="gainers">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>Alvo</small></th>
                                        <th><small>% Alvo</small></th>
                                        <th><small>Gráfico</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($alertas_compra  as $index =>  $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_empresa}}</small></td>

                                            <td><small>{{number_format($operacao->cotacao_atual,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cotacao_estimada,2)}}</small></td>

                                            <td><small>{{number_format($operacao->perc_cotacao_estimada,2)}}</small></td>
                                            <td> <a href="#" data-toggle="modal" data-target="#Grafico_alertas_compra<?php echo $index+1;?>"><small> Abrir</small></a></td>




                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma avaliação de compra disponível. .</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="losers">

                                <div id="container" style="width: 300px; height: 240px;"></div>


                            </div>
                            <div  class="tab-pane fade" id="followers">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Obj. #1</small></th>
                                        <th><small>%Pot. #1</small></th>
                                        <th><small>Obj. #2</small></th>
                                        <th><small>%Pot. #2</small></th>
                                        <th><small>Gráfico</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($compras_adicionais  as $index =>  $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_empresa}}</small></td>

                                            <td><small>{{number_format($operacao->cota_vl_fechamento,2)}}</small></td>

                                            <td><small>{{number_format($operacao->objetivo_1,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial_1,2)}}</small></td>

                                            <td><small>{{number_format($operacao->objetivo_3,2)}}</small></td>

                                            <td><small>{{number_format($operacao->potencial_3,2)}}</small></td>


                                            <td> <a href="#" data-toggle="modal" data-target="#Grafico_indicacoes_compra<?php echo $index+1;?>"><small> Abrir</small></a></td>


                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma avaliação de venda disponível.</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <!-- /.box-body-->
                </div>
                <!-- /.box -->

                <!-- Area chart -->
                <div class="box box-primary" style="height: 385px">
                    <div class="box-header with-border">
                        <i class="fa fa-share-square-o"></i>

                        <h3 class="box-title">Ações em momento ideal para venda - HOJE - {!!$posicao['cota_dt_amanha_dmy']!!}</h3>
                        <div class="box-tools pull-right">
                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="modal" data-target="#AlertaVenda">
                                    <small>Ver Avaliações</small>
                                    <span class="caret"></span>
                                </button>

                            </div>
                        </div>

                    </div>
                    <div class="box-body">
                        <ul class="nav nav-tabs" id="TabVendasHoje" role="tablist">
                            <li class="active">
                                <a href="#actives1" role="tab" data-toggle="tab"><i class="fa fa-flash"></i><small> Indicações ({{$tot_vendas_hoje}})</small></a></li>
                            <li><a href="#gainers1" role="tab" data-toggle="tab"><i class="fa fa-pencil-square-o "></i><small> Em avaliação</small></a></li>
                            <li><a href="#losers1" role="tab" data-toggle="tab"><i class="fa fa-binoculars"></i><small> Planejamento</small></a></li>
                            <li>
                                <a href="#followers1" role="tab" data-toggle="tab"><i class="fa fa-hand-o-down"></i><small> Indicações Adicionais ({{$tot_vendas}})</small></a></li>

                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="actives1">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Obj. #1</small></th>
                                        <th><small>% Pot. #1</small></th>
                                        <th><small>Obj. #2</small></th>
                                        <th><small>% Pot. #2</small></th>

                                        <th><small>Gráfico</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($vendas_hoje  as $index =>  $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>

                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>

                                            <td><small>{{number_format($operacao->objetivo_3,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial_3,2)}}</small></td>



                                            <td> <a href="#" data-toggle="modal" data-target="#Grafico_vendas_hoje<?php echo $index+1;?>"><small> Abrir</small></a></td>


                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de venda foi confirmada em {!!$posicao['fechamento']!!} .</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="gainers1">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>Alvo</small></th>
                                        <th><small>% Alvo</small></th>
                                        <th><small>Gráfico</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($alertas_venda  as $index =>  $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_empresa}}</small></td>

                                            <td><small>{{number_format($operacao->cotacao_atual,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cotacao_estimada,2)}}</small></td>

                                            <td><small>{{number_format($operacao->perc_cotacao_estimada,2)}}</small></td>




                                            <td> <a href="#" data-toggle="modal" data-target="#Grafico_alertas_venda<?php echo $index+1;?>"><small> Abrir</small></a></td>


                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma avaliação de venda disponível.</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div  class="tab-pane fade" id="losers1">

                                <div id="container2" style="width: 300px; height: 240px;"></div>

                            </div>
                            <div  class="tab-pane fade" id="followers1">

                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Obj. #1</small></th>
                                        <th><small>%Pot. #1</small></th>
                                        <th><small>Obj. #2</small></th>
                                        <th><small>%Pot. #2</small></th>
                                        <th><small>Gráfico</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($vendas_adicionais  as $index =>  $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>

                                            <td><small>{{$operacao->atse_nm_empresa}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_fechamento,2)}}</small></td>
                                            <td><small>{{number_format($operacao->objetivo_1,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial_1,2)}}</small></td>

                                            <td><small>{{number_format($operacao->objetivo_3,2)}}</small></td>

                                            <td><small>{{number_format($operacao->potencial_3,2)}}</small></td>

                                            <td> <a href="#" data-toggle="modal" data-target="#Grafico_indicacoes_venda<?php echo $index+1;?>"><small> Abrir</small></a></td>




                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma avaliação de venda disponível.</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>

                            </div>
                        </div>

                    </div>
                    <!-- /.box-body-->
                </div>
                <!-- /.box -->

            </div>
            <!-- /.col -->

            <div   class="col-md-6">
                <!-- Bar chart -->
                <div class="box box-primary" style="height: 385px">
                    <div class="box-header with-border">
                        <i class="fa fa-line-chart"></i>

                        <h3 class="box-title">Indicações de compra últimos 30 dias - Lucro até o momento</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="modal" data-target="#OperacoesCompra">
                                <small>Ver Operações</small>
                                <span class="caret"></span>
                            </button>

                        </div>

                    </div>
                    <div class="box-body" >
                        <ul class="nav nav-tabs" role="tablist" >

                            <li class="active"><a href="#actives2" role="tab" data-toggle="tab"><i class="fa fa-level-up"></i><small> Melhores</small></a></li>
                            <li><a href="#gainers2" role="tab" data-toggle="tab"><i class="fa fa-level-down"></i><small> Piores</small></a></li>
                            <li><a href="#losers2" role="tab" data-toggle="tab"><i class="fa fa-hourglass "></i><small> Últimas</small></a></li>

                            <div id="wrapper">
                                <div id="one">  </div>

                                <div id="two">
                                    <span> <i class=""></i><small><b>     Média: </b></small></span>
                                    <?php
                                    $perc=$perc['perc'];
                                    $classname = number_format($perc['perc'],2) < 0 ? 'red' : 'green';
                                    print "<span class='inv-$classname'>$perc%</span>";
                                    ?>
                                </div>
                                <div id="one">  </div>
                                <div id="three">

                                    <span class="percent up"> <i class=""></i><b><small>Qtd.Op.: {!!$operacoes['operacoes']!!}</small></b></span>


                                </div>

                                <div id="one">  </div>
                                <div id="four"><b><small>% por dia</small></b>


                                    <span id="dow"><small><small>Loading..</small></small></span>

                                </div>

                            </div>

                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="actives2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Data</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>% Lucro</small></th>
                                        <th><small>Objetivo</small></th>
                                        <th><small>% Pot.</small></th>
                                        <th><small>% Acum. no dia</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($operacoes_abertas as $index => $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{$operacao->cota_dt_compra}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>
                                            <td><small><?php
                                                    $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                                    print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                                    ?></small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>
                                            <td><small><small> <span id="compras_melhores<?php echo $index+1;?>">Loading..</span></small> </small></td>

                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de compra nos últimos 30 dias.</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="gainers2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Data</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>% Lucro</small></th>
                                        <th><small>Objetivo</small></th>
                                        <th><small>% Pot.</small></th>
                                        <th><small>% Acum. no dia</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($piores as $index => $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{$operacao->cota_dt_compra}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>
                                            <td><small><?php
                                                    $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                                    print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                                    ?></small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>
                                            <td><small> <span class="inlinesparkline">{{$operacao->perc_dia_acum}}</span></small></td>
                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de compra nos últimos 30 dias.</font></tr>

                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="losers2">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Data</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>% Lucro</small></th>
                                        <th><small>Objetivo</small></th>
                                        <th><small>% Pot.</small></th>
                                        <th><small>% Acum. no dia</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($operacoes_ultimas as $index => $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{$operacao->cota_dt_compra}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>
                                            <td><small><?php
                                                    $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                                    print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                                    ?></small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>
                                            <td><small> <span class="inlinesparkline">{{$operacao->perc_dia_acum}}</span></small></td>
                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de compra nos últimos 30 dias.</font></tr>

                                    @endforelse

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body-->
                </div>
                <!-- /.box -->

                <!-- Donut chart -->
                <div class="box box-primary" style="height: 385px">
                    <div class="box-header with-border">
                        <i class="fa fa-bar-chart-o"></i>

                        <h3 class="box-title">Indicações de venda últimos 30 dias - Lucro até o momento</h3>
                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="modal" data-target="#OperacoesVenda">
                                <small>Ver Operações</small>
                                <span class="caret"></span>
                            </button>

                        </div>
                    </div>
                    <div class="box-body">
                        <ul class="nav nav-tabs" role="tablist">

                            <li class="active"><a href="#actives3" role="tab" data-toggle="tab"><i class="fa fa-level-up"></i><small> Melhores</small></a></li>
                            <li><a href="#gainers3" role="tab" data-toggle="tab"><i class="fa fa-level-down"></i><small> Piores</small></a></li>
                            <li><a href="#losers3" role="tab" data-toggle="tab"><i class="fa fa-hourglass "></i><small> Últimas</small></a></li>

                            <div id="wrapper">
                                <div id="one">     </div>

                                <div id="two">
                                    <span > <i class=""></i><small><b>     Média: </b></small></span>


                                    <?php
                                    $perc=$perc_fech['perc'];
                                    $classname = number_format($perc_fech['perc'],2) < 0 ? 'red' : 'green';
                                    print "<span class='inv-$classname'>$perc%</span>";
                                    ?>

                                </div>
                                <div id="one">  </div>
                                <div id="three">

                                    <span class="percent up"> <i class=""></i><b><small>Qtd.Op.: {!!$operacoes_fech['operacoes']!!}</small></b></span>


                                </div>
                                <div id="one">  </div>
                                <div id="four"><b><small>% por dia</small></b>
                                    <span id="dow1"><small><small>Loading..</small></small></span>

                                </div>

                            </div>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade in active" id="actives3">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>


                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Data</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>% Lucro</small></th>
                                        <th><small>Objetivo</small></th>
                                        <th><small>% Pot.</small></th>
                                        <th><small>% Acum. no dia</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($fechadas as $index => $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{$operacao->cota_dt_compra}}</small></td>

                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>

                                            <td><small><?php
                                                    $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                                    print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                                    ?></small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>
                                            <td><small><small> <span id="vendas_melhores<?php echo $index+1;?>">Loading..</span></small> </small></td>

                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de venda nos últimos 30 dias.</font></tr>

                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="gainers3">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Data</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>% Lucro</small></th>
                                        <th><small>Objetivo</small></th>
                                        <th><small>% Pot.</small></th>
                                        <th><small>% Acum. no dia</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($fechadas_piores as $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{$operacao->cota_dt_compra}}</small></td>


                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                            <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td><td><small><?php
                                                    $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                                    print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                                    ?></small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>
                                            <td><small> <span class="inlinesparkline">{{$operacao->perc_dia_acum}}</span></small></td>




                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de venda nos últimos 30 dias.</font></tr>

                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div class="tab-pane fade" id="losers3">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th><small>Código</small></th>
                                        <th><small>Empresa</small></th>
                                        <th><small>Data</small></th>
                                        <th><small>Preço</small></th>
                                        <th><small>Preço Atual</small></th>
                                        <th><small>% Lucro</small></th>
                                        <th><small>Objetivo</small></th>
                                        <th><small>% Pot.</small></th>
                                        <th><small>% Acum. no dia</small></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse ($fechadas_ultimas as $operacao)
                                        <tr>
                                            <td><small>{{$operacao->ativo}}</small></td>
                                            <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                            <td><small>{{$operacao->cota_dt_compra}}</small></td>


                                            <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>

                                            <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>
                                            <td><small><?php
                                                    $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                                    print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                                    ?></small></td>
                                            <td><small>{{number_format($operacao->alvo,2)}}</small></td>
                                            <td><small>{{number_format($operacao->potencial,2)}}</small></td>
                                            <td><small> <span class="inlinesparkline">{{$operacao->perc_dia_acum}}</span></small></td>





                                        </tr>
                                    @empty
                                        <tr><font color="red">Nenhuma indicação de venda nos últimos 30 dias.</font></tr>

                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body-->
                </div>

                <!-- /.box -->
            </div>
        </div>


        <div class="modal fade" id="AlertaCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Avaliações de Compra</h4>
                    </div>
                    <div class="modal-body">
                        <table id="alertacompras" class="table table-striped table-hover responsive">

                            <thead>
                            <tr>
                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>Alvo</small></th>
                                <th><small>% Alvo</small></th>
                                <th><small>Gráfico</small></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>Alvo</small></th>
                                <th><small>% Alvo</small></th>
                                <th><small>Gráfico</small></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse ($alertas_compra_modal as $index => $operacao)
                                <tr>
                                    <td><small>{{$operacao->ativo}}</small></td>
                                    <td><small>{{$operacao->atse_nm_empresa}}</small></td>

                                    <td><small>{{number_format($operacao->cotacao_atual,2)}}</small></td>
                                    <td><small>{{number_format($operacao->cotacao_estimada,2)}}</small></td>

                                    <td><small>{{number_format($operacao->perc_cotacao_estimada,2)}}</small></td>


                                    <td><small> <span class="inlinesparkline">{{$operacao->fechamento_canvas}}</span></small></td>


                                </tr>
                            @empty
                                <tr><font color="red">Nenhuma avaliação de compra disponível. .</font></tr>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="AlertaVenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"t>Avaliações de Venda</h4>
                    </div>
                    <div class="modal-body">
                        <table id="alertavendas" class="table table-striped table-hover responsive">

                            <thead>
                            <tr>
                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>Alvo</small></th>
                                <th><small>% Alvo</small></th>
                                <th><small>Gráfico</small></th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>Alvo</small></th>
                                <th><small>% Alvo</small></th>
                                <th><small>Gráfico</small></th>
                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse ($alertas_venda_modal as $operacao)
                                <tr>
                                    <td><small>{{$operacao->ativo}}</small></td>
                                    <td><small>{{$operacao->atse_nm_empresa}}</small></td>

                                    <td><small>{{number_format($operacao->cotacao_atual,2)}}</small></td>
                                    <td><small>{{number_format($operacao->cotacao_estimada,2)}}</small></td>

                                    <td><small>{{number_format($operacao->perc_cotacao_estimada,2)}}</small></td>


                                    <td><small> <span class="inlinesparkline">{{$operacao->fechamento_canvas}}</span></small></td>



                                </tr>
                            @empty
                                <tr><font color="red">Nenhuma avaliação de venda disponível. .</font></tr>

                            @endforelse

                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>





        <div class="modal fade" id="OperacoesCompra" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document" >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> Todas as indicações de compra - Lucro até o momento</h4>
                    </div>
                    <div class="modal-body">

                        <table id="operacoescompras" class="table table-striped table-hover responsive">
                            <thead>
                            <tr>
                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Data</small></th>
                                <th><small>Preço</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>% Lucro</small></th>
                                <th><small>Objetivo</small></th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr>
                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Data</small></th>
                                <th><small>Preço</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>% Lucro</small></th>
                                <th><small>Objetivo</small></th>


                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse ($operacoes_long_modal as $index => $operacao)
                                <tr>
                                    <td><small>{{$operacao->ativo}}</small></td>
                                    <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                    <td><small>{{$operacao->cota_dt_compra}}</small></td>
                                    <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                    <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>
                                    <td><small><?php
                                            $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                            print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                            ?></small></td>
                                    <td><small>{{number_format($operacao->alvo,2)}}</small></td>

                                </tr>
                            @empty
                                <tr><font color="red">Nenhuma indicação de compra nos últimos 30 dias.</font></tr>

                            @endforelse

                            </tbody>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="OperacoesVenda" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel"> Todas as indicações de venda - Lucro até o momento</h4>
                    </div>
                    <div class="modal-body">
                        <table id="operacoesvendas" class="table table-striped table-hover responsive">
                            <thead>
                            <tr>


                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Data</small></th>
                                <th><small>Preço</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>% Lucro</small></th>
                                <th><small>Objetivo</small></th>


                            </tr>
                            </thead>
                            <tfoot>
                            <tr>


                                <th><small>Código</small></th>
                                <th><small>Empresa</small></th>
                                <th><small>Data</small></th>
                                <th><small>Preço</small></th>
                                <th><small>Preço Atual</small></th>
                                <th><small>% Lucro</small></th>
                                <th><small>Objetivo</small></th>


                            </tr>
                            </tfoot>
                            <tbody>
                            @forelse ($operacoes_short_modal as $index => $operacao)
                                <tr>
                                    <td><small>{{$operacao->ativo}}</small></td>
                                    <td><small>{{$operacao->atse_nm_segmento}}</small></td>
                                    <td><small>{{$operacao->cota_dt_compra}}</small></td>

                                    <td><small>{{number_format($operacao->cota_vl_venda,2)}}</small></td>
                                    <td><small>{{number_format($operacao->cota_vl_compra,2)}}</small></td>

                                    <td><small><?php
                                            $classname = number_format($operacao->percentual,2) < 0 ? 'red' : 'green';
                                            print "<span class='inv-$classname'>$operacao->percentual%</span>";
                                            ?></small></td>
                                    <td><small>{{number_format($operacao->alvo,2)}}</small></td>

                                </tr>
                            @empty
                                <tr><font color="red">Nenhuma indicação de venda nos últimos 30 dias.</font></tr>

                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    </div>
                </div>
            </div>
        </div>

        @forelse ($alertas_compra  as $index =>  $operacao)
            <div class="modal fade" id="Grafico_alertas_compra<?php echo $index+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alertas_compra_Container<?php echo $index+1;?>" style="width: 100%; height: 400px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty


        @endforelse
        @forelse ($alertas_venda  as $index =>  $operacao)
            <div class="modal fade" id="Grafico_alertas_venda<?php echo $index+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="alertas_venda_Container<?php echo $index+1;?>" style="width: 100%; height: 400px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty


        @endforelse
        @forelse ($compras_hoje  as $index =>  $operacao)
            <div class="modal fade" id="Grafico_compras_hoje<?php echo $index+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="compras_hoje_Container<?php echo $index+1;?>" style="width: 100%; height: 400px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty


        @endforelse
        @forelse ($vendas_hoje  as $index =>  $operacao)
            <div class="modal fade" id="Grafico_vendas_hoje<?php echo $index+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="vendas_hoje_Container<?php echo $index+1;?>" style="width: 100%; height: 400px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty


        @endforelse


        @forelse ($compras_adicionais  as $index =>  $operacao)
            <div class="modal fade" id="Grafico_indicacoes_compra<?php echo $index+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="compras_indicacoes_Container<?php echo $index+1;?>" style="width: 100%; height: 400px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty


        @endforelse
        @forelse ($vendas_adicionais  as $index =>  $operacao)
            <div class="modal fade" id="Grafico_indicacoes_venda<?php echo $index+1;?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="myModalLabel"></h4>
                        </div>
                        <div class="modal-body">
                            <div class="vendas_indicacoes_Container<?php echo $index+1;?>" style="width: 100%; height: 400px"></div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                        </div>
                    </div>
                </div>
            </div>
        @empty


        @endforelse
    </div>
@stop
@section('script')
    <!-- Page-Level Plugin Scripts-->
    <script src="{{asset('plugins/dataTables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('plugins/dataTables/dataTables.bootstrap.js')}}"></script>



@stop
@section('template_scripts')

    @include('admin.structure.dashboard-scripts')

@endsection
