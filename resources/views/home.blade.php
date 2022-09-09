@extends('layouts.admin')
@section('content')
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Prendas en almacenes e inventario principal
                </div>

                <div class="card-body" id="cb1" name="cb1">
                    <div class="table-responsive">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Gráfica de asignación de prendas
                </div>

                <div class="card-body" id="cb2" name="cb2">

                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Gráfica de asignación de prendas
                </div>

                <div class="card-body" id="cb3" name="cb3">


                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Total de empleados por sucursal
                </div>

                <div class="card-body" id="cb4" name="cb4">


                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Total de prendas por estatus
                </div>

                <div class="card-body" id="cb5" name="cb5">


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>

    $(document).ready(function () {
        inventarios();
        empleados();
        prendas();
        getGraficaPrendasAsignadas('desc', 'Las 10 prendas más asignadas', 'cb2', '#46b9b9');
        getGraficaPrendasAsignadas('asc', 'Las 10 prendas menos asignadas', 'cb3', '#f45b5b');

    });

    function inventarios() {
        $.ajax({
            type: 'GET',
            url: '/api/v1/dashboard/inventarios',
            success: function (resultado) {

                if (resultado) {
                    //console.log("OK=" + resultado);
                    var html = '<table class=" table table-bordered table-striped table-hover datatable datatable-InventarioResumen">';
                    var htmlHead = "<thead><tr><th></th>";
                    var htmlBody = "<tr><td><b>Inventario 5E</b></td>";

                    $.each(resultado.inventarioprincipal, function (k, v) {
                        htmlHead += '<th>' + k + '</th>';
                        if (v == 0) {
                            htmlBody += '<td><span style="color: red; font-weight: bold">' + v + '</span></td>';
                        } else {
                            htmlBody += '<td><span style="font-weight: bold">' + v + '</span></td>';
                        }
                        //console.log("k="+k+" y v="+v);
                    });
                    htmlHead += '</tr></thead><tbody>';
                    htmlBody += "</tr>";
                    $.each(resultado.almacenes, function (key, value) {
                        //console.log("almacen="+key+" y v="+resultado.almacenes[key].nombre);
                        htmlBody += '<tr><td>' + resultado.almacenes[key].nombre + '</td>';
                        $.each(resultado.almacenes[key].inventario, function (k, v) {
                            if (v == 0) {
                                htmlBody += '<td><span style="color: red; font-weight: bold">' + v + '</span></td>';
                            } else {
                                htmlBody += '<td><span style="font-weight: bold">' + v + '</span></td>';
                            }
                            //console.log("k="+k+" y v="+v);
                        });
                        htmlBody += '</tr>';
                    });
                    html += htmlHead + htmlBody + '</tr></tbody></table>';
                    $("#cb1").html(html);
                } else {
                    console.log("ERROR=" + resultado);
                }


            },
            error: function (resultado) { alert("Ocurrió un error inesperado") }
        });

    }

    function empleados() {
        $.ajax({
            type: 'GET',
            url: '/api/v1/dashboard/empleados',
            success: function (resultado) {

                if (resultado) {
                    //console.log("OK=" + resultado);
                    var html = '<table class=" table table-bordered table-striped table-hover datatable datatable-TotalEmpleados">';
                    var htmlHead = "<thead><tr><th>Sucursal</th><th>Total de empleados</th></tr><tbody>";
                    var htmlBody = "";
                    var i = 0;
                    $.each(resultado, function (k, v) {

                        htmlBody += '<tr><td>' + resultado[i].nombre + '</td><td>' + resultado[i].total + '</td>';
                        htmlBody += '</tr>';
                        i++;
                    });

                    html += htmlHead + htmlBody + '</tbody></table>';
                    $("#cb4").html(html);
                } else {
                    console.log("ERROR=" + resultado);
                }


            },
            error: function (resultado) { alert("Ocurrió un error inesperado") }
        });
    }
    function prendas() {
        $.ajax({
            type: 'GET',
            url: '/api/v1/dashboard/prendas',
            success: function (resultado) {

                if (resultado) {
                    //console.log("OK=" + resultado);
                    var html = '<table class=" table table-bordered table-striped table-hover datatable datatable-TotalPrendas">';
                    var htmlHead = "<thead><tr><th>Estatus</th><th>Total de prendas</th></tr><tbody>";
                    var htmlBody = "";
                    var i = 0;
                    $.each(resultado, function (k, v) {

                        htmlBody += '<tr><td>' + resultado[i].estatus + '</td><td>' + resultado[i].total + '</td>';
                        htmlBody += '</tr>';
                        i++;
                    });

                    html += htmlHead + htmlBody + '</tbody></table>';
                    $("#cb5").html(html);
                } else {
                    console.log("ERROR=" + resultado);
                }


            },
            error: function (resultado) { alert("Ocurrió un error inesperado") }
        });

    }



    function getGraficaPrendasAsignadas(orden, title, container, color) {
        $.ajax({
            type: 'GET',
            url: '/api/v1/dashboard/tallasasignadasgraph/' + orden,
            success: function (resultado) {
                console.log("resultado=" + resultado.result);

                if (resultado.result == "error") {
                    alert("Ocurrió un error: " + resultado.message)
                } else {
                    if (resultado === "error") {
                    } else {

                        console.log("valores=" + resultado.categorias);
                        createChartBar(container, title, resultado.categorias, resultado.valores, resultado.description, color)

                    }
                }
            },
            error: function (resultado) { alert("Ocurrió un error inesperado") }
        });

    }


    function createChartPie(container, titulo, categorias, valores, descripcion) {



        chart = new Highcharts.Chart({
            chart: {
                renderTo: container,
                type: 'pie',
                height: 500
            }, accessibility: {
                description: descripcion
            },
            colors: ['#f45b5b', '#8085e9', '#8d4654', '#7798BF', '#46b9b9', '#ff0066', '#f18af1', '#55BF3B', '#DF5353', '#7798BF', '#46b9b9'],
            //colors: ['#f45b5b', '#8085e9', '#8d4654', '#7798BF', '#46b9b9', '#ff0066', '#f18af1', '#55BF3B', '#DF5353', '#7798BF', '#46b9b9'],

            title: {
                text: titulo
            },
            subtitle: {
                text: descripcion
            },
            tooltip: {},

            xAxis: {
                categories: categorias,
                labels: {
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Verdana, sans-serif',
                        fontWeight: 'light'
                    },
                    reserveSpace: true
                }
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        style: {
                            fontWeight: 'regular'
                        },
                        //format: '<span style="color:{point.color}">{point.name}: {point.percentage:.1f} %<span>'
                        format: '{point.name}: {point.percentage:.1f} %'
                    },
                    showInLegend: true
                }
            },
            legend: {
                labelFormatter: function () {
                    return this.name + ' (' + this.y + ')';
                }
            },
            series: [valores]
        });
    }

    function createChartBar(container, titulo, categorias, valores, descripcion, color) {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: container,
                type: 'bar',
                height: 300,

            }, accessibility: {
                description: descripcion
            },
            colors: [color],
            title: {
                text: titulo
            },
            subtitle: {
                text: descripcion
            },
            tooltip: {},
            xAxis: {
                type: 'category',
                labels: {
                    style: {
                        fontSize: '11px',
                        fontFamily: 'Verdana, sans-serif',
                        fontWeight: 'light'
                    },
                    align: 'left',
                    reserveSpace: true
                }
            },
            yAxis: {
                title: {
                    text: ''
                }
            },
            plotOptions: {
                bar: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        //borderColor: 'red',
                        // borderWidth: 2,
                        backgroundColor: '#fff',
                        borderRadius: 5,
                        padding: 2,
                        shadow: true,
                        style: {
                            fontWeight: 'regular'
                        }, formatter: function () {
                            return '<b>' + this.y + '</b>';
                        }
                    },
                    showInLegend: false
                }
            },
            series: [valores]
        });
    }


</script>
@endsection