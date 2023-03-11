<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
session_start();
include 'db.php';
if (isset($_POST['opc'])){
    switch ($_POST['opc']) {
        case 'cerrarSesion':
                session_unset(); // unset $_SESSION variable for this page
                session_destroy(); // destroy session data
                header('Content-Type: application/json; charset=utf-8');
                $array = array(
                    "link" => '/login.html',
                );
                echo json_encode($array);
            break;
        
        default:
            // code...
            break;
    }
}else if (isset($_GET['opc'])){
    switch($_GET['opc']){
        case '1' : 
                $_GET['mes'];
                $sql = "SELECT sum(precio) suma,date(horaI) dia 
                FROM `RentaTotal` 
                WHERE horaI >= date('$_GET[date]') AND horaI <= last_Day(date('$_GET[date]'))
                GROUP by 2";

                $result = $conn->query($sql);
                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $diario[] = $row;
                    }
                }
                header('Content-Type: application/json; charset=utf-8');
                $array = array(
                    "porMes" => $tiempoPorMes,
                    "Diario" => $diario,
                );
                echo json_encode($array);
            break;
            case '2' : 
                $sql = "INSERT INTO `datos` (`id`, `correo`, `contrase`) VALUES (NULL, '$_GET[usuario]', '$_GET[pass]')";

                $result = $conn->query($sql);
                if ($result->num_rows > 0)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        $diario[] = $row;
                    }
                }
                 header('Content-Type: application/json; charset=utf-8');
                $array = array(
                    "porMes" => $tiempoPorMes,
                    "Diario" => $diario,
                );
                
                echo json_encode($array);
            break;
            case '3' : 
                $sql = "SELECT * FROM datos WHERE correo LIKE '".$_GET['user']."' and contrase LIKE '".$_GET['pass']."'";

                $result = $conn->query($sql);
                if ($result->num_rows > 0){
                    while ($row = $result->fetch_assoc()){
                        //id    correo  contrase    ID_Empleado 
                        $usuario[] = $row;
                        $_SESSION['auth']= $usuario[0];
                    }
                }else{
                    $_SESSION['auth']=0;
                }

                header('Content-Type: application/json; charset=utf-8');
                $array = array(
                    "usaurio" => $usuario,
                    "link" => '/index.php',
                );
                
                echo json_encode($array);
            break;
    }
}else{
    $sql = "SELECT sum(precio) as suma,
        monthName(CAST(DATE_SUB(rt1.horaI, INTERVAL DAYOFMONTH(rt1.horaI)-1 DAY) AS DATE)) AS \"mes\",
        CAST(DATE_SUB(rt1.horaI, INTERVAL DAYOFMONTH(rt1.horaI)-1 DAY) AS DATE) AS \"mesNum\"
        FROM `RentaTotal` rt1 
        GROUP BY CAST(DATE_SUB(rt1.horaI, INTERVAL DAYOFMONTH(rt1.horaI)-1 DAY) AS DATE) 
        ORDER by rt1.folio;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $tiempoPorMes[] = $row;
        }
    }

    $sql = "SELECT sum(precio) suma,date(horaI) dia FROM `RentaTotal` GROUP by 2;";

    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
        while ($row = $result->fetch_assoc())
        {
            $diario[] = $row;
        }
    }
    header('Content-Type: application/json; charset=utf-8');
    $array = array(
        "porMes" => $tiempoPorMes,
        "Diario" => $diario,
    );
    echo json_encode($array);
}