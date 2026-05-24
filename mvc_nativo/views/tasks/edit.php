<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Tarea - TaskOrganizer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">TaskOrganizer</a>
            <div class="d-flex align-items-center">
                <span class="navbar-text text-white me-3">Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?></span>
                <a href="index.php?action=logout" class="btn btn-sm btn-outline-light">Cerrar Sesión</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Editar Tarea</h5>
                    </div>
                    <div class="card-body">
                        <form action="index.php?action=update" method="POST">
                            <input type="hidden" name="id" value="<?php echo $tarea['id']; ?>">
                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($tarea['titulo']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="4"><?php echo htmlspecialchars($tarea['descripcion']); ?></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="index.php" class="btn btn-secondary">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Actualizar Tarea</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
