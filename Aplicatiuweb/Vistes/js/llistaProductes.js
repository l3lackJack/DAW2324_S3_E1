
document.addEventListener('DOMContentLoaded', () => {
    const productsContainer = document.getElementById('products-container');
    const paginationContainer = document.getElementById('pagination-container');
    const itemsPerPage = 6;

    fetch('http://localhost:8003/Controladors/jsonProductes.php')
        .then(response => response.json())
        .then(data => {
            // Mostrar la primera página
            showPage(data, 1);

            // Crear la paginación
            createPagination(data);
        })
        .catch(error => console.error('Error al cargar dades:', error));

    // Mostrar una página específica
    function showPage(data, page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentPageItems = data.slice(startIndex, endIndex);
        productsContainer.innerHTML = '';

        // Crear una fila para contener los productos
        const row = document.createElement('div');
        row.classList.add('row');
        
        currentPageItems.forEach(item => {
        // Crear una columna para cada producto
        const col = document.createElement('div');
        col.classList.add('col-lg-4'); 
        col.classList.add('col-md-6'); 
        col.classList.add('col-sm-6'); 
        col.classList.add('d-flex'); 


        // Crear el elemento del producto
        const productElement = document.createElement('div');
        productElement.innerHTML = `
                <div class="card w-100 h-100 my-2 mx-2 shadow-2-strong d-flex">
                    <a href = "unProducteVista.php?idPro=${item.id}" > <img src="../img/product_picanova/${item.nom}" class="card-img-top" /></a>
                    <input value = ${item.id} type ="hidden">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex flex-row">
                            <h5 class="mb-1 me-1">
                                ${item.sell_price}€
                            </h5>
                            <span class="text-danger"><s></s></span>
                        </div>
                        <p class="card-text">
                            ${item.name}
                        </p>
                        <div class="card-footer d-flex align-items-center pt-3 px-0 pb-0 mt-auto">
                            <a href="#!" class="btn btn-primary shadow-0 me-1">Add to cart</a>
                        </div>
                    </div>
                </div>`;

        // Agregar la columna al contenedor de la fila
        col.appendChild(productElement);
        row.appendChild(col);
         });
    // Agregar la fila al contenedor principal
    productsContainer.appendChild(row);
    }


    // Crear la paginación
    function createPagination(data) {
        const totalPages = Math.ceil(data.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.addEventListener('click', (function (page) {
                return function () {
                    showPage(data, page);
                };
            })(i));
            paginationContainer.appendChild(pageButton);
        }
    }
});


document.addEventListener('DOMContentLoaded', () => {
    const productsContainer = document.getElementById('products-container');
    const paginationContainer = document.getElementById('pagination-container');
    const itemsPerPage = 6;

    fetch('http://localhost:8003/Controladors/jsonProductes.php')
        .then(response => response.json())
        .then(data => {
            // Mostrar la primera página
            showPage(data, 1);

            // Crear la paginación
            createPagination(data);
        })
        .catch(error => console.error('Error al cargar dades:', error));

    // Mostrar una página específica
    function showPage(data, page) {
        const startIndex = (page - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;
        const currentPageItems = data.slice(startIndex, endIndex);
        productsContainer.innerHTML = '';

        // Crear una fila para contener los productos
        const row = document.createElement('div');
        row.classList.add('row');
        
        currentPageItems.forEach(item => {
        // Crear una columna para cada producto
        const col = document.createElement('div');
        col.classList.add('col-lg-4'); 
        col.classList.add('col-md-6'); 
        col.classList.add('col-sm-6'); 
        col.classList.add('d-flex'); 


        // Crear el elemento del producto
        const productElement = document.createElement('div');
        productElement.innerHTML = `
                <div class="card w-100 h-100 my-2 mx-2 shadow-2-strong d-flex">
                    <a href = "unProducteVista.php?idPro=${item.id}" > <img src="../img/product_picanova/${item.nom}" class="card-img-top" /></a>
                    <input value = ${item.id} type ="hidden">
                    <div class="card-body d-flex flex-column">
                        <div class="d-flex flex-row">
                            <h5 class="mb-1 me-1">
                                ${item.sell_price}€
                            </h5>
                            <span class="text-danger"><s></s></span>
                        </div>
                        <p class="card-text">
                            ${item.name}
                        </p>
                        <div class="card-footer d-flex align-items-center pt-3 px-0 pb-0 mt-auto">
                            <a href="#!" class="btn btn-primary shadow-0 me-1">Add to cart</a>
                        </div>
                    </div>
                </div>`;

        // Agregar la columna al contenedor de la fila
        col.appendChild(productElement);
        row.appendChild(col);
         });
    // Agregar la fila al contenedor principal
    productsContainer.appendChild(row);
    }


    // Crear la paginación
    function createPagination(data) {
        const totalPages = Math.ceil(data.length / itemsPerPage);

        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.addEventListener('click', (function (page) {
                return function () {
                    showPage(data, page);
                };
            })(i));
            paginationContainer.appendChild(pageButton);
        }
    }
});
