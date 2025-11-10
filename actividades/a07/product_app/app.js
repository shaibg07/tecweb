$(document).ready(function () {
    let edit = false;

    $('#product-result').hide();
    listarProductos();

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

    let timerNombre = null;
    $('#name').on('keyup blur', function () {
        const $el = $(this);
        const nombre = $el.val().trim();
        const currentProductId = $('#productId').val();

        if (nombre.length === 0 || $el.hasClass('is-invalid')) {
            clearTimeout(timerNombre);
            $('#product-result').hide();
            return;
        }

        clearTimeout(timerNombre);
        timerNombre = setTimeout(function () {
            $.ajax({
                url: './backend/product-search.php',
                type: 'GET',
                data: { search: nombre },
                success: function (resp) {
                    let arr = [];
                    try { arr = JSON.parse(resp) || []; } catch (e) { }

                    const existe = arr.some(p => 
                        (p.nombre || '').toLowerCase() === nombre.toLowerCase() && 
                        p.id != currentProductId
                    );

                    if (existe) {
                        $el.addClass('is-invalid');
                        const template_bar = `
                            <li style="list-style:none;font-weight:bold;">El nombre "${nombre}" ya existe :(</li>
                        `;
                        $('#product-result').show(); 
                        $('#container').html(template_bar);
                    } else {
                        $el.removeClass('is-invalid');
                        const template_bar = `
                            <li style="list-style:none;font-weight:bold;">El nombre "${nombre}" sin coincidencias :)</li>
                        `;
                        $('#product-result').show(); 
                        $('#container').html(template_bar);
                    }
                }
            });
        }, 300);
    });

    // --- Funciones Auxiliares ---
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

    // --- Búsqueda de Productos ---
    $('#search').keyup(function () {
        if ($('#search').val()) {
            let search = $('#search').val();
            $.ajax({
                url: './backend/product-search.php',
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
                        }else {
                            $('#product-result').hide();
                            $('#container').html('');
                            $('#products').html('<tr><td colspan="4" class="text-center">No se encontraron coincidencias.</td></tr>');
                        }
                    }
                }
            });
        }
        else {
            $('#product-result').hide();
            listarProductos(); // Opcional: volver a listar todos los productos al limpiar
        }
    });

    // --- Manejo del Formulario (Agregar/Modificar) 🚀 CORRECCIÓN CLAVE AQUÍ 🚀 ---
    $('#product-form').submit(e => {
        e.preventDefault();

        // Disparar todas las validaciones síncronas
        $('#name').trigger('blur');
        $('#marca').trigger('change');
        $('#modelo').trigger('blur');
        $('#precio').trigger('blur');
        $('#unidades').trigger('blur');
        $('#detalles').trigger('blur');
        // No se valida #imagen aquí, asumo que la validación es opcional/externa

        if ($('.form-control.is-invalid').length > 0) {
            $('#product-result').hide();
            return; // Detener el envío del formulario si hay errores de validación visible
        }

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

        // Re-validación del lado del cliente (si no se confía en la validación por 'blur')
        let errores = [];
        if (postData.nombre.trim() === '' || postData.nombre.length > 100)
            errores.push('->El nombre es obligatorio y de máximo 100 caracteres.');
        if (postData.marca.trim() === '')
            errores.push('->Selecciona una marca.');
        if (postData.modelo.trim() === '' || !/^[a-zA-Z0-9\s-]+$/.test(postData.modelo.trim()))
            errores.push('->Modelo requerido y debe ser alfanumérico.');
        const precioNum = parseFloat(postData.precio);
        if (isNaN(precioNum) || precioNum <= 99.99)
            errores.push('->Precio debe ser mayor a $99.99.');
        const unidadesNum = parseInt(postData.unidades);
        if (isNaN(unidadesNum) || unidadesNum < 0)
            errores.push('->Unidades deben ser 0 o más.');
        if ((postData.detalles || '').length > 250)
            errores.push('->Detalles menor a 250 caracteres.');

        if (errores.length > 0) {
            mostrarErrores(errores);
            return; 
        }

        const url = edit === false ? './backend/product-add.php' : './backend/product-edit.php';
        
        // 🚨 CORRECCIÓN: Usar $.ajax para enviar datos como JSON si el backend lo requiere para editar
        const dataToSend = JSON.stringify(postData);

        $.ajax({
            url: url,
            type: 'POST',
            data: dataToSend,
            contentType: 'application/json', // Clave para enviar como JSON
            success: function(response) {
                let respuesta = JSON.parse(response);
                let template_bar = '';
                template_bar += `
                    <li style="list-style: none;">status: ${respuesta.status}</li>
                    <li style="list-style: none;">message: ${respuesta.message}</li>`;
                
                // Limpiar formulario y estados
                $('#product-form').trigger('reset'); // Resetea todos los campos
                $('#productId').val('');
                $('.form-control').removeClass('is-invalid');
                $('.invalid-feedback').hide(); // Ocultar mensajes de error

                $('#product-result').show();
                $('#container').html(template_bar);
                listarProductos();
                edit = false;

                // Cambiar texto del botón a "Agregar Producto"
                $('button.btn-primary').text('Agregar Producto');
            },
            error: function(xhr, status, error) {
                 mostrarErrores([`Error en la solicitud al servidor: ${status}`]);
            }
        });
    });

    // --- Eliminar Producto ---
    $(document).on('click', '.product-delete', (e) => {
        if (confirm('¿Realmente deseas eliminar el producto?')) {
            // Se usa .closest('tr') para subir hasta la fila de la tabla
            const element = $(e.currentTarget).closest('tr');
            const id = $(element).attr('productId');
            $.post('./backend/product-delete.php', { id }, (response) => {
                $('#product-result').hide();
                listarProductos();
            });
        }
    });

    // --- Cargar Producto para Edición ---
    $(document).on('click', '.product-item', (e) => {
        const element = $(e.currentTarget).closest('tr');
        const id = $(element).attr('productId');

        // Limpiar errores previos al cargar datos
        $('.form-control').removeClass('is-invalid');
        $('.invalid-feedback').hide();
        
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