@extends('layouts.app')

@section('content')
<div class="row justify-content-center align-items-center" style="min-height: 80vh;">
    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Registro de Usuario</h3>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre Completo</label>
                        <input type="text" name="nombre" class="form-control" value="{{ old('nombre') }}" required placeholder="Tu nombre">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo Electrónico</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required placeholder="correo@ejemplo.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-3">Registrarme</button>
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-decoration-none">¿Ya tienes cuenta? Inicia sesión</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
