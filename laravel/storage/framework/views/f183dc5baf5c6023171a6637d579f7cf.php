<?php $__env->startSection('title', 'La Buena Mesa - Gestión del Menú & Probador API REST'); ?>

<?php $__env->startSection('content'); ?>

<!-- Seccion de Encabezado Principal (Bebas Neue) -->
<div class="row" style="margin-bottom: 15px;">
    <div class="col s12 center-align">
        <h1 class="font-bebas" style="color: var(--wine-dark); font-size: 3.2rem; margin-bottom: 0;">Gestión del Menú & Probador API REST</h1>
        <p class="font-montserrat" style="font-size: 1.05rem; color: var(--text-muted); font-weight: 500; margin-top: 5px;">
            Plataforma centralizada en tiempo real. Administra los platillos a la izquierda y prueba los endpoints a la derecha.
        </p>
        <div class="luxury-divider" style="margin: 15px 0 25px 0;"></div>
    </div>
</div>

<!-- Layout Principal de 2 Columnas (Izquierda: Catalogo de Menú | Derecha: Probador API REST) -->
<div class="row">

    <!-- COLUMNA IZQUIERDA: Catalogo del Menú (col s12 l7) -->
    <div class="col s12 l7">
        <div class="card card-wine">
            <div class="card-header-wine">
                <h4 class="font-oswald" style="font-size: 1.35rem;"><i class="material-icons left">restaurant_menu</i> Catálogo del Menú</h4>
                <button class="btn btn-wine waves-effect waves-light modal-trigger" data-target="modal-create">
                    <i class="material-icons left">add_circle</i> Nuevo Platillo
                </button>
            </div>

            <div class="card-content" style="padding: 20px;">
                <!-- Filtros de Categoría -->
                <div class="row mb-0" style="margin-bottom: 15px;">
                    <div class="col s12" style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                        <span class="font-oswald" style="font-weight: 700; color: var(--wine-medium); font-size: 0.95rem;">Filtrar:</span>
                        <a href="<?php echo e(url('/menu')); ?>" class="btn-small btn-wine">Todos</a>
                        <button onclick="filterCategory('Entrada')" class="btn-small btn-gold-outline">Entradas</button>
                        <button onclick="filterCategory('Plato Fuerte')" class="btn-small btn-gold-outline">Platos Fuertes</button>
                        <button onclick="filterCategory('Postre')" class="btn-small btn-gold-outline">Postres</button>
                        <button onclick="filterCategory('Bebida')" class="btn-small btn-gold-outline">Bebidas</button>
                    </div>
                </div>

                <!-- Tabla del Menú -->
                <div style="overflow-x: auto;">
                    <table class="striped highlight responsive-table" id="menu-table">
                        <thead>
                            <tr style="border-bottom: 2px solid var(--wine-medium);">
                                <th class="font-oswald" style="font-size: 0.9rem;">ID</th>
                                <th class="font-oswald" style="font-size: 0.9rem;">Platillo</th>
                                <th class="font-oswald" style="font-size: 0.9rem;">Categoría</th>
                                <th class="font-oswald" style="font-size: 0.9rem;">Precio</th>
                                <th class="font-oswald" style="font-size: 0.9rem;">Estado</th>
                                <th class="font-oswald center-align" style="font-size: 0.9rem;">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="font-montserrat">
                            <?php $__empty_1 = true; $__currentLoopData = $menuItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr id="row-<?php echo e($item->id); ?>">
                                    <td class="font-bebas" style="font-size: 1.15rem; color: var(--wine-medium);">#<?php echo e($item->id); ?></td>
                                    <td>
                                        <strong style="color: var(--wine-dark); font-size: 0.95rem; display: block;"><?php echo e($item->name); ?></strong>
                                        <small style="color: var(--text-muted); font-size: 0.82rem; display: block; max-width: 260px;"><?php echo e(Str::limit($item->description, 60)); ?></small>
                                    </td>
                                    <td>
                                        <span class="chip" style="background-color: #f2e9ea; color: var(--wine-dark); font-family: 'Oswald', sans-serif; font-size: 0.78rem; font-weight: 600; height: 26px; line-height: 26px;">
                                            <?php echo e($item->category); ?>

                                        </span>
                                    </td>
                                    <td class="price-tag" style="font-size: 1.1rem;">
                                        $<?php echo e(number_format($item->price, 2)); ?>

                                    </td>
                                    <td>
                                        <?php if($item->is_available): ?>
                                            <span class="badge-disponible" style="font-size: 0.75rem;"><i class="material-icons tiny">check_circle</i> Ok</span>
                                        <?php else: ?>
                                            <span class="badge-no-disponible" style="font-size: 0.75rem;"><i class="material-icons tiny">cancel</i> Agotado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="center-align">
                                        <button class="btn-floating btn-small waves-effect waves-light btn-wine" 
                                                onclick="openEditModal(<?php echo e(json_encode($item)); ?>)" 
                                                title="Editar">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <button class="btn-floating btn-small waves-effect waves-light red darken-3" 
                                                onclick="deleteMenuItem(<?php echo e($item->id); ?>)" 
                                                title="Eliminar">
                                            <i class="material-icons">delete</i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="center-align font-montserrat" style="padding: 30px; font-size: 0.95rem; color: var(--text-muted);">
                                        No hay platillos registrados en el menú. ¡Agrega el primero!
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- COLUMNA DERECHA: Probador Interactivo de Endpoints REST (col s12 l5) -->
    <div class="col s12 l5">
        <div class="card card-wine" style="position: sticky; top: 20px;">
            <div class="card-header-wine" style="background: linear-gradient(135deg, #1b0a0f 0%, #421520 100%);">
                <h4 class="font-oswald" style="font-size: 1.35rem; display: flex; align-items: center; gap: 8px;">
                    <i class="material-icons" style="color: var(--accent-gold);">api</i> Consola de Pruebas API REST
                </h4>
                <span id="http-status-badge" class="chip" style="background-color: #2e7d32; color: #ffffff; font-family: 'Oswald', sans-serif; font-weight: 700; margin: 0; display: none;">
                    HTTP 200 OK
                </span>
            </div>

            <div class="card-content" style="padding: 20px;">
                <p class="font-montserrat" style="margin-top: 0; color: var(--text-muted); font-size: 0.9rem;">
                    Selecciona una petición HTTP para consultar los datos en tiempo real:
                </p>

                <!-- Botones de Endpoints REST -->
                <div style="display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 15px;">
                    <button onclick="testApi('/api/menu-items', 'GET')" class="btn-small btn-wine font-oswald">
                        <i class="material-icons left tiny">dns</i> GET /menu-items
                    </button>
                    <button onclick="testApi('/api/menu-items/1', 'GET')" class="btn-small btn-gold-outline font-oswald">
                        <i class="material-icons left tiny">search</i> GET /items/1
                    </button>
                    <button onclick="testApi('/api/menu-items/category/Entrada', 'GET')" class="btn-small btn-gold-outline font-oswald">
                        <i class="material-icons left tiny">filter_list</i> GET /category/Entrada
                    </button>
                    <button onclick="testApi('/api/menu-items/category/Plato Fuerte', 'GET')" class="btn-small btn-gold-outline font-oswald">
                        <i class="material-icons left tiny">restaurant</i> GET /category/Plato Fuerte
                    </button>
                </div>

                <!-- URL consultada actualmente -->
                <div style="background-color: #f2e9ea; border-left: 3px solid var(--wine-medium); padding: 8px 12px; border-radius: 0 4px 4px 0; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center;">
                    <span id="current-endpoint-url" class="font-montserrat" style="font-weight: 600; color: var(--wine-dark); font-size: 0.85rem;">
                        Endpoint: GET /api/menu-items
                    </span>
                    <button onclick="copyApiResponse()" class="btn-flat btn-small" style="padding: 0 6px;" title="Copiar JSON">
                        <i class="material-icons tiny" style="color: var(--wine-medium);">content_copy</i>
                    </button>
                </div>

                <!-- Visor amplio y cómodo de JSON (Aumentado un 15% de espacio) -->
                <div style="position: relative;">
                    <pre id="api-output" 
                         style="background-color: #171113; color: #f5e6be; padding: 18px; border-radius: 6px; height: 510px; max-height: 530px; overflow-y: auto; font-family: 'Courier New', Courier, monospace; font-size: 0.88rem; line-height: 1.5; border: 1.5px solid #421520; margin: 0; box-shadow: inset 0 2px 8px rgba(0,0,0,0.5);">Haz clic en un botón superior para ejecutar la petición REST API y visualizar aquí el JSON formateado...</pre>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal de Creacion -->
