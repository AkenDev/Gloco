document.addEventListener('DOMContentLoaded', function () {
    let loteIndex = document.querySelectorAll('.lote-row').length;
    const lotesData = Array.isArray(window.lotesData) ? window.lotesData : JSON.parse(window.lotesData || '[]');
    const addLoteButton = document.getElementById('add-lote-row');

    // Function to update dropdown options dynamically
    const updateDropdownOptions = () => {
        const assignedLoteIds = Array.from(document.querySelectorAll('.lote-select'))
            .map(select => parseInt(select.value))
            .filter(id => !isNaN(id)); // Get all currently assigned Lotes
    
        // Disable "Añadir Lote" if all Lotes are assigned
        const availableLotes = lotesData.filter(lote => !assignedLoteIds.includes(lote.idLote));
        addLoteButton.disabled = availableLotes.length === 0;
    
        document.querySelectorAll('.lote-select').forEach(select => {
            const currentLoteId = parseInt(select.value) || null;
            select.innerHTML = '<option value="">Selecciones un lote...</option>';
            lotesData.forEach(lote => {
                const isAssignedElsewhere = assignedLoteIds.includes(lote.idLote) && lote.idLote !== currentLoteId;
                if (!isAssignedElsewhere) {
                    select.innerHTML += `<option value="${lote.idLote}" data-fecha-vencimiento="${lote.fechaVencimiento}" ${lote.idLote === currentLoteId ? 'selected' : ''}>
                                            ${lote.codLote}
                                        </option>`;
                }
            });
        });
    };

    // Add Row
    addLoteButton.addEventListener('click', function () {
        const newRow = document.createElement('div');
        newRow.classList.add('lote-row', 'd-flex', 'align-items-center', 'mb-2');

        const assignedLoteIds = Array.from(document.querySelectorAll('.lote-select'))
            .map(select => parseInt(select.value))
            .filter(id => !isNaN(id));
        let loteOptions = '<option value="">Seleccione un lote...</option>';
        lotesData.forEach(lote => {
            if (!assignedLoteIds.includes(lote.idLote)) {
                loteOptions += `<option value="${lote.idLote}" data-fecha-vencimiento="${lote.fechaVencimiento}">
                                    ${lote.codLote}
                                </option>`;
            }
        });

        newRow.innerHTML = `
            <select name="lotes[${loteIndex}][idLote]" class="form-control lote-select mr-2">
                ${loteOptions}
            </select>
            <input type="number" name="lotes[${loteIndex}][stockPorLote]" class="form-control lote-stock mr-2" placeholder="Stock">
            <button type="button" class="btn btn-danger remove-lote-row mr-2">Eliminar</button>
            <span class="fecha-vencimiento-label text-muted small">Sin lote asignado</span>
        `;
        document.getElementById('lote-section').appendChild(newRow);
        loteIndex++;
        updateDropdownOptions();
    });

    // Update Fecha Vencimiento on Lote Selection
    document.getElementById('lote-section').addEventListener('change', function (event) {
        if (event.target.classList.contains('lote-select')) {
            const selectedOption = event.target.options[event.target.selectedIndex];
            const fechaVencimiento = selectedOption.getAttribute('data-fecha-vencimiento');
            const fechaLabel = event.target.parentElement.querySelector('.fecha-vencimiento-label');

            fechaLabel.textContent = fechaVencimiento ? `Fecha de Vencimiento: ${fechaVencimiento}` : 'Sin lote asignado';
            updateDropdownOptions();
        }
    });

    // Remove Row
    document.getElementById('lote-section').addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-lote-row')) {
            const confirmation = confirm('¿Seguro que quiere eliminar este lote?');
            if (confirmation) {
                event.target.parentElement.remove();
                updateDropdownOptions();
            }
        }
    });

    const updateTotalStock = () => {
        const totalStock = Array.from(document.querySelectorAll('.lote-stock'))
            .map(input => parseInt(input.value) || 0) // Get all stock values
            .reduce((sum, stock) => sum + stock, 0); // Sum up the stock values
        document.getElementById('stockInventario').value = totalStock; // Update the total stock field
    };
    
    // Call `updateTotalStock` whenever a stock input changes or a row is added/removed
    document.getElementById('lote-section').addEventListener('input', event => {
        if (event.target.classList.contains('lote-stock')) {
            updateTotalStock();
        }
    });
    document.getElementById('lote-section').addEventListener('click', event => {
        if (event.target.classList.contains('remove-lote-row')) {
            updateTotalStock();
        }
    });
    
    updateDropdownOptions();
});
