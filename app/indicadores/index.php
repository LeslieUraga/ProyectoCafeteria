<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');

$sql_indicadores = "SELECT e.nombre,
                    e.apellido_paterno,
                    e.apellido_materno,
                    e.rfc,
                    COALESCE(he.fechaEntrada, CURRENT_DATE) AS fechaEntrada,
                    COALESCE(he.fechaSalida, CURRENT_DATE) AS fechaSalida,
                    COALESCE(he.horaEntrada, '00:00:00') AS horaEntrada,
                    COALESCE(he.horaSalida, '00:00:00') AS horaSalida
             FROM empleados e
             LEFT JOIN horario_empleados he ON e.rfc = he.rfc";

$query = $pdo->prepare($sql_indicadores);
$query->execute();
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);

if (empty($empleados)) {
    echo "No se encontraron empleados.";
    exit;
}

$dataArray = [];
foreach ($empleados as $empleado) {
    $rfc = $empleado['rfc'];
    $nombre_completo = $empleado['nombre'] . ' ' . $empleado['apellido_paterno'] . ' ' . $empleado['apellido_materno'];
    $fechaEntrada = $empleado['fechaentrada'];
    $fechaSalida = $empleado['fechasalida'];
    $horaEntrada = new DateTime($empleado['horaentrada']);
    $horaSalida = new DateTime($empleado['horasalida']);

    if ($horaSalida < $horaEntrada) {
        $horaSalida->modify('+1 day');
    }

    $interval = $horaSalida->diff($horaEntrada);
    $horas_trabajadas = ($interval->h) + ($interval->i / 60);

    
    if (isset($dataArray[$rfc])) {
        $dataArray[$rfc][1] += $horas_trabajadas; 
    } else {
        $dataArray[$rfc] = [$nombre_completo, $horas_trabajadas];
    }
}
// Convertir el array a JSON
$jsonData = json_encode(array_values($dataArray));  
if ($jsonData === false) {
    echo 'Error en la codificación JSON: ' . json_last_error_msg();
    exit;
}
?>

<div class="container-fluid">
  <div class="card">
    <div class="card-body">
      <div id="bar-chart" style="width: 100%; height: 400px;"></div>
    </div>
  </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['bar']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var jsonData = <?php echo $jsonData; ?>;
    console.log(jsonData);  

    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Empleado');
    data.addColumn('number', 'Horas Trabajadas');

    data.addRows(jsonData); 

    var options = {
      chart: {
        title: 'Horas Trabajadas por Empleado',
        subtitle: 'Horas trabajadas en minutos'
      },
      bars: 'horizontal',
      colors: ['#814a3e'],
      width: '100%',
      height: 400
    };

    var chart = new google.charts.Bar(document.getElementById('bar-chart'));
    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>

<?php
include('../../layout/parte2.php');
?>
