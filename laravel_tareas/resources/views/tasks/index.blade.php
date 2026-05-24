@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">Nueva Tarea</div>
            <div class="card-body">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Título</label>
                        <input type="text" name="titulo" class="form-control" required>
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
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tareas as $tarea)
                                <tr>
                                    <td><strong>{{ $tarea->titulo }}</strong></td>
                                    <td>{{ $tarea->descripcion }}</td>
                                    <td>
                                        <select class="form-select change-status-select" data-id="{{ $tarea->id }}">
                                            <option value="Pendiente" {{ $tarea->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                                            <option value="En Progreso" {{ $tarea->estado == 'En Progreso' ? 'selected' : '' }}>En Progreso</option>
                                            <option value="Completada" {{ $tarea->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
                                        </select>
                                    </td>
                                    <td>
                                        <a href="{{ route('tasks.edit', $tarea->id) }}" class="btn btn-sm btn-outline-primary">Editar</a>
                                        <form action="{{ route('tasks.destroy', $tarea->id) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Seguro que quieres eliminar esta tarea?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">No tienes tareas registradas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('.change-status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const taskId = this.getAttribute('data-id');
            const newStatus = this.value;
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            
            fetch(`{{ url('tasks') }}/${taskId}/status`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ estado: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    alert('¡Estado actualizado correctamente!');
                } else {
                    alert('Error al procesar el cambio de estado.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });
});
</script>
@endpush
