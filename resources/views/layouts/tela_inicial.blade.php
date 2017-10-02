<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=yes" name="viewport">
    <title>@if (trim($__env->yieldContent('template_title')))@yield('template_title') | @endif {{ Lang::get('titles.app') }}</title>
    <meta name="description" content="">
    <meta name="author" content="ADMIN" >
    {!! Html::style('plugins/bootstrap/bootstrap.css') !!}
    {!! Html::style('font-awesome/css/font-awesome.css') !!}
    {!! Html::style('plugins/pace/pace-theme-big-counter.css') !!}
    {!! Html::style('css/style.css') !!}
    {!! Html::style('css/main-style.css')!!}
    {!! Html::style('plugins/social-buttons/social-buttons.css')!!}

    {{-- Load Layout Head --}}
    @yield('layout-head')

    <style>
        .inv-green {
            color: #0cdb02;
        }

        .inv-red {
            color: #fe0000;
        }

    </style>

    <style>
        #wrapper {
            display: table;
            table-layout: fixed;


            height:40px;
        {{--  background-color:Gray;--}}
     }
        #wrapper div {
            display: table-cell;
            height:40px;
        }

        #one {
            {{--  background-color:green; --}}
                width:20px;

        }
        #two {
            {{--  background-color:blue; --}}
                width:103px;
        }
        #three {
            {{--  background-color:red;  --}}
                width:83px;
        }
        #four {
            {{--  background-color:red;  --}}
            width:253px;
        }
    </style>
    <style>
        body {
            -moz-transform: scale(0.8, 0.8); /* Moz-browsers */
            zoom: 0.8; /* Other non-webkit browsers */
            zoom: 80%; /* Webkit browsers */
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini sidebar-collapse ">

{{-- Load Google Analytics --}}
{{-- @include('blog.partials.analytics') --}}

{{-- Load Layout HEADER --}}
@yield('layout-header')

{{-- Load Layout CONTENT --}}
@yield('layout-content')


<!-- Left side column. contains the logo and sidebar -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
        @yield('content')
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- Add the sidebar's background. This div must be placed immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>

<!-- ./wrapper -->
<!-- jQuery 2.2.3 -->

{{-- Load Layout SIDEBAR --}}
@yield('layout-sidebar')

{{-- Load Layout FOOTER  --}}
{{-- @yield('layout-footer')  --}}

{{-- Load Layout SCRIPTS --}}
@yield('layout-scripts')
@include('admin.partials.scripts')


{!! Html::script('plugins/jquery-1.10.2.js') !!}
{!! Html::script('plugins/bootstrap/bootstrap.min.js') !!}
{!! Html::script('plugins/metisMenu/jquery.metisMenu.js') !!}
{!! Html::script('plugins/pace/pace.js') !!}
{!! Html::script('scripts/siminta.js') !!}

{!! Html::script('contrib/jquery/jquery-1.7.2.min.js') !!}
{!! Html::script('contrib/jquery.ui-1.6rc5/ui/ui.core.js') !!}
{!! Html::script('contrib/jquery.ui-1.6rc5/ui/ui.tabs.js') !!}
{!! Html::script('contrib/google-code-prettify/prettify.js') !!}
{!! Html::script('contrib/jpicker-1.1.6/jpicker-1.1.6.min.js') !!}
{!! Html::script('public/assets/jquery/jquery.sparkline.min.js') !!}
{!! Html::script('public/assets/jquery/index.js') !!}
{!! Html::script('public/assets/canvas/canvasjs.min.js') !!}
{!! Html::script('public/assets/canvas/jquery.canvasjs.min.js') !!}

<script type="text/javascript">
    /* <![CDATA[ */

    $(function() {
        /** This code runs when everything has been loaded on the page */
        /* Inline sparklines take their values from the contents of the tag */

        $('.inlinesparkline').sparkline('html', {  type: 'line', disableHiddenCheck: true, height: '20px', width: '100px'


        });


        /* Sparklines can also take their values from the first argument passed to the sparkline() function */

        var myvalues1 = [.585,1.11,.645,.018,.2,-.1,.1];
        var myvalues = [];
        $('.dynamicsparkline').sparkline(myvalues);

        /* The second argument gives options such as specifying you want a bar chart */
        $('.dynamicbar').sparkline(myvalues1, {type: 'bar',  height: '40',
            barWidth: 8} );
        $('.dynamicbar1').sparkline(myvalues, {type: 'bar',  height: '40',
            barWidth: 8} );
        $('.dynamicbar2').sparkline(myvalues, {type: 'bar',  height: '40',
            barWidth: 8} );
        $('.dynamicbar3').sparkline(myvalues, {type: 'bar',  height: '40',
            barWidth: 8} );
        $('.dynamicbar4').sparkline(myvalues, {type: 'bar',  height: '40',
            barWidth: 8} );

        /* Use 'html' instead of an array of values to pass options to a sparkline with data in the tag */
        $('.inlinebar').sparkline('html', {type: 'bar', barColor: 'red'} );

    });
    /* ]]> */
</script>
<script>
    function drawTitleSparklines(data) {
        $('#dow').sparkline(data.nasdaq_volume, {height: '2.6em', type: 'bar', disableHiddenCheck: true, barSpacing: 1, barWidth: 12, barColor: 'lightgreen',  negBarColor:'#ddd' ,tooltipPrefix: '% no dia: '});
        $('#dow').sparkline(data.nasdaq_prices, { composite: true, height: '2.6em', fillColor:false, lineColor:'black', tooltipPrefix: '% acumulado: '});
        $('#dow1').sparkline(data.dow_volume1, {height: '2.6em', type: 'bar', disableHiddenCheck: true, barSpacing: 1, barWidth: 12, barColor: 'lightgreen',  negBarColor:'#ddd', tooltipPrefix: '% no dia: '});
        $('#dow1').sparkline(data.dow_prices1, { disableHiddenCheck: true,composite: true, height: '2.6em', fillColor:false, lineColor:'black', tooltipPrefix: '% acumulado: '});
        $('#compras1').sparkline(data.dow_volume, {height: '2.6em', type: 'bar', disableHiddenCheck: true, barSpacing: 1, barWidth: 12, barColor: 'lightgreen',  negBarColor:'#ddd', tooltipPrefix: '% no dia: '});
        $('#compras1').sparkline(data.dow_prices, { disableHiddenCheck: true,composite: true, height: '2.6em', fillColor:false, lineColor:'black', tooltipPrefix: '% acumulado: '});
        $('#compras8').sparkline(data.dow_volume, {height: '2.6em', type: 'bar', disableHiddenCheck: true, barSpacing: 1, barWidth: 12, barColor: 'lightgreen',  negBarColor:'#ddd', tooltipPrefix: '% no dia: '});
        $('#compras8').sparkline(data.dow_prices, { disableHiddenCheck: true,composite: true, height: '2.6em', fillColor: '#ff0000', lineColor:'black', tooltipPrefix: '% acumulado: '});

        //$('#nasdaq').sparkline(data.nasdaq_volume, {height: '1.3em', type: 'bar', barSpacing: 0, barWidth: 3, barColor: '#ddd', tooltipPrefix: 'Volume'});
        $('#nasdaq').sparkline(data.nasdaq_prices, {composite: false, height: '1.3em', fillColor:false, lineColor:'black', tooltipPrefix: 'Index: '});
        $('#compras_melhores1').sparkline(data.compras_melhores1, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#compras_melhores2').sparkline(data.compras_melhores2, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#compras_melhores3').sparkline(data.compras_melhores3, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#compras_melhores4').sparkline(data.compras_melhores4, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#compras_melhores5').sparkline(data.compras_melhores5, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#compras_melhores6').sparkline(data.compras_melhores6, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#compras_melhores7').sparkline(data.compras_melhores7, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores1').sparkline(data.vendas_melhores1, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores2').sparkline(data.vendas_melhores2, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores3').sparkline(data.vendas_melhores3, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores4').sparkline(data.vendas_melhores4, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores5').sparkline(data.vendas_melhores5, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores6').sparkline(data.vendas_melhores6, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});
        $('#vendas_melhores7').sparkline(data.vendas_melhores7, {height: '2.6em', fillColor:'#cce4fc', lineColor:'blue', tooltipPrefix: '% acumulado: ', height: '20px', width: '100px'});

    };
</script>

<script type="text/javascript">
    /* <![CDATA[ */
    $(function() {
// All of the functions used in here are defined in assets/index.js

// Load data generated by python cron jobs
        var dynamic_data = {
            nasdaq_volume: [<?php echo $perc_dia['perc_dia']; ?>],
            nasdaq_prices: [<?php echo $perc_dia['perc_dia_acum']; ?>],
            // nasdaq_volume: [1.18,1.12,.61,.22,.37,.34,-.08,.13,-.08,-.04,.21
            // ],
            //   nasdaq_prices: [1.18,2.3,2.91,3.13,3.5,3.84,3.76,3.89,3.81,3.77,3.98
            //   ],
            dow_volume1: [<?php echo $perc_dia_fech['perc_dia']; ?>],
            dow_prices1: [<?php echo $perc_dia_fech['perc_dia_acum']; ?>],
            //     dow_volume1: [-8.2
            //     ],
            //   dow_prices1: [-8.2
            //   ],
            dow_prices: [<?php echo $perc_dia['perc_dia_acum']; ?>
            ],
            dow_volume: [<?php echo $perc_dia_fech['perc_dia']; ?>
            ],compras_melhores1: [<?php echo $compras_melhores1; ?>]
            ,compras_melhores2: [<?php echo $compras_melhores2; ?>]
            ,compras_melhores3: [<?php echo $compras_melhores3; ?>]
            ,compras_melhores4: [<?php echo $compras_melhores4; ?>]
            ,compras_melhores5: [<?php echo $compras_melhores5; ?>]
            ,compras_melhores6: [<?php echo $compras_melhores6; ?>]
            ,compras_melhores7: [<?php echo $compras_melhores7; ?>]
            ,vendas_melhores1: [<?php echo $vendas_melhores1; ?>]
            ,vendas_melhores2: [<?php echo $vendas_melhores2; ?>]
            ,vendas_melhores3: [<?php echo $vendas_melhores3; ?>]
            ,vendas_melhores4: [<?php echo $vendas_melhores4; ?>]
            ,vendas_melhores5: [<?php echo $vendas_melhores5; ?>]
            ,vendas_melhores6: [<?php echo $vendas_melhores6; ?>]
            ,vendas_melhores7: [<?php echo $vendas_melhores7; ?>]

        };

        //   var data = new google.visualization.DataTable();
        //   data.addColumn('string', compras_melhores[0][0]);
        //  for (var i = 1; i < numRows; i++)
        //      data.addRow(compras_melhores[i]);
// Pretty-print the code examples using Google's JS utility
// which you can find here: http://code.google.com/p/google-code-prettify/
//   prettyPrint();

//    drawDocSparklines();
        drawTitleSparklines(dynamic_data);
//   drawMouseSpeedDemo()
//    drawBuildYourOwnSparkline();

// Build the table of contents
//   createTOC();

// Scroll to the correct doc heading, if referenced in he URL
//   setTabCallback = selectDocHeading();

//   renderTabs();

//   if (setTabCallback) {
//       setTabCallback();
//    }

//   initTOCUpdater();

// Keep the seciton tabs docked to the top of the screen
//   $('#tabbar').dock();

// chat a bit with xhtml compliance
//   $('a[rel="external"]').attr('target', '_blank');
    });
    /* ]]> */
</script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script>
    $('#alertacompras').dataTable( {
        "order": [[ 4, 'asc' ]],"pageLength": <?echo $tot_alerta_compra; ?>
    } );
</script>
<script>
    $(document).ready(function () {
        $('#alertacompras').dataTable();

    });
</script>

<script>
    $('#alertavendas').dataTable( {
        "order": [[ 4, 'asc' ]],"pageLength":  <?echo $tot_alerta_venda; ?>
    } );
</script>
<script>
    $(document).ready(function () {
        $('#alertavendas').dataTable();

    });
</script>
<script>
    $('#operacoesvendas').dataTable( {
        "order": [[ 5, 'desc' ]]
    } );

</script>

<script>
    $('#operacoescompras').dataTable( {
        "order": [[ 5, 'desc' ]]
    } );
</script>
<script>
    $(document).ready(function () {
        $('#operacoescompras').dataTable();
    });
</script>
<script>
    $(document).ready(function () {
        $('#operacoesvendas').dataTable();
    });
</script>
<script type="text/javascript">
    window.onload = function() {
        @foreach ($alertas_compra  as $index =>  $operacao)
               $(".alertas_compra_Container<?echo $index+1;?>").CanvasJSChart({
            title: {
                text: "<?echo $operacao->ativo . ' - ' . $operacao->atse_nm_empresa;?>"
            },
            axisY: {
                includeZero: false,
                title: "Preço (R$)"
            },
            axisX: {
                intervalType: "day",

                interval: 4,
                valueFormatString: "DD"
            },
            toolTip: {
                content: "Junho / Julho 2017 <br/> <strong>Preços (R$):</strong> <br/>Aber: {y[0]}, Fech: {y[3]} <br/> Min: {y[1]}, Max: {y[2]}"
            },
            data: [
                {
                    type: "candlestick",color:"#DD7E86",
                    risingColor: "green",
                    dataPoints: [
                        <?echo $operacao->cotacao_canvas; ?>
                    ]
                }
            ]
        });

        @endforeach
        @foreach ($alertas_venda  as $index =>  $operacao)
               $(".alertas_venda_Container<?echo $index+1;?>").CanvasJSChart({
            title: {
                text: "<?echo $operacao->ativo . ' - ' . $operacao->atse_nm_empresa;?>"
            },
            axisY: {
                includeZero: false,
                title: "Preço (R$)"
            },
            axisX: {
                intervalType: "day",
                interval: 4,
                valueFormatString: "DD"
            },
            toolTip: {
                content: "Junho / Julho 2017 <br/> <strong>Preços (R$):</strong> <br/>Aber: {y[0]}, Fech: {y[3]} <br/> Min: {y[1]}, Max: {y[2]}"
            },
            data: [
                {
                    type: "candlestick",color:"#DD7E86",
                    risingColor: "green",
                    dataPoints: [<?echo $operacao->cotacao_canvas; ?>
                    ]
                }
            ]
        });

        @endforeach
        @forelse ($compras_hoje  as $index =>  $operacao)
        $(".compras_hoje_Container<?echo $index+1;?>").CanvasJSChart({
            title: {
                text: "<?echo $operacao->ativo . ' - ' . $operacao->atse_nm_segmento;?>"
            },
            axisY: {
                includeZero: false,
                title: "Preço (R$)"
            },
            axisX: {
                intervalType: "day",
                interval: 4,
                valueFormatString: "DD"
            },
            toolTip: {
                content: "Junho / Julho 2017 <br/> <strong>Preços (R$):</strong> <br/>Aber: {y[0]}, Fech: {y[3]} <br/> Min: {y[1]}, Max: {y[2]}"
            },
            data: [
                {
                    type: "candlestick",color: "#DD7E86",
                    risingColor: "green",
                    dataPoints: [ <?echo $operacao->cotacao_canvas; ?>
                    ]
                    //        {x:new Date(2016,1,4), y:[3.88,3.91,3.79,3.80]},{x:new Date(2016,1,5), y:[3.89,3.89,3.80,3.80]},{x:new Date(2016,1,6), y:[3.78,3.80,3.65,3.69]},{x:new Date(2016,1,7), y:[3.80,3.80,3.61,3.67]},{x:new Date(2016,1,8), y:[3.62,3.68,3.56,3.59]},{x:new Date(2016,1,11), y:[3.70,3.78,3.58,3.58]},{x:new Date(2016,1,12), y:[3.55,3.60,3.40,3.49]},{x:new Date(2016,1,13), y:[3.44,3.52,3.42,3.42]},{x:new Date(2016,1,14), y:[3.38,3.40,3.30,3.36]},{x:new Date(2016,1,15), y:[3.30,3.38,3.16,3.23]},{x:new Date(2016,1,18), y:[3.19,3.19,3.05,3.05]},{x:new Date(2016,1,19), y:[3.06,3.07,2.99,3.07]},{x:new Date(2016,1,20), y:[3.08,3.28,2.91,2.96]},{x:new Date(2016,1,21), y:[2.85,3.04,2.84,2.88]},{x:new Date(2016,1,22), y:[2.99,3.00,2.89,2.89]},{x:new Date(2016,1,26), y:[2.89,2.92,2.69,2.78]},{x:new Date(2016,1,27), y:[2.63,3.00,2.63,2.91]}


                }
            ]
        });

        @endforeach

        @forelse ($vendas_hoje  as $index =>  $operacao)
        $(".vendas_hoje_Container<?echo $index+1;?>").CanvasJSChart({
            title: {
                text: "<?echo $operacao->ativo . ' - ' . $operacao->atse_nm_segmento;?>"
            },
            axisY: {
                includeZero: false,
                title: "Preço (R$)"
            },
            axisX: {
                intervalType: "day",
                interval: 4,
                valueFormatString: "DD"
            },
            toolTip: {
                content: "Junho / Julho 2017 <br/> <strong>Preços (R$):</strong> <br/>Aber: {y[0]}, Fech: {y[3]} <br/> Min: {y[1]}, Max: {y[2]}"
            },
            data: [
                {
                    type: "candlestick",color:"#DD7E86",
                    risingColor: "green",
                    dataPoints: [
                        <?echo $operacao->cotacao_canvas; ?>
                    ]
                }
            ]
        });

        @endforeach

        @forelse ($compras_adicionais  as $index =>  $operacao)
        $(".compras_indicacoes_Container<?echo $index+1;?>").CanvasJSChart({
            title: {
                text: "<?echo $operacao->ativo . ' - ' . $operacao->atse_nm_empresa;?>"
            },
            axisY: {
                includeZero: false,
                title: "Preço (R$)"
            },
            axisX: {
                intervalType: "day",
                interval: 4,
                valueFormatString: "DD"
            },
            toolTip: {
                content: "Junho / Julho 2017 <br/> <strong>Preços (R$):</strong> <br/>Aber: {y[0]}, Fech: {y[3]} <br/> Min: {y[1]}, Max: {y[2]}"
            },
            data: [
                {
                    type: "candlestick",color: "#DD7E86",
                    risingColor: "green",
                    dataPoints: [ <?echo $operacao->cotacao_canvas; ?>
                    ]
                    //        {x:new Date(2016,1,4), y:[3.88,3.91,3.79,3.80]},{x:new Date(2016,1,5), y:[3.89,3.89,3.80,3.80]},{x:new Date(2016,1,6), y:[3.78,3.80,3.65,3.69]},{x:new Date(2016,1,7), y:[3.80,3.80,3.61,3.67]},{x:new Date(2016,1,8), y:[3.62,3.68,3.56,3.59]},{x:new Date(2016,1,11), y:[3.70,3.78,3.58,3.58]},{x:new Date(2016,1,12), y:[3.55,3.60,3.40,3.49]},{x:new Date(2016,1,13), y:[3.44,3.52,3.42,3.42]},{x:new Date(2016,1,14), y:[3.38,3.40,3.30,3.36]},{x:new Date(2016,1,15), y:[3.30,3.38,3.16,3.23]},{x:new Date(2016,1,18), y:[3.19,3.19,3.05,3.05]},{x:new Date(2016,1,19), y:[3.06,3.07,2.99,3.07]},{x:new Date(2016,1,20), y:[3.08,3.28,2.91,2.96]},{x:new Date(2016,1,21), y:[2.85,3.04,2.84,2.88]},{x:new Date(2016,1,22), y:[2.99,3.00,2.89,2.89]},{x:new Date(2016,1,26), y:[2.89,2.92,2.69,2.78]},{x:new Date(2016,1,27), y:[2.63,3.00,2.63,2.91]}


                }
            ]
        });

        @endforeach

        @forelse ($vendas_adicionais  as $index =>  $operacao)
        $(".vendas_indicacoes_Container<?echo $index+1;?>").CanvasJSChart({
            title: {
                text: "<?echo $operacao->ativo . ' - ' . $operacao->atse_nm_empresa;?>"
            },
            axisY: {
                includeZero: false,
                title: "Preço (R$)"
            },
            axisX: {
                intervalType: "day",
                interval: 4,
                valueFormatString: "DD"
            },
            toolTip: {
                content: "Junho / Julho 2017 <br/> <strong>Preços (R$):</strong> <br/>Aber: {y[0]}, Fech: {y[3]} <br/> Min: {y[1]}, Max: {y[2]}"
            },
            data: [
                {
                    type: "candlestick",color:"#DD7E86",
                    risingColor: "green",
                    dataPoints: [
                        <?echo $operacao->cotacao_canvas; ?>
                    ]
                }
            ]
        });

        @endforeach
    }
</script>

<script>
    var sparkcanvas = function(canvas_id, data, endpoint, color, style) {
        if (window.HTMLCanvasElement) {
            var c = document.getElementById(canvas_id),
                ctx = c.getContext('2d'),
                color = (color ? color : 'rgba(0,0,0,0.5)'),
                style = (style == 'bar' ? 'bar' : 'line'),
                height = c.height - 3,
                width = c.width,
                total = data.length,
                max = Math.max.apply(Math, data),
                xstep = width/total,
                ystep = max/height,
                x = 0,
                y = height - data[0]/ystep,
                i;
            if (window.devicePixelRatio) {
                c.width = c.width * window.devicePixelRatio;
                c.height = c.height * window.devicePixelRatio;
                c.style.width = (c.width / window.devicePixelRatio) + 'px';
                c.style.height = (c.height / window.devicePixelRatio) + 'px';
                c.style.display = 'inline-block';
                ctx.scale(window.devicePixelRatio, window.devicePixelRatio);
            }
            ctx.clearRect(0, 0, width, height);
            ctx.beginPath();
            ctx.strokeStyle = color;
            ctx.moveTo(x, y);
            for (i = 1; i < total; i = i + 1) {
                x = x + xstep;
                y = height - data[i]/ystep + 2;
                if (style == 'bar') { ctx.moveTo(x,height); }
                ctx.lineTo(x, y);
            }
            ctx.stroke();
            if (endpoint && style == 'line') {
                ctx.beginPath();
                ctx.fillStyle = 'rgba(255,0,0,0.5)';
                ctx.arc(x, y, 1.5, 0, Math.PI*2);
                ctx.fill();
            }
        }
    };
</script>
<script>
    @forelse ($alertas_compra_modal as $index => $operacao)
         sparkcanvas('alertas_compra_canvas<?echo $index+1;?>',  [<?echo $operacao->fechamento_canvas; ?>], 3);
    @endforeach
</script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    // google.charts.load('current', {packages: ['corechart']});

    google.load("visualization", "1", {packages:["corechart"]});
    // google.setOnLoadCallback(init);
</script>
<script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
</script>
<script type="text/javascript">
    $(window).resize(function(){
        drawChart();
    });
</script>
<script language="JavaScript">
    var planejamento_long = <?php echo $planejamento_long; ?>;
    console.log(planejamento_long);
    function init() {

        // var rowData1 = planejamento_long;
        // var rowData2 = planejamento_long_semanal;
        // var data = [];
        // data[0] = google.visualization.arrayToDataTable(rowData1);
        // data[1] = google.visualization.arrayToDataTable(rowData2);


        // var data1 = google.visualization.arrayToDataTable(planejamento_long);
        var data = new google.visualization.DataTable();
        // determine the number of rows and columns.
        var numRows = planejamento_long.length;
        var numCols = planejamento_long[0].length;
        // in this case the first column is of type 'string'.
        data.addColumn('number', planejamento_long[0][0]);
        // data.addColumn({type: 'string', role: 'annotation'});
        // all other columns are of type 'number'.
        // for (var i = 2; i < numCols; i++)
        data.addColumn('number', planejamento_long[0][1]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_long[0][4]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_long[0][7]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_long[0][10]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_long[0][13]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        // now add the rows.
        for (var i = 1; i < numRows; i++)
            data.addRow(planejamento_long[i]);
        // for (var i = 1; i < numRows; i++)
        //    if (planejamento_long[i][0] === 0) { // or !== if you're checking for not zero
        //  document.write("no");
        //    } else {
        //  document.write(planejamento_long[i][1]);
        //  document.write(planejamento_long[i][3]);
        //  document.write(planejamento_long[i][5]);
        //  document.write(planejamento_long[i][7]);
        //  document.write("no");
        //       data.addRow(planejamento_long[i]);
        //   };

        // Set chart options
        var options = {
            //      title: '',
            //      hAxis: {title: '% Entrada', minValue: 0, maxValue: 5},
            //      vAxis: {title: '% Alerta', minValue: 50, maxValue: 80},
            //      width:"100%",
            //      height: "100%",
            //      legend: { position: 'top' },
            //      chartArea: {width: '90%', height: '75%'},
            title: '',
            hAxis: {title: '% Entrada',  format: '#',
                gridlines: {
                    count: 10
                } },
            vAxis: {title: '% Alerta', viewWindow:{
                max:112,
                min:0
            },
                gridlines: {
                    count: 10
                } },
            legend: { position: 'top' },
            chartArea: {width: '77%', height: '70%'}

        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.ScatterChart(document.getElementById('container'));

        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            if (selectedItem) {
                //  var value = data.getValue(selectedItem.row, selectedItem.column+1);
                //  alert('The user selected ' + value);
                //  var ativo = 'PETR4';
                //  location.href = '/flotchart/' + value.substring(0, 5) + '/mm21/20140101/20171227';
                var value = data.getValue(selectedItem.row, selectedItem.column+1);
                var analise = data.getValue(selectedItem.row, selectedItem.column+2);
                //  alert('The user selected ' + analise);
                //  var ativo = 'PETR4';
                if (analise === "point {size: 7; shape-type: star;}") {

                    location.href = '/analise_tecnica/' + value.substring(0,5);
                } else

                {location.href = '/flotchart/' + value.substring(0,5) + '/mm21/20140101/20171227';}
            }
        }

        // Listen for the 'select' event, and call my function selectHandler() when
        // the user selects something on the chart.
        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data, options);
    }
    google.charts.setOnLoadCallback(init);
</script>

<script language="JavaScript">
    var planejamento_short = <?php echo $planejamento_short; ?>;
    console.log(planejamento_short);
    function drawChart() {

        var data1 = google.visualization.arrayToDataTable(planejamento_short);
        var data = new google.visualization.DataTable();
        // determine the number of rows and columns.
        var numRows = planejamento_short.length;
        var numCols = planejamento_short[0].length;
        // in this case the first column is of type 'string'.
        data.addColumn('number', planejamento_short[0][0]);
        // data.addColumn({type: 'string', role: 'annotation'});
        // all other columns are of type 'number'.
        // for (var i = 2; i < numCols; i++)
        data.addColumn('number', planejamento_short[0][1]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_short[0][4]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_short[0][7]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_short[0][10]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        data.addColumn('number', planejamento_short[0][13]);
        data.addColumn({type: 'string', role: 'tooltip'});
        data.addColumn({type: 'string', role: 'style'});
        // now add the rows.
        for (var i = 1; i < numRows; i++)
            data.addRow(planejamento_short[i]);
        // Set chart options
        var options = {
            //      title: '',
            //      hAxis: {title: '% Entrada', minValue: 0, maxValue: 5},
            //      vAxis: {title: '% Alerta', minValue: 50, maxValue: 80},
            //      width:"100%",
            //      height: "100%",
            //      legend: { position: 'top' },
            //      chartArea: {width: '90%', height: '75%'},
            title: '',
            hAxis: {title: '% Entrada',   format: '#',
                gridlines: {
                    count: 10
                } },
            vAxis: {title: '% Alerta',  viewWindow:{
                max:112,
                min:0
            },
                gridlines: {
                    count: 10
                } },
            legend: { position: 'top' },
            chartArea: {width: '77%', height: '70%'}
        };

        // Instantiate and draw the chart.
        var chart = new google.visualization.ScatterChart(document.getElementById('container2'));

        function selectHandler() {
            var selectedItem = chart.getSelection()[0];
            //   if (selectedItem) {
            //       var value = data.getValue(selectedItem.row, selectedItem.column+1);
            //  alert('The user selected ' + value);
            //  var ativo = 'PETR4';
            //       location.href = '/flotchart/' + value.substring(0, 5) + '/mm21/20140101/20171227';
            //   }
            if (selectedItem) {
                //  var value = data.getValue(selectedItem.row, selectedItem.column+1);
                //  alert('The user selected ' + value);
                //  var ativo = 'PETR4';
                //  location.href = '/flotchart/' + value.substring(0, 5) + '/mm21/20140101/20171227';
                var value = data.getValue(selectedItem.row, selectedItem.column+1);
                var analise = data.getValue(selectedItem.row, selectedItem.column+2);
                //  alert('The user selected ' + analise);
                //  var ativo = 'PETR4';
                if (analise === "point {size: 7; shape-type: star;}") {

                    location.href = '/analise_tecnica/' + value.substring(0,5);
                } else

                {location.href = '/flotchart/' + value.substring(0,5) + '/mm21/20140101/20171227';}
            }
        }

        // Listen for the 'select' event, and call my function selectHandler() when
        // the user selects something on the chart.
        google.visualization.events.addListener(chart, 'select', selectHandler);

        chart.draw(data, options);

    }

    google.charts.setOnLoadCallback(drawChart);
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#TabComprasHoje li:eq(<?php
            $perc=$tot_compras_hoje;
            $tabNumber = $perc > 0 ? '0' : '3';
            print $tabNumber;?>) a").tab('show');
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#TabVendasHoje li:eq(<?php
            $perc=$tot_vendas_hoje;
            $tabNumber = $perc > 0 ? '0' : '3';
            print $tabNumber;?>) a").tab('show');
    });
</script>
</body>
</html>



