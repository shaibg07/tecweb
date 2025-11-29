// JSON BASE A MOSTRAR EN FORMULARIO
var baseJSON = {
    "precio": 0.0,
    "unidades": 1,
    "modelo": "XX-000",
    "marca": "NA",
    "detalles": "NA",
    "imagen": "img/default.png"
};

$(document).ready(function(){
    let edit = false;

    $('#product-result').hide();
    listarProductos();

    function listarProductos() {
        $.ajax({
            url: 'http://localhost/tecweb/actividades/a09/product_app/backend/products',
            type: 'GET',
            dataType: 'json',
            success: function(productos) {
                if(Object.keys(productos).length > 0) {
                    let template = '';

                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: '+producto.precio+'</li>';
                        descripcion += '<li>unidades: '+producto.unidades+'</li>';
                        descripcion += '<li>modelo: '+producto.modelo+'</li>';
                        descripcion += '<li>marca: '+producto.marca+'</li>';
                        descripcion += '<li>detalles: '+producto.detalles+'</li>';
                    
                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger">
                                        Eliminar
                                    </button>
                                </td>
                            </tr>
                        `;
                    });
                    $('#products').html(template);
                }
            }
        });
    }

    $('#search').keyup(function() {
        if($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: 'http://localhost/tecweb/actividades/a09/product_app/backend/products/' + encodeURIComponent(search),
                data: {search},
                type: 'GET',
                dataType: 'json',
                success: function (productos) {
                    if (Object.keys(productos).length > 0) {
                        let template = '';
                        let template_bar = '';

                        productos.forEach(producto => {
                            let descripcion = `
                                <li>precio: ${producto.precio}</li>
                                <li>unidades: ${producto.unidades}</li>
                                <li>modelo: ${producto.modelo}</li>
                                <li>marca: ${producto.marca}</li>
                                <li>detalles: ${producto.detalles}</li>`;

                            template += `
                                <tr productId="${producto.id}">
                                    <td>${producto.id}</td>
                                    <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                    <td><ul>${descripcion}</ul></td>
                                    <td>
                                        <button class="product-delete btn btn-danger">
                                            Eliminar
                                        </button>
                                    </td>
                                </tr>`;

                            template_bar += `<li>${producto.nombre}</li>`;
                        });

                        $('#product-result').show();
                        $('#container').html(template_bar);
                        $('#products').html(template);
                    }
                }
            });
        } else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();
    
        // Construye el objeto desde los campos individuales
        const postData = {
            nombre: $('#name').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            precio: $('#precio').val(),
            detalles: $('#detalles').val(),
            unidades: $('#unidades').val(),
            imagen: $('#imagen').val() || 'img/default.png',
            id: $('#productId').val()
        };
    
        const url    = 'http://localhost/tecweb/actividades/a09/product_app/backend/product';
        const method = edit ? 'PUT' : 'POST';
    
        $.ajax({
            url,
            method,
            contentType: 'application/json; charset=utf-8',
            dataType: 'json',
            data: JSON.stringify(postData),
            success: (respuesta) => {
                const template_bar = `
                    <li style="list-style:none;">status: ${respuesta.status}</li>
                    <li style="list-style:none;">message: ${respuesta.message}</li>`;
                
                // Limpia todos los campos
                $('#name').val('');
                $('#marca').val('');
                $('#modelo').val('');
                $('#precio').val('');
                $('#unidades').val('');
                $('#detalles').val('');
                $('#imagen').val('');
                $('#productId').val('');
                
                $('#product-result').show();
                $('#container').html(template_bar);
                listarProductos();
                edit = false;
            }
        });
    });

    $(document).on('click', '.product-delete', function() {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this).closest('tr');
            const id = $(element).attr('productId');
    
            $.ajax({
                url: 'http://localhost/tecweb/actividades/a09/product_app/backend/product',
                method: 'DELETE',
                contentType: 'application/json; charset=utf-8',
                dataType: 'json',
                data: JSON.stringify({ id }),
                success: (result) => {
                    const template_bar = `
                        <li style="list-style:none;">status: ${result.status}</li>
                        <li style="list-style:none;">message: ${result.message}</li>`;
                    $('#product-result').show();
                    $('#container').html(template_bar);
                    listarProductos();
                }
            });
        }
    });

    // ✅ FUNCIÓN CORREGIDA: Ahora llena los campos individuales
    $(document).on('click', '.product-item', function(e) {
        e.preventDefault();
        
        const element = $(this).closest('tr');
        const id = $(element).attr('productId');
    
        $.ajax({
            url: 'http://localhost/tecweb/actividades/a09/product_app/backend/product/' + id,
            method: 'GET',
            dataType: 'json',
            success: (product) => {
                // Llena cada campo individual
                $('#name').val(product.nombre);
                $('#marca').val(product.marca);
                $('#modelo').val(product.modelo);
                $('#precio').val(product.precio);
                $('#unidades').val(product.unidades);
                $('#detalles').val(product.detalles);
                $('#imagen').val(product.imagen);
                $('#productId').val(product.id);
                
                edit = true;
            }
        });
    });
});