// app.js
$(document).ready(function () {
    let edit = false;

    function setError($input, msg) {
        $input.addClass('is-invalid');
        $input.siblings('.invalid-feedback').text(msg).show();
    }
    function clearError($input) {
        $input.removeClass('is-invalid');
        $input.siblings('.invalid-feedback').text('').hide();
    }

    $('#name').on('blur input', function () {
        const $el = $(this);
        const v = $el.val().trim();
        if (v === '' || v.length > 100) setError($el, 'El nombre es obligatorio y de máximo 100 caracteres.');
        else clearError($el);
    });

    $('#marca').on('blur change', function () {
        const $el = $(this);
        if ($el.val().trim() === '') setError($el, 'Selecciona una marca.');
        else clearError($el);
    });

    $('#modelo').on('blur input', function () {
        const $el = $(this);
        const v = $el.val().trim();
        // Validación de modelo alfanumérico simple y longitud
        if (v === '' || v.length > 25 || !/^[a-zA-Z0-9\s-]+$/.test(v))
            setError($el, 'Modelo requerido, alfanumérico, máximo 25.');
        else clearError($el);
    });

    $('#precio').on('blur input', function () {
        const $el = $(this);
        const v = parseFloat($el.val());
        if (isNaN(v) || v <= 99.99) setError($el, 'El precio debe ser mayor a $99.99.');
        else clearError($el);
    });

    $('#unidades').on('blur input', function () {
        const $el = $(this);
        const v = parseInt($el.val());
        if (isNaN(v) || v < 0) setError($el, 'Las unidades deben ser 0 o más.');
        else clearError($el);
    });

    $('#detalles').on('blur input', function () {
        const $el = $(this);
        const v = $el.val();
        if (v.length > 250) setError($el, 'Máximo 250 caracteres.');
        else clearError($el);
    });

    function mostrarErrores(errores) {
        let template_bar = '<li style="list-style:none; font-weight:bold;">Error de envío:</li>';
        errores.forEach(err => {
            template_bar += `<li style="list-style:none;">${err}</li>`;
        });
        $('#product-result').show();
        $('#container').html(template_bar);
    }

    function listarProductos() {
        $.ajax({
            url: './backend/product-list.php',
            type: 'GET',
            success: function (response) {
                const productos = JSON.parse(response);
                if (Object.keys(productos).length > 0) {
                    let template = '';
                    productos.forEach(producto => {
                        let descripcion = '';
                        descripcion += '<li>precio: ' + producto.precio + '</li>';
                        descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                        descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                        descripcion += '<li>marca: ' + producto.marca + '</li>';
                        descripcion += '<li>detalles: ' + producto.detalles + '</li>';

                        template += `
                            <tr productId="${producto.id}">
                                <td>${producto.id}</td>
                                <td><a href="#" class="product-item">${producto.nombre}</a></td>
                                <td><ul>${descripcion}</ul></td>
                                <td>
                                    <button class="product-delete btn btn-danger" onclick="eliminarProducto()">
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

    $('#search').keyup(function () {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php?search=' + $('#search').val(),
                data: { search },
                type: 'GET',
                success: function (response) {
                    if (!response.error) {
                        const productos = JSON.parse(response);
                        if (Object.keys(productos).length > 0) {
                            let template = '';
                            let template_bar = '';

                            productos.forEach(producto => {
                                let descripcion = '';
                                descripcion += '<li>precio: ' + producto.precio + '</li>';
                                descripcion += '<li>unidades: ' + producto.unidades + '</li>';
                                descripcion += '<li>modelo: ' + producto.modelo + '</li>';
                                descripcion += '<li>marca: ' + producto.marca + '</li>';
                                descripcion += '<li>detalles: ' + producto.detalles + '</li>';

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

                                template_bar += `
                                    <li>${producto.nombre}</il>
                                `;
                            });
                            $('#product-result').show();
                            $('#container').html(template_bar);
                            $('#products').html(template);
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
        }
    });

    $('#product-form').submit(e => {
        e.preventDefault();

        let postData = {
            nombre: $('#name').val(),
            marca: $('#marca').val(),
            modelo: $('#modelo').val(),
            precio: $('#precio').val(),
            unidades: $('#unidades').val(),
            detalles: $('#detalles').val(),
            imagen: $('#imagen').val(),
            id: $('#productId').val()
        };

        // INICIO DE VALIDACIONES (Punto 5.2)
        let errores = [];

        if (postData.nombre.trim() === '' || postData.nombre.length > 100)
            errores.push('->El nombre es obligatorio y de máximo 100 caracteres.');
        if (postData.marca.trim() === '')
            errores.push('->Selecciona una marca.');
        if (postData.modelo.trim() === '')
            errores.push('->Modelo requerido.');
        const precioNum = parseFloat(postData.precio);
        if (isNaN(precioNum) || precioNum <= 99.99)
            errores.push('->Precio debe ser mayor a 99.99.');
        const unidadesNum = parseInt(postData.unidades);
        if (isNaN(unidadesNum) || unidadesNum < 0)
            errores.push('->Unidades deben ser 0 o más.');
        if ((postData.detalles || '').length > 250)
            errores.push('->Detalles menor a 250 caracteres.');

        if (errores.length > 0) {
            mostrarErrores(errores);
            return; // detenemos el envío
        }
        // FIN DE VALIDACIONES

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';

        $.post(url, postData, (response) => {
            let respuesta = JSON.parse(response);
            let template_bar = '';
            template_bar += `
                        <li style="list-style: none;">status: ${respuesta.status}</li>
                        <li style="list-style: none;">message: ${respuesta.message}</li>
                    `;
            $('#name, #marca, #modelo, #precio, #unidades, #detalles, #imagen').val('');
            $('#productId').val('');

            $('#product-result').show();
            $('#container').html(template_bar);
            listarProductos();
            edit = false;

            // PUNTO 3: Cambiar texto del botón a "Agregar Producto"
            $('button.btn-primary').text('Agregar Producto');

            // Limpiar los estados de error después de un envío exitoso
            $('.form-control').removeClass('is-invalid');
        });
    });

    $(document).on('click', '.product-delete', (e) => {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            const element = $(this)[0].activeElement.parentElement.parentElement;
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', { id }, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    $(document).on('click', '.product-item', (e) => {
        const element = $(this)[0].activeElement.parentElement.parentElement;
        const id = $(element).attr('productId');
        $.post('./backend/product-single.php', { id }, (response) => {
            let product = JSON.parse(response);
            $('#name').val(product.nombre);
            $('#productId').val(product.id);
            
            $('#marca').val(product.marca || '');
            $('#modelo').val(product.modelo || '');
            $('#precio').val(product.precio || '');
            $('#unidades').val(product.unidades || '');
            $('#detalles').val(product.detalles || '');
            $('#imagen').val(product.imagen || '');

            edit = true;

            // PUNTO 2: Cambiar texto del botón a "Modificar Producto"
            $('button.btn-primary').text("Modificar Producto");
        });
        e.preventDefault();
    });
});