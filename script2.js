// Ejemplo de datos de comercios y productos
let commerces = [
    { id: 1, name: 'McDonalds', products: [
        {name: 'Hamburguesa triple', price: 16000, quantity: 5 },
        { name: 'Hamburguesa doble', price: 12000, quantity: 3 }
    ] },
    { id: 2, name: 'Mostaza', products: [
        { name: 'Hamburguesa triple', price: 10500, quantity: 4 },
        { name: 'Hamburguesa doble', price: 7500, quantity: 2 }
    ] },
];

// Función para renderizar la lista de comercios
function renderCommerceList() {
    const commerceList = document.getElementById('commerceList');
    commerceList.innerHTML = '';

    commerces.forEach(commerce => {
        const li = document.createElement('li');
        li.textContent = commerce.name;
        li.addEventListener('click', () => {
            showProducts(commerce.id);
        });
        commerceList.appendChild(li);
    });
}

// Función para mostrar los productos de un comercio
function showProducts(commerceId) {
    const commerce = commerces.find(c => c.id === commerceId);
    if (commerce) {
        renderProductTable(commerce.products);
    }
}

// Función para renderizar la tabla de productos
function renderProductTable(products) {
    const tbody = document.getElementById('productTable').getElementsByTagName('tbody')[0];
    tbody.innerHTML = '';

    products.forEach(product => {
        const row = tbody.insertRow();
        row.insertCell().textContent = product.name;
        row.insertCell().textContent = product.price;
        row.insertCell().textContent = product.quantity;
    });
}

// Inicializar la lista de comercios
renderCommerceList();

// Función para mostrar el GIF de carga y redirigir después de 5 segundos
document.getElementById('exitButton').addEventListener('click', function(event) {
    event.preventDefault(); // Evitar la redirección inmediata
    const loadingDiv = document.getElementById('loading');
    loadingDiv.style.display = 'block'; // Mostrar el GIF de carga
    setTimeout(function() {
        window.location.href = 'InicioCliente.html'; // Redirigir después de 5 segundos
    }, 5000);
});
