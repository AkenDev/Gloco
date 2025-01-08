document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.view-lotes-btn').forEach(button => {
        button.addEventListener('click', () => {
            const userToken = localStorage.getItem('userToken'); // Get the token
            const inventarioId = button.getAttribute('data-id');

            if (!userToken) {
                alert('Debe iniciar sesión para ver esta información.');
                return;
            }

            fetch(`/api/inventarios/${inventarioId}/lotes`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${userToken}`,
                    'Accept': 'application/json', // Explicitly request JSON
                },
            })
                .then(response => {
                    if (!response.ok) {
                        if (response.status === 401) {
                            throw new Error('Su sesión ha expirado o no tiene autorización para realizar esta acción.');
                        }
                        throw new Error('Error extrayendo los lotes.');
                    }
                    return response.json();
                })
                .then(data => {
                    const tableBody = document.getElementById('loteTableBody');
                    tableBody.innerHTML = ''; // Clear previous data

                    if (data.data.length === 0) {
                        const row = `<tr><td colspan="2">No hay lotes disponibles.</td></tr>`;
                        tableBody.innerHTML = row;
                    } else {
                        data.data.forEach(lote => {
                            const row = `<tr>
                                <td>${lote.codLote}</td>
                                <td>${lote.articulos}</td>
                            </tr>`;
                            tableBody.innerHTML += row;
                        });
                    }

                    const modal = new bootstrap.Modal(document.getElementById('loteModal'));
                    modal.show();
                })
                .catch(error => {
                    console.error('Hubo un error extrayendo los lotes:', error);
                    alert(error.message);
                });
        });
    });
});
