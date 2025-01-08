document.addEventListener('DOMContentLoaded', function () {
    const itemsTable = document.querySelector('#items-table tbody');
    const searchProducto = document.querySelector('#searchProducto');
    const searchResults = document.querySelector('#searchResults');
    const subtotalElement = document.querySelector('#subtotal');
    const totalIvaElement = document.querySelector('#total-iva');
    const totalElement = document.querySelector('#total');
    const ivaPercentage = 15;
    let itemIndex = itemsTable.querySelectorAll('tr').length;

    const inventarios = window.inventariosData; // Get inventory data from Blade

    // Modal for Lotes elements
    const loteModal = new bootstrap.Modal(document.getElementById('loteModal'));
    const loteTableBody = document.getElementById('loteTableBody');
    const saveLoteSelection = document.getElementById('saveLoteSelection');
    let currentButton = null; // Tracks the button that opened the modal
    let selectedLotes = {}; // Store selections for each inventarioId

    // Function to calculate totals
    const calculateTotals = () => {
        let subtotal = 0;
        let totalIva = 0;
    
        itemsTable.querySelectorAll('tr').forEach((row) => {
            // Safely retrieve element values or set defaults
            const cantidadElement = row.querySelector('.item-cantidad');
            const cantidad = cantidadElement ? parseFloat(cantidadElement.value) || 0 : 0;
    
            const precioUnitarioElement = row.querySelector('.item-precio-unitario');
            const precioUnitario = precioUnitarioElement ? parseFloat(precioUnitarioElement.value) || 0 : 0;
    
            const aplicaIvaElement = row.querySelector('.item-aplica-iva');
            const aplicaIva = aplicaIvaElement ? aplicaIvaElement.checked : false;
    
            // Calculate item totals
            const itemTotal = cantidad * precioUnitario;
            const itemIva = aplicaIva ? (itemTotal * ivaPercentage) / 100 : 0;
    
            subtotal += itemTotal;
            totalIva += itemIva;
    
            // Safely set text content for total
            const itemTotalElement = row.querySelector('.item-total');
            if (itemTotalElement) {
                itemTotalElement.textContent = (itemTotal + itemIva).toFixed(2);
            }
        });
    
        // Update summary totals
        subtotalElement.textContent = subtotal.toFixed(2);
        totalIvaElement.textContent = totalIva.toFixed(2);
        totalElement.textContent = (subtotal + totalIva).toFixed(2);
    };
    

    // Function to append a product row
    const appendProductRow = (product) => {

        // Check if the product is already in the table
        const existingRow = Array.from(itemsTable.querySelectorAll('tr')).find(row => {
            const codInventarioInput = row.querySelector(`input[name*="[codInventario]"]`);
            return codInventarioInput && codInventarioInput.value === product.codInventario;
        });

        // If product already exists, exit the function
        if (existingRow) {
            return;
        }

        const newRow = document.createElement('tr');

        newRow.innerHTML = `
            <tr>
                <td>
                    <input type="hidden" name="detalle_facturas[${itemIndex}][codInventario]" value="${product.codInventario}">
                    ${product.codInventario}
                </td>
                <td>
                    <button type="button" class="btn btn-info btn-lotes" data-index="${itemIndex}" data-inventario-id="${product.idInventario}">
                        0
                    </button>
                    <input type="hidden" name="detalle_facturas[${itemIndex}][cantidad]" class="form-control item-cantidad" value="0">
                </td>
                <td>
                    ${product.descrInventario}
                    <input type="hidden" name="detalle_facturas[${itemIndex}][descripcion]" value="${product.descrInventario}">
                </td>
                <td>
                    <input type="number" name="detalle_facturas[${itemIndex}][precioUnitario]" class="form-control item-precio-unitario" value="${product.precioCordInventario}" step="0.01" min="0" required>
                </td>
                <td>
                    <input type="hidden" name="detalle_facturas[${itemIndex}][aplicaIva]" value="0">
                    <input type="checkbox" name="detalle_facturas[${itemIndex}][aplicaIva]" class="item-aplica-iva" value="1">
                </td>
                <td>
                    <span class="item-total">0.00</span>
                </td>
                <td>
                    <button type="button" class="btn btn-danger remove-item">Eliminar</button>
                </td>
            </tr>
        `;

        itemsTable.appendChild(newRow);
        itemIndex++;
        calculateTotals();
    };

    // Search and display results
    searchProducto.addEventListener('input', function () {
        const query = searchProducto.value.trim().toLowerCase();
        searchResults.innerHTML = ''; // Clear previous results

        if (!query) {
            searchResults.classList.add('d-none');
            return;
        }

        const results = inventarios.filter(product =>
            product.codInventario.toLowerCase().includes(query) ||
            product.descrInventario.toLowerCase().includes(query)
        );

        results.forEach(product => {
            const listItem = document.createElement('div');
            listItem.classList.add('list-group-item', 'list-group-item-action');
            listItem.textContent = `${product.codInventario} - ${product.descrInventario}`;
            listItem.dataset.product = JSON.stringify(product);
            searchResults.appendChild(listItem);
        });

        searchResults.classList.remove('d-none');
    });

    // Handle product selection
    searchResults.addEventListener('click', function (event) {
        const listItem = event.target.closest('.list-group-item');
        if (listItem) {
            const product = JSON.parse(listItem.dataset.product);
            appendProductRow(product);
            searchProducto.value = '';
            searchResults.classList.add('d-none');
        }
    });

    // Recalculate totals whenever input values change
    itemsTable.addEventListener('input', function (event) {
        if (event.target.classList.contains('item-precio-unitario') || event.target.classList.contains('item-aplica-iva')) {
            calculateTotals();
        }
    });

    // Handle row removal
    itemsTable.addEventListener('click', function (event) {
        if (event.target.classList.contains('remove-item')) {
            event.target.closest('tr').remove();
            calculateTotals();
        }
    });

    const fetchLotes = async (inventarioId) => {
        const userToken = localStorage.getItem('userToken'); // Get the token from localStorage
    
        if (!userToken) {
            alert('Debe iniciar sesión para ver esta información.');
            return null;
        }
    
        try {
            const response = await fetch(`/api/inventarios/${inventarioId}/lotes`, {
                method: 'GET',
                headers: {
                    'Authorization': `Bearer ${userToken}`, // Add token to headers
                    'Accept': 'application/json', // Explicitly request JSON
                },
            });
    
            if (!response.ok) {
                if (response.status === 401) {
                    throw new Error('Su sesión ha expirado o no tiene autorización para realizar esta acción.');
                }
                throw new Error('Error al cargar los lotes.');
            }
            return await response.json();
        } catch (error) {
            console.error('Error fetching lotes:', error);
            alert('No se pueden cargar los lotes en este momento. Intente de nuevo más tarde.');
            return null;
        }
    };

    // Function to populate the modal with Lotes data
    const populateLoteModal = (inventarioId, buttonIndex) => {
        fetchLotes(inventarioId).then((data) => {
            if (data.data.length === 0) {
                const row = `<tr><td colspan="2">No hay lotes disponibles.</td></tr>`;
                loteTableBody.innerHTML = row;
            }

            // Clear existing rows
            loteTableBody.innerHTML = '';

            const lotes = data.data || [];
            const currentSelections = selectedLotes[buttonIndex] || {};
            console.log(data);
            console.log(lotes);

            lotes.forEach((lote) => {
                const selectedQuantity = currentSelections[lote.codLote] || 0;
                const row = document.createElement('tr');

                

                row.innerHTML = `
                    <td>${lote.codLote}</td>
                    <td>${lote.articulos}</td>
                    <td>
                        <input type="number" 
                               class="form-control lote-quantity" 
                               min="0" 
                               max="${lote.items_count}" 
                               value="${selectedQuantity}" 
                               data-cod-lote="${lote.codLote}">
                    </td>
                `;
                loteTableBody.appendChild(row);
            });

            // Open the modal
            loteModal.show();
        });
    };

    // Handle "Lotes" button click
    itemsTable.addEventListener('click', function (event) {
        if (event.target.classList.contains('btn-lotes')) {
            currentButton = event.target;
            const inventarioId = currentButton.getAttribute('data-inventario-id');
            const buttonIndex = currentButton.getAttribute('data-index');

            populateLoteModal(inventarioId, buttonIndex);
        }
    });

    // Save the selected Lotes and update the button
    saveLoteSelection.addEventListener('click', function () {
        const buttonIndex = currentButton.getAttribute('data-index');
        const quantities = {};
        let totalQuantity = 0;

        // Gather selected quantities
        loteTableBody.querySelectorAll('.lote-quantity').forEach((input) => {
            const codLote = input.getAttribute('data-cod-lote');
            const quantity = parseInt(input.value) || 0;

            if (quantity > 0) {
                quantities[codLote] = quantity;
                totalQuantity += quantity;
            }
        });

        // Save selections and update the button
        selectedLotes[buttonIndex] = quantities;
        currentButton.textContent = totalQuantity;
        currentButton.closest('tr').querySelector('.item-cantidad').value = totalQuantity;

        calculateTotals();
        loteModal.hide();
    });

    //Set a date when tipoFactura changes
    document.addEventListener('DOMContentLoaded', function () {
        const tipoFacturaSelect = document.getElementById('tipoFactura');
        const fechaVenceGroup = document.getElementById('fechaVenceGroup');
        
        const toggleFechaVence = () => {
            if (tipoFacturaSelect.value === 'credito') {
                fechaVenceGroup.style.display = 'block';
                document.getElementById('fechaVence').required = true;
            } else {
                fechaVenceGroup.style.display = 'none';
                document.getElementById('fechaVence').required = false;
            }
        };

        tipoFacturaSelect.addEventListener('change', toggleFechaVence);
        toggleFechaVence(); // Initialize on page load
    });



    // Initial totals calculation
    calculateTotals();
});
