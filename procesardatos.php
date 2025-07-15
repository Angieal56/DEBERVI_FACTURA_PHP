<?php
//Calcular total con IVA
function calcularTotalConIVA($precio, $cantidad, $aplicaIVA) {
    $subtotal = $precio * $cantidad;
    $iva = $aplicaIVA ? $subtotal * 0.15 : 0;
    $total = $subtotal + $iva;
    return [$subtotal, $iva, $total];
}

//Registro de datos
$cliente = $_POST['cliente'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];
$comentarios = $_POST['comentarios'];

$productos = $_POST['producto'];
$precios = $_POST['precio'];
$cantidades = $_POST['cantidad'];
$categorias = $_POST['categoria'];
$ivasMarcados = isset($_POST['iva']) ? $_POST['iva'] : [];

$subtotalGeneral = 0;
$totalIVA = 0;
$totalFinal = 0;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura generada final</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4 text-center fw-bold">Factura</h2>

        <div class="mb-4">
            <strong>Cliente:</strong> <?=htmlspecialchars($cliente) ?><br>
            <strong>Correo:</strong> <?=htmlspecialchars($correo) ?><br>
            <strong>Fecha:</strong> <?=htmlspecialchars($fecha) ?><br>
            <strong>Comentarios:</strong> <?=nl2br(htmlspecialchars($comentarios)) ?><br>
        </div>

        <table class="table table-bordered bg-light">
            <thead class="table-success">
                <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Categoria</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subototal</th>
                    <th>IVA</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($productos as $i => $nombre):
                $precio = floatval($precios[$i]);
                $cantidad = intval($cantidades[$i]);
                $categoria = $categorias[$i];
                $aplicaIVA = in_array($i, $ivasMarcados);

                list($subtotal, $iva, $total) = calcularTotalConIVA($precio, $cantidad, $aplicaIVA);
                $subtotalGeneral += $subtotal;
                $totalIVA += $iva;
                $totalFinal += $total;
            ?>
                <tr>
                    <td><?= $i +1 ?></td>
                    <td><?= htmlspecialchars($nombre) ?></td>
                    <td><?= htmlspecialchars($categoria) ?></td>
                    <td><?= number_format($precio, 2) ?></td>
                    <td><?= $cantidad ?></td>
                    <td><?= number_format($subtotal, 2) ?></td>
                    <td><?= number_format($iva, 2) ?></td>
                    <td><?= number_format($total, 2) ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot class="table-success">
                <tr>
                    <th colspan="5">Totales</th>
                    <th>$<?= number_format($subtotalGeneral, 2) ?></th>
                    <th>$<?= number_format($totalIVA, 2) ?></th>
                    <th>$<?= number_format($totalFinal, 2) ?></th>
                </tr>
            </tfoot>
        </table>
    </div>    
</body>
</html>
