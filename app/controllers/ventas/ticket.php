<?php
// Incluir la configuración de la base de datos
include("../../config.php");

// Obtener el ID de la venta desde la URL
$id_venta = $_GET['id'];

try {
    // Consulta para obtener la venta y detalles
    $sql_ventas = "
        SELECT
            v.id_venta,
            v.fecha_venta,
            v.total,
            CONCAT(e.nombre, ' ', e.apellido_paterno, ' ', e.apellido_materno) AS nombre,
            GROUP_CONCAT(p.nombre SEPARATOR ', ') AS productos,
            SUM(dv.cantidad) AS cantidad
        FROM ventas v
        JOIN detalle_ventas dv ON dv.id_venta = v.id_venta
        JOIN empleados e ON e.rfc = v.rfc
        JOIN productos p ON p.id_producto = dv.id_producto
        WHERE v.id_venta = :id_venta
        GROUP BY v.id_venta, v.fecha_venta, v.total, e.nombre, e.apellido_paterno, e.apellido_materno
    ";

    // Preparar y ejecutar la consulta
    $query_ventas = $pdo->prepare($sql_ventas);
    $query_ventas->bindParam(':id_venta', $id_venta, PDO::PARAM_INT);
    $query_ventas->execute();

    // Obtener los resultados
    $venta = $query_ventas->fetch(PDO::FETCH_ASSOC);

    // Si se encuentra la venta
    if ($venta) {
        // Crear el contenido de la página HTML
        echo "
        <html>
        <head>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    margin: 0;
                    padding: 0;
                    width: 300px; /* Ajuste para el tamaño del ticket */
                    margin-left: auto;
                    margin-right: auto;
                    font-size: 12px; /* Tamaño de texto adecuado para tickets */
                    background-color: #fff;
                    border: 1px solid #ccc;
                    padding: 10px;
                }
                .ticket {
                    text-align: center;
                    margin-top: 10px;
                }
                .ticket h2 {
                    font-size: 16px;
                    margin-bottom: 10px;
                    text-transform: uppercase;
                }
                .ticket .details {
                    margin-bottom: 20px;
                }
                .ticket p {
                    margin: 5px 0;
                }
                .ticket .products {
                    text-align: left;
                    margin-bottom: 10px;
                }
                .ticket .thank-you {
                    margin-top: 20px;
                    font-size: 14px;
                    font-weight: bold;
                    margin-bottom: 5px;
                }
                .ticket .footer {
                    margin-top: 30px;
                    font-size: 10px;
                    color: #aaa;
                }
                /* Botón de impresión */
                .print-btn {
                    text-align: center;
                    margin-top: 20px;
                }
                .print-btn button {
                    padding: 10px 20px;
                    font-size: 14px;
                    cursor: pointer;
                    background-color: #4CAF50;
                    color: white;
                    border: none;
                    border-radius: 5px;
                }
                .print-btn button:hover {
                    background-color: #45a049;
                }
            </style>
        </head>
        <body>
            <div class='ticket'>
                <h2>TICKET DE VENTA</h2>
                <div class='details'>
                    <p><strong>Venta N°:</strong> " . $venta['id_venta'] . "</p>
                    <p><strong>Fecha:</strong> " . $venta['fecha_venta'] . "</p>
                    <p><strong>Empleado:</strong> " . $venta['nombre'] . "</p>
                </div>

                <div class='products'>
                    <p><strong>Productos:</strong></p>";
        
        // Mostrar los productos
        $productos = explode(", ", $venta['productos']);
        foreach ($productos as $producto) {
            echo "<p>- " . $producto . "</p>";
        }

        echo "
                </div>
                <p><strong>Cantidad:</strong> " . $venta['cantidad'] . "</p>
                <p><strong>Total:</strong> $" . number_format($venta['total'], 2) . "</p>
                
                <div class='thank-you'>¡Gracias por su compra!</div>
                
                <div class='footer'>
                    <p>¡Vuelva pronto!</p>
                    <p>www.cafeteria.com</p>
                </div>
            </div>

            <!-- Botón de impresión -->
            <div class='print-btn'>
                <button onclick='window.print();'>Imprimir Ticket</button>
            </div>

            <script>
                // Activar la impresión automática cuando la página se carga
                window.onload = function() {
                    window.print();
                };
            </script>
        </body>
        </html>
        ";

    } else {
        echo "Venta no encontrada.";
    }

} catch (PDOException $e) {
    echo "Error al ejecutar la consulta: " . $e->getMessage();
}
?>
