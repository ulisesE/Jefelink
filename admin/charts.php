<?php
include 'header.php';
?>
<head>
    <title>Totales - SB Admin</title>
</head>
<body>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Graficas</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="index.php">Tablero</a></li>
                    <li class="breadcrumb-item active">Graficas</li>
                </ol>
                <div class="card mb-4">
                    <div class="card-body">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Ventas Por Mes
                            </div>
                            <div class="card-body"><canvas id="myChart"></canvas></div>
                            <div class="card-footer small text-muted"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                VentaDiaria
                            </div>
                            <div class="card-body"><canvas id="myChart2"></canvas></div>
                            <div class="card-footer small text-muted"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                VentaDiariaPorMes
                            </div>
                            <div class="card-body"><canvas id="myChart3"></canvas></div>
                            <div class="card-footer small text-muted" id="btnGroupMeses"></div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2022</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script >
    var php_data = '';
    $.ajax({
        url: "https://admin.jefelink.com/engine/api.php",
        async: false, 
        dataType: 'json',
        success: function (json) {
        php_data = json;
        }
    });

    const ctx = document.getElementById('myChart');
    var labelsMes = [];
    var dataMes = [];
    var btnGroupMeses = [];
    
    var totalArray = [];
    var total = 0;
    
    var metaArray = [];
    var meta = 100;
    
    var urielArray = [];
    var totalUriel = 0;
    $.each(php_data.porMes,function(key, value){
        labelsMes.push(value.mes);
        btnGroupMeses.push(value.mesNum);
        dataMes.push(value.suma);
        total += parseInt(value.suma);
        totalArray.push(total);
        totalU=((value.suma-1700)/2)<0?0:(value.suma-1700)/2;
        urielArray.push(totalU);
        totalUriel+=totalU;
    });
    
    const data = {
        labels: labelsMes,
        datasets: [{
            label: 'Total por mes',
            data: dataMes,
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        },{
            label: 'Total = $'+total,
            data: totalArray,
            fill: false,
            borderColor: 'rgb(100, 0, 0)',
            tension: 0.1
        },{
            label: 'Uriel=$'+Math.round(totalUriel * 100) / 100,
            data: urielArray,
            fill: false,
            borderColor: 'rgb(0, 120, 10)',
            tension: 0.1
        }]
    };
    
    const config = {
        type: 'line',
        data: data,
    };
    
    new Chart(ctx, config); 
    //;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;

    const ctx2 = document.getElementById('myChart2');
    var labelsDiario = [];
    var dataDiario = [];
    metaArray = [];
    $.each(php_data.Diario,function(key, value){
        labelsDiario.push(value.dia);
        dataDiario.push(value.suma);
        metaArray.push(meta);
    });
    
    const data2 = {
        labels: labelsDiario,
        datasets: [{
            label: 'Venta Diaria',
            data: dataDiario,
            fill: true,
            borderColor: 'rgb(75, 192, 192)',
            tension: 0.1
        },{
            label: 'Meta',
            data: metaArray,
            fill: false,
            borderColor: 'rgb(64, 73, 125)',
            tension: 0.1
        }]
    };
    
    const config2 = {
        type: 'line',
        data: data2,
    };

    new Chart(ctx2, config2); 
    
    $.each(btnGroupMeses,function(key,value){
    $('#btnGroupMeses').append('<button type="button" class="btn btn-info btn-change-chart-month" style="margin: 10px;" date="' + value + '">' + labelsMes[key] + '</button>');
    });
    
    var chart3 ;
    function renderChart3(date){
        if(chart3 != null){
            chart3.destroy();
        }
        var php_data3 = '';
        $.ajax({
            url: "https://admin.jefelink.com/engine/api.php?opc=1&date=" + date,
            async: false, 
            dataType: 'json',
            success: function (json) {
            php_data3 = json;
            }
        });
        
        const ctx3 = document.getElementById('myChart3');
        var labelsDiario3 = [];
        var dataDiario3 = [];
        var dataMesTotal3 = [];
        metaArray = [];
        sumaMes=0;
        $.each(php_data3.Diario,function(key, value){
            //console.log(dataMesTotal3);
            labelsDiario3.push(value.dia);
            dataDiario3.push(value.suma);
            sumaMes+=parseInt(value.suma);
            metaArray.push(meta);
            dataMesTotal3.push(sumaMes);
        });
        
        const data3 = {
            labels: labelsDiario3,
            datasets: [{
                label: 'Venta Diaria',
                data: dataDiario3,
                fill: true,
                borderColor: 'rgb(75, 192, 192)',
                tension: 0.1
            },{
            label: 'Meta',
            data: metaArray,
            fill: false,
            borderColor: 'rgb(64, 73, 125)',
            tension: 0.1
        },{
            label: 'Total = ' + sumaMes,
            data: [],
            fill: false,
            borderColor: 'rgb(64, 103, 125)',
            tension: 0.1
        }]
        };
        
        const config3 = {
            type: 'line',
            data: data3,
        };
    
        chart3 = new Chart(ctx3, config3);
    }
    
    $('.btn-change-chart-month').click(function(){
        renderChart3($(this).attr('date'));
    })


</script>

</body>
</html>