<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FACTURA CON FORMULARIOS EN PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">   
</head>
<body class="bg-dark">
    <div class="container mt-5" >
        <h1 class="mb-4 text-center fw-bold text-light">Factura</h1>

        <form action="procesardatos.php" method="POST">
            <div class="border p-4 mb-3 bg-primary text-white">
                <div class="mb-3">
                    <label>Cliente</label>
                    <input type="text" name="cliente" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Correo electrónico</label>
                    <input type="email" name="correo" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Fecha</label>
                    <input type="date" name="fecha" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Comentarios</label>
                    <textarea name="comentarios" class="form-control"></textarea>
                </div>
            </div>
            <h4 class="mt-4">Productos</h4>
            <?php for ($i = 0; $i < 3; $i++): ?>
                <div class="border p-3 mb-3 bg-light">
                    <h5>Producto <?= $i + 1 ?></h5>
                    <div class="mb-2">
                        <label>Nombre del producto</label>
                        <input type="text" name="producto[]" class="form-control" required>
                    </div> 
                    <div class="mb-2">
                        <label>Precio</label>
                        <input type="number" name="precio[]" step="0.01" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Cantidad</label>
                        <input type="number" name="cantidad[]" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label>Categoria</label>
                        <select name="categoria[]" class="form-select">
                            <option>Tecnología</opcion>
                            <option>Alimentación</opcion>
                            <option>Linea Blanca</opcion>
                            <option>Indumentaria</opcion>
                            <option>Otros</opcion>
                        </select>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="iva[]" value="<?= $i ?>">
                        <label class="form-check-label">Aplicar IVA 15%</label>
                    </div>

                    </div>
                </div>    
            <?php endfor; ?>
        <div class="text-center mt-4"> 
            <button type="submit" class="btn btn-success ">Generar Factura</button>
        </div>  
        </form>
    </div>
</body>
</html>