<div id="modal-create" class="modal">
    <div class="modal-content" style="background-color: #ffffff;">
        <h4 class="font-bebas" style="color: var(--wine-dark); border-bottom: 2px solid var(--accent-gold); padding-bottom: 8px; font-size: 2.2rem;">
            <i class="material-icons left">restaurant</i> Agregar Nuevo Platillo
        </h4>
        <form id="create-form" onsubmit="handleCreateSubmit(event)">
            <div class="input-field">
                <input id="create-name" type="text" required class="font-montserrat">
                <label for="create-name" class="font-montserrat">Nombre del Platillo</label>
            </div>
            <div class="input-field">
                <textarea id="create-description" class="materialize-textarea font-montserrat" required></textarea>
                <label for="create-description" class="font-montserrat">Descripción Gastronómica</label>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="create-price" type="number" step="0.01" min="0" required class="font-montserrat">
                    <label for="create-price" class="font-montserrat">Precio ($)</label>
                </div>
                <div class="input-field col s6">
                    <select id="create-category" required>
                        <option value="" disabled selected>Seleccionar Categoría</option>
                        <option value="Entrada">Entrada</option>
                        <option value="Plato Fuerte">Plato Fuerte</option>
                        <option value="Postre">Postre</option>
                        <option value="Bebida">Bebida</option>
                    </select>
                    <label class="font-oswald">Categoría</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <label>
                        <input id="create-available" type="checkbox" class="filled-in" checked="checked" />
                        <span class="font-montserrat" style="color: var(--wine-dark); font-weight: 500;">Disponible para Pedidos</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer" style="background-color: transparent;">
                <a href="#!" class="modal-close btn-flat font-oswald">Cancelar</a>
                <button type="submit" class="btn btn-wine"><i class="material-icons left">save</i> Guardar Platillo</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal de Edicion -->
