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

    // Function to calculate totals
    const calculateTotals = () => {
        let subtotal = 0;
        let totalIva = 0;

        itemsTable.querySelectorAll('tr').forEach(row => {
            const cantidad = parseFloat(row.querySelector('.item-cantidad').value) || 0;
            const precioUnitario = parseFloat(row.querySelector('.item-precio-unitario').value) || 0;
            const aplicaIva = row.querySelector('.item-aplica-iva').checked;

            const itemTotal = cantidad * precioUnitario;
            const itemIva = aplicaIva ? (itemTotal * ivaPercentage) / 100 : 0;

            subtotal += itemTotal;
            totalIva += itemIva;

            row.querySelector('.item-total').textContent = (itemTotal + itemIva).toFixed(2);
        });

        subtotalElement.textContent = subtotal.toFixed(2);
        totalIvaElement.textContent = totalIva.toFixed(2);
        totalElement.textContent = (subtotal + totalIva).toFixed(2);
    };

    // Function to append a product row
    const appendProductRow = (product) => {
        const newRow = document.createElement('tr');

        newRow.innerHTML = `
        <td>
            <input type="hidden" name="detalle_facturas[${itemIndex}][codInventario]" value="${product.codInventario}">
            ${product.codInventario}
        </td>
        <td>
            <input type="number" name="detalle_facturas[${itemIndex}][cantidad]" class="form-control item-cantidad" min="1" required>
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

    // Handle input changes for totals
    itemsTable.addEventListener('input', function (event) {
        if (event.target.classList.contains('item-cantidad') || event.target.classList.contains('item-precio-unitario') || event.target.classList.contains('item-aplica-iva')) {
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

    // Initial totals calculation
    calculateTotals();
});
