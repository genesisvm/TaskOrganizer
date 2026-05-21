<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel de Tareas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">TaskOrganizer</a>
            <span class="navbar-text text-white">Hola, <?php echo $_SESSION['usuario_nombre']; ?></span>
        </div>
    </nav>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">Nueva Tarea</div>
                    <div class="card-body">
                        <form action="/mvc_nativo/public/index.php?action=store" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Título</label>
                                <input type="text" name="titulo" class="form-row form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Descripción</label>
                                <textarea name="descripcion" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Guardar Tarea</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-dark text-white">Mis Actividades</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle">
                                <thead>
                                    <tr>
                                        <th>Tarea</th>
                                        <th>Descripción</th>
                                        <th>Estado (AJAX)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(empty($tareas)): ?>
                                        <tr><td colspan="3" class="text-center text-muted">No tienes tareas registradas</td></tr>
                                    <?php else: ?>
                                        <?php foreach($tareas as $tarea): ?>
                                            <tr>
                                                <td><strong><?php echo htmlspecialchars($tarea['titulo']); ?></strong></td>
                                                <td><?php echo htmlspecialchars($tarea['descripcion']); ?></td>
                                                <td>
                                                    <select class="form-select change-status-select" data-id="<?php echo $tarea['id']; ?>">
                                                        <option value="Pendiente" <?php echo $tarea['estado'] == 'Pendiente' ? 'selected' : ''; ?>>Pendiente</option>
                                                        <option value="En Progreso" <?php echo $tarea['estado'] == 'En Progreso' ? 'selected' : ''; ?>>En Progreso</option>
                                                        <option value="Completada" <?php echo $tarea['estado'] == 'Completada' ? 'selected' : ''; ?>>Completada</option>
                                                    </select>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/mvc_nativo/public/js/ajax-tasks.js"></script>
</body>
</html>