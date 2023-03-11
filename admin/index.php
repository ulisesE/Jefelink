<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("location: login.html");
}else{
    if ($_SESSION['auth']==0) {
        header("location: login.html");
    }
}

if ($_SESSION['auth']['id']==2) {
include 'header.php';
?>
<head>
    <title><?= $_SESSION['auth']['nombreNegocio'];?> - Admin</title>
</head>
<body>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="index.html">Start Bootstrap</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!" onclick="cerrarSesion()">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Tablero</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Tablero</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Rentar Equipo</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#" data-bs-toggle="offcanvas" data-bs-target="#rentarEquipo" aria-controls="rentarEquipo">ver</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4 d-none">
                            <div class="card-body">Warning Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4 d-none">
                            <div class="card-body">Success Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-danger text-white mb-4 d-none">
                            <div class="card-body">Danger Card</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="rentas">
                    <?php
                    $sql = "SELECT * FROM `RentaActual`";
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_row()) {
                    ?>
                    <div class="col-sm-6 col-xl-4">
                        <div class="card mb-4">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="
                                    <?= $row[2]=='Xbox'? "img/xbox.png" : "" ?>
                                    <?= $row[2]=='Nintendo'? "img/nintendo.png" : "" ?>
                                    <?= $row[2]=='Celular'? "img/pngwing.com.png" : "" ?>
                                    <?= $row[2]=='Videos'? "img/youtube.png" : "" ?>
                                    <?= $row[2]=='PC'? "img/pc.png" : "" ?>" class="img-fluid rounded-start" alt="...">
                                    <!-- $row[2]=='Nintendo'? "img/nintendo.png" : $row[2]=='PC'? "img/pc.png" : "nada" -->
                                </div>
                                <div class="col-md-4">
                                    <div class="card-body" id="card<?=$row[0]?>">
                                            <h5 class="card-title"><?=$row[1] ?></h5>
                                            <p class="card-text"><?=$row[2] ?></p>
                                            
                                            <div id="card<?=$row[0]?>Coll" class="collapse show">
                                                <p class="card-text"><small class="text-muted"><?=$row[3]."<br>".$row[4] ?></small><br><small class="text-muted" id="timeDiference"> </small></p>
                                                <p class="card-text" style="font-size: 75px;"><?=  $row[5]=='P'?'<i class="fa-solid fa-sack-dollar"></i>':'<i class="fa-solid fa-hand-holding"></i>'; ?></p>
                                            </div>
                                            
                                            <p id="timmer" timeLimit="<?=$row[4]?>" timeStart="<?=$row[3]?>" horas="<?=$row[6]?>" minutos="<?=$row[7]?>" costo="<?=$row[8]?>"
                                            onclick="$('#card<?=$row[0]?>Coll').toggle()"></p>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="" id="cardD<?=$row[0]?>">
                                            <div class="d-grid gap-2">
                                              <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#actualizaHora" onclick="actualizaModal(<?=$row[0]?>)">Agregar Tiempo</button>
                                              <button class="btn btn-danger" type="button" onclick="cerrarTiempo(<?=$row[0]?>)">Finalizar Tiempo</button>
                                              <button class="btn btn-success" type="button" onclick="cobrar(<?=$row[0]?>)">Cobrar</button>
                                              <button class="btn btn-warning" type="button" onclick="calcular(<?=$row[0]?>)">Cerrar renta</button>

                                              <p id="totalCobrar" class="fs-1"></p>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                            <?php
                            }
                            } else {
                            ?>
                            <div class="col-xl-6">
                                <div class="card mb-4">
                                    <div class="card-body">Ten Buen Día</div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
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
        <audio id="xyz" src="sounds/ben10.mp3" preload="auto"></audio>
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
        <script type="text/javascript">
            $("#rentas .card-body").each(function() {
                console.log($(this).attr('id'));
                countDown($(this).attr('id'));
            })

            function countDown(idX) {
                var countDownDate = new Date($("#" + idX + " #timmer").attr("timelimit")).getTime()

                var countDownDate2 = new Date($("#" + idX + " #timmer").attr("timeStart")).getTime()
                var distance = countDownDate - countDownDate2;
                var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                $("#" + idX + " #timeDiference").html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ")

                costoMedias = parseInt($("#" + idX + " #timmer").attr("minutos") / 20) >= 1 ? $("#" + idX + " #timmer").attr("costo") / 2 * parseInt($("#" + idX + " #timmer").attr("minutos") / 20): 0 ;
                costoHoras = parseInt($("#" + idX + " #timmer").attr("horas") * $("#" + idX + " #timmer").attr("costo"));
                totalPagar = costoMedias + costoHoras 

                $("#" + idX.replace("card","cardD") + " #totalCobrar").html("$"+totalPagar);

                var countDownDate = new Date($("#" + idX + " #timmer").attr("timelimit")).getTime()
                // Update the count down every 1 second
                var x = setInterval(function() {
                    // Get today's date and time
                    var now = new Date().getTime();
                    // Find the distance between now and the count down date
                    var distance = countDownDate - now;
                    // Time calculations for days, hours, minutes and seconds
                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    
                    var total = countDownDate - countDownDate2;
                    // Display the result in the element with id="demo"
                    $("#" + idX + " #timmer").html(days + "d " + hours + "h " + minutes + "m " + seconds + "s ");
                    // If the count down is finished, write some text
                    if (distance < 0) {
                        clearInterval(x);
                        $("#" + idX + " #timmer").html("EXPIRED");
                        var mp3_url = 'sounds/ben10.mp3';
                        console.log(total);
                        if(total>0){
                            (new Audio(mp3_url)).play();
                        }
                    }
                }, 1000);
            }
            function actualizaModal(idX){
                $('.modal-title').html("Hola")
                $(".modal #folio").val(idX);
            }
            function cerrarTiempo(idX){
                window.location.href = "engine/ControlTiempo.php?opc=cerrarTiempo&folio="+idX;
            }

            function calcular(idX){
                window.location.href = "engine/ControlTiempo.php?opc=cobrar&folio="+idX;
            }
            
            function cobrar(idX){
                window.location.href = "engine/ControlTiempo.php?opc=pagado&folio="+idX;
            }
            
            function cerrarSesion(){
                jQuery.ajax({
                    type: "POST",
                    url: "engine/api.php",
                    data: { opc:'cerrarSesion'},
                    success: function (result) {
                         window.location.href = result.link;
                    }
                });
            }
        </script>
    </body>
</html>

<?php
}
?>