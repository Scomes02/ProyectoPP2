// Ejemplo de datos de productos
let products = [
    { id: 1111111111111, name: 'Producto 1', price: 100, quantity: 5 },
    { id: 2222222222222, name: 'Producto 2', price: 200, quantity: 3 },
];

// Función para renderizar la tabla de productos
function renderProductTable() {
    const tbody = document.getElementById('productTable').getElementsByTagName('tbody')[0];
    tbody.innerHTML = '';

    products.forEach(product => {
        const row = tbody.insertRow();
        row.insertCell().textContent = product.id;
        row.insertCell().textContent = product.name;
        row.insertCell().textContent = product.price;
        row.insertCell().textContent = product.quantity;

        const actionsCell = row.insertCell();
        const editButton = document.createElement('button');
        editButton.textContent = 'Editar';
        editButton.className = 'edit';

        const deleteButton = document.createElement('button');
        deleteButton.textContent = 'Eliminar';
        deleteButton.className = 'delete';

        actionsCell.appendChild(editButton);
        actionsCell.appendChild(deleteButton);

        editButton.addEventListener('click', () => {
            // Lógica para editar el producto
            console.log('Editar', product);
        });

        deleteButton.addEventListener('click', () => {
            // Lógica para eliminar el producto
            console.log('Eliminar', product);
        });
    });
}

// Función para agregar un nuevo producto
function addProduct() {
    const newProduct = {
        id: Date.now(), // Usar timestamp como ID único
        name: prompt('Ingrese el nombre del producto'),
        price: parseFloat(prompt('Ingrese el precio del producto')),
        quantity: parseInt(prompt('Ingrese la cantidad del producto'))
    };

    if (newProduct.name && newProduct.price && newProduct.quantity) {
        products.push(newProduct);
        renderProductTable();
    } else {
        alert('Todos los campos son obligatorios');
    }
}

// Función para buscar un producto
function searchProduct() {
    const searchInput = document.getElementById('search');
    const searchTerm = searchInput.value.toLowerCase();

    const tbody = document.getElementById('productTable').getElementsByTagName('tbody')[0];
    const rows = tbody.getElementsByTagName('tr');

    for (let i = 0; i < rows.length; i++) {
        const nameCell = rows[i].getElementsByTagName('td')[1];
        if (nameCell.textContent.toLowerCase().includes(searchTerm)) {
            rows[i].style.display = 'table-row';
        } else {
            rows[i].style.display = 'none';
        }
    }
}

// Función para actualizar la lista completa
function updateProductList() {
    console.log('Actualizar lista completa');
}

// Event listeners
document.getElementById('addProduct').addEventListener('click', addProduct);
document.getElementById('updateList').addEventListener('click', updateProductList);
document.getElementById('search').addEventListener('input', searchProduct);

// Inicializar la tabla
renderProductTable();

// Función para mostrar el GIF de carga y redirigir después de 5 segundos
document.getElementById('exitButton').addEventListener('click', function(event) {
    event.preventDefault(); // Evitar la redirección inmediata
    const loadingDiv = document.getElementById('loading');
    loadingDiv.style.display = 'block'; // Mostrar el GIF de carga
    setTimeout(function() {
        window.location.href = 'InicioComercio.html'; // Redirigir después de 5 segundos
    }, 5000);
});