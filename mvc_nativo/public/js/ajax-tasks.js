 document.addEventListener('DOMContentLoaded', function() {
    const statusSelects = document.querySelectorAll('.change-status-select');
    
    statusSelects.forEach(select => {
        select.addEventListener('change', function() {
            const taskId = this.getAttribute('data-id');
            const newStatus = this.value;
            
            const formData = new FormData();
            formData.append('id', taskId);
            formData.append('estado', newStatus);
            
            // Envia al endpoint nativo con Fetch API
            fetch('index.php?action=updateAjax', {
                method: 'POST',
                body: formData
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