<div id="modal-edit" class="modal">
    <div class="modal-content" style="background-color: #ffffff;">
        <h4 class="font-bebas" style="color: var(--wine-dark); border-bottom: 2px solid var(--accent-gold); padding-bottom: 8px; font-size: 2.2rem;">
            <i class="material-icons left">edit</i> Editar Platillo
        </h4>
        <form id="edit-form" onsubmit="handleEditSubmit(event)">
            <input type="hidden" id="edit-id">
            <div class="input-field">
                <input id="edit-name" type="text" required class="font-montserrat active">
                <label for="edit-name" class="active font-montserrat">Nombre del Platillo</label>
            </div>
            <div class="input-field">
                <textarea id="edit-description" class="materialize-textarea font-montserrat" required></textarea>
                <label for="edit-description" class="active font-montserrat">Descripción</label>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="edit-price" type="number" step="0.01" min="0" required class="font-montserrat">
                    <label for="edit-price" class="active font-montserrat">Precio ($)</label>
                </div>
                <div class="input-field col s6">
                    <select id="edit-category" required>
                        <option value="Entrada">Entrada</option>
                        <option value="Plato Fuerte">Plato Fuerte</option>
                        <option value="Postre">Postre</option>
                        <option value="Bebida">Bebida</option>
                    </select>
                    <label class="font-oswald">Categoría</label>
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <label>
                        <input id="edit-available" type="checkbox" class="filled-in" />
                        <span class="font-montserrat" style="color: var(--wine-dark); font-weight: 500;">Disponible para Pedidos</span>
                    </label>
                </div>
            </div>
            <div class="modal-footer" style="background-color: transparent;">
                <a href="#!" class="modal-close btn-flat font-oswald">Cancelar</a>
                <button type="submit" class="btn btn-wine"><i class="material-icons left">check</i> Actualizar</button>
            </div>
        </form>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        M.Modal.init(document.querySelectorAll('.modal'));
        M.FormSelect.init(document.querySelectorAll('select'));
        
        // Auto-ejecutar primera consulta al cargar
        testApi('/api/menu-items', 'GET');
    });

    async function testApi(url, method = 'GET') {
        const output = document.getElementById('api-output');
        const badge = document.getElementById('http-status-badge');
        const urlDisplay = document.getElementById('current-endpoint-url');
        
        output.innerText = '// Ejecutando petición HTTP...';
        urlDisplay.innerText = `Endpoint: ${method} ${url}`;
        badge.style.display = 'none';

        try {
            const startTime = performance.now();
            const res = await fetch(url, {
                headers: {
                    'Accept': 'application/json'
                }
            });
            const endTime = performance.now();
            const duration = Math.round(endTime - startTime);
            const data = await res.json();

            badge.innerText = `HTTP ${res.status} OK (${duration}ms)`;
            badge.style.backgroundColor = res.ok ? '#2e7d32' : '#c62828';
            badge.style.display = 'inline-flex';

            output.innerText = JSON.stringify(data, null, 2);
        } catch (err) {
            badge.innerText = 'HTTP ERROR';
            badge.style.backgroundColor = '#c62828';
            badge.style.display = 'inline-flex';
            output.innerText = '// Error de conexión al consultar la API REST:\n' + err.message;
        }
    }

    function copyApiResponse() {
        const text = document.getElementById('api-output').innerText;
        navigator.clipboard.writeText(text).then(() => {
            M.toast({html: '¡Respuesta JSON copiada al portapapeles!', classes: 'btn-wine'});
        });
    }

    async function filterCategory(category) {
        try {
            const url = `/api/menu-items/category/${encodeURIComponent(category)}`;
            const res = await fetch(url, { headers: { 'Accept': 'application/json' } });
            const json = await res.json();
            renderTableRows(json.data);
            
            // Actualizar consola API derecha simultáneamente
            testApi(url, 'GET');
            M.toast({html: `Filtrado por: ${category}`, classes: 'btn-wine'});
        } catch (err) {
            M.toast({html: 'Error al filtrar elementos', classes: 'red darken-2'});
        }
    }

    function renderTableRows(items) {
        const tbody = document.querySelector('#menu-table tbody');
        if (!items || items.length === 0) {
            tbody.innerHTML = `<tr><td colspan="6" class="center-align font-montserrat" style="padding: 20px; color: var(--text-muted);">No se encontraron platillos en esta categoría.</td></tr>`;
            return;
        }

        tbody.innerHTML = items.map(item => `
            <tr id="row-${item.id}">
                <td class="font-bebas" style="font-size: 1.15rem; color: var(--wine-medium);">#${item.id}</td>
                <td>
                    <strong style="color: var(--wine-dark); font-size: 0.95rem; display: block;">${item.nombre}</strong>
                    <small style="color: var(--text-muted); font-size: 0.82rem; display: block; max-width: 260px;">${item.descripcion.length > 60 ? item.descripcion.substring(0,60)+'...' : item.descripcion}</small>
                </td>
                <td>
                    <span class="chip" style="background-color: #f2e9ea; color: var(--wine-dark); font-family: 'Oswald', sans-serif; font-size: 0.78rem; font-weight: 600; height: 26px; line-height: 26px;">
                        ${item.categoria}
                    </span>
                </td>
                <td class="price-tag" style="font-size: 1.1rem;">$${parseFloat(item.precio).toFixed(2)}</td>
                <td>
                    ${item.disponible 
                        ? '<span class="badge-disponible" style="font-size: 0.75rem;"><i class="material-icons tiny">check_circle</i> Ok</span>' 
                        : '<span class="badge-no-disponible" style="font-size: 0.75rem;"><i class="material-icons tiny">cancel</i> Agotado</span>'}
                </td>
                <td class="center-align">
                    <button class="btn-floating btn-small waves-effect waves-light btn-wine" onclick='openEditModal(${JSON.stringify({
                        id: item.id,
                        name: item.nombre,
                        description: item.descripcion,
                        price: item.precio,
                        category: item.categoria,
                        is_available: item.disponible
                    })})' title="Editar"><i class="material-icons">edit</i></button>
                    <button class="btn-floating btn-small waves-effect waves-light red darken-3" onclick="deleteMenuItem(${item.id})" title="Eliminar"><i class="material-icons">delete</i></button>
                </td>
            </tr>
        `).join('');
    }

    async function handleCreateSubmit(e) {
        e.preventDefault();
        const payload = {
            name: document.getElementById('create-name').value,
            description: document.getElementById('create-description').value,
            price: parseFloat(document.getElementById('create-price').value),
            category: document.getElementById('create-category').value,
            is_available: document.getElementById('create-available').checked
        };

        try {
            const res = await fetch('/api/menu-items', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (res.ok) {
                M.toast({html: '¡Platillo agregado exitosamente!', classes: 'btn-wine'});
                M.Modal.getInstance(document.getElementById('modal-create')).close();
                testApi('/api/menu-items', 'GET');
                setTimeout(() => window.location.reload(), 900);
            } else {
                const err = await res.json();
                M.toast({html: 'Error: ' + (err.message || 'Datos inválidos'), classes: 'red darken-2'});
            }
        } catch (error) {
            M.toast({html: 'Error al procesar la solicitud', classes: 'red darken-2'});
        }
    }

    function openEditModal(item) {
        document.getElementById('edit-id').value = item.id;
        document.getElementById('edit-name').value = item.name;
        document.getElementById('edit-description').value = item.description;
        document.getElementById('edit-price').value = item.price;
        document.getElementById('edit-category').value = item.category;
        document.getElementById('edit-available').checked = Boolean(item.is_available);

        M.updateTextFields();
        M.FormSelect.init(document.querySelectorAll('select'));
        M.Modal.getInstance(document.getElementById('modal-edit')).open();
    }

    async function handleEditSubmit(e) {
        e.preventDefault();
        const id = document.getElementById('edit-id').value;
        const payload = {
            name: document.getElementById('edit-name').value,
            description: document.getElementById('edit-description').value,
            price: parseFloat(document.getElementById('edit-price').value),
            category: document.getElementById('edit-category').value,
            is_available: document.getElementById('edit-available').checked
        };

        try {
            const res = await fetch(`/api/menu-items/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(payload)
            });

            if (res.ok) {
                M.toast({html: 'Platillo actualizado correctamente', classes: 'btn-wine'});
                M.Modal.getInstance(document.getElementById('modal-edit')).close();
                testApi(`/api/menu-items/${id}`, 'GET');
                setTimeout(() => window.location.reload(), 900);
            } else {
                const err = await res.json();
                M.toast({html: 'Error al actualizar: ' + (err.message || 'Verifique los campos'), classes: 'red darken-2'});
            }
        } catch (error) {
            M.toast({html: 'Error de red al actualizar', classes: 'red darken-2'});
        }
    }

    async function deleteMenuItem(id) {
        if (!confirm(`¿Está seguro de eliminar el platillo #${id}?`)) return;

        try {
            const res = await fetch(`/api/menu-items/${id}`, {
                method: 'DELETE',
                headers: { 'Accept': 'application/json' }
            });

            if (res.ok) {
                M.toast({html: `Platillo #${id} eliminado`, classes: 'btn-wine'});
                const row = document.getElementById(`row-${id}`);
                if (row) row.remove();
                testApi('/api/menu-items', 'GET');
            } else {
                M.toast({html: 'No se pudo eliminar el elemento', classes: 'red darken-2'});
            }
        } catch (error) {
            M.toast({html: 'Error de conexión', classes: 'red darken-2'});
        }
    }
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/resources/views/menu/index.blade.php ENDPATH**/ ?>