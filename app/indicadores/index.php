<?php
include('../config.php');
include('../../layout/sesion.php');
include('../../layout/parte1.php');

// Conexión a la base de datos y obtención de datos de empleados y horarios
$sql_indicadores = "SELECT e.nombre,
               e.apellido_paterno,
               e.apellido_materno,
               e.rfc,
               COALESCE(he.fechaEntrada, CURDATE()) AS fechaEntrada,
               COALESCE(he.fechaSalida, CURDATE()) AS fechaSalida,
               COALESCE(he.horaEntrada, '00:00:00') AS horaEntrada,
               COALESCE(he.horaSalida, '00:00:00') AS horaSalida
        FROM empleados e
        LEFT JOIN horario_empleados he ON e.rfc = he.rfc";
$query = $pdo->prepare($sql_indicadores);
$query->execute();
$empleados = $query->fetchAll(PDO::FETCH_ASSOC);

// Convertir los datos de la base de datos a un formato JSON para pasarlos a JavaScript
$dataArray = [];
foreach ($empleados as $empleado) {
    $nombre_completo = $empleado['nombre'] . ' ' . $empleado['apellido_paterno'] . ' ' . $empleado['apellido_materno'];
    $fechaEntrada = $empleado['fechaEntrada'];
    $fechaSalida = $empleado['fechaSalida'];
    $horaEntrada = new DateTime($empleado['horaEntrada']);
    $horaSalida = new DateTime($empleado['horaSalida']);
    $rfc = $empleado['rfc'];
    
    // Ajustar la hora de salida si es antes de la hora de entrada (suponiendo que es al día siguiente)
    if ($horaSalida < $horaEntrada) {
        $horaSalida->modify('+1 day');
    }

    // Calcular la diferencia entre la hora de salida y entrada
    $interval = $horaSalida->diff($horaEntrada);
    $horas_trabajadas = ($interval->h) + ($interval->i / 60);

    // Agregar los datos al array
    if (!isset($dataArray[$nombre_completo])) {
        $dataArray[$nombre_completo] = 0;
    }
    $dataArray[$nombre_completo] += $horas_trabajadas;
}

// Convertir el array a JSON
$jsonData = [];
foreach ($dataArray as $nombre => $horas) {
    $jsonData[] = [$nombre, $horas];
}
$jsonData = json_encode($jsonData);
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
    console.log(jsonData);  // Verifica los datos en la consola

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
