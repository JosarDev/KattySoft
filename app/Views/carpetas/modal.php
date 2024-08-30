<div class="modal fade" id="modalCarpeta" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">
                    Modal title
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post" id="frmCarpeta" autocomplete="off">
                <div class="modal-body">
                    <input type="hidden" id="id_carpeta" name="id_carpeta">
                    <input type="hidden" id="id_subcarpeta" name="id_subcarpeta">
                    <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancelar
                    </button>
                    <button type="submit" class="btn btn-primary" id="btnGuardar">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalAccion" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleAccion">
                    Acciones
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                <div class="list-group">
                    <a href="#" id="btnNuevaCarpeta" class="list-group-item list-group-item-action flex-column align-items-start" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><i class="fas fa-folder"></i> Nueva Carpeta</h5>
                        </div>
                    </a>
                    <a href="#" id="btnCompartir" class="list-group-item list-group-item-action flex-column align-items-start" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><i class="fas fa-share"></i> Compartir</h5>
                        </div>
                    </a>
                    <a href="#" id="btnEditar" class="list-group-item list-group-item-action flex-column align-items-start" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><i class="fas fa-edit"></i> Editar</h5>
                        </div>
                    </a>
                    <a href="#" id="btnEliminar" class="list-group-item list-group-item-action flex-column align-items-start" aria-current="true">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1"><i class="fas fa-trash"></i> Eliminar</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>