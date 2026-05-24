<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex align-items-center" style="height: 100vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Registro de Usuario</h3>
                        <form action="index.php?action=doRegister" method="POST">
                            <div class="mb-3">
                                <label class="form-label">Nombre Completo</label>
                                <input type="text" name="nombre" class="form-control" required placeholder="Tu nombre">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Correo Electrónico</label>
                                <input type="email" name="email" class="form-control" required placeholder="correo@ejemplo.com">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Contraseña</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success w-100 mb-3">Registrarme</button>
                            <div class="text-center">
                                <a href="index.php?action=login" class="text-decoration-none">¿Ya tienes cuenta? Inicia sesión</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>