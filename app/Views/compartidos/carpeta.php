<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Carpetas Compartidas
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h5>Carpetas Compartidas</h5>
            <div class="position-relative">
                <input type="text" class="form-control search-control" id="busqueda" placeholder="Buscar..."> <span class="position-absolute top-50 search-show translate-middle-y"><i class='bx bx-search'></i></span>
                <span class="position-absolute top-50 search-close translate-middle-y"><i class='bx bx-x'></i></span>
            </div>
        </div>
        <div class="text-end">
            <span class="text-danger" id="msgRespuesta"></span>
        </div>
        <hr>
        <div class="row mt-3">
            <?php if (count($carpetas) > 0) {
                foreach ($carpetas as $carpeta) { ?>
                    <div class="col-12 col-lg-4">
                        <div class="card shadow-none border radius-15">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="font-30 text-primary"><i class='bx bxs-folder'></i>
                                    </div>
                                </div>
                                <h6 class="mb-0 text-primary">
                                    <a href="<?= base_url('carpcompartidas/' . $carpeta['carpeta_id'] . '/detalle'); ?>"><?= $carpeta['nombre']; ?></a>
                                </h6>
                                <small><?= ($carpeta['total'] > 1) ? $carpeta['total'] . ' Archivos' : $carpeta['total'] . ' Archivo'; ?></small>
                            </div>
                        </div>
                    </div>
                <?php }
            } else { ?>

                <div class="alert alert-danger" role="alert">
                    <strong>Aviso</strong> No hay Documentos
                </div>

            <?php } ?>
        </div>
        <?= $pager->links() ?>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script>
    const msgRespuesta = document.querySelector('#msgRespuesta');
    const busqueda = document.querySelector('#busqueda');
    document.addEventListener('DOMContentLoaded', function() {
        //BUSQUEDA
        $("#busqueda").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: base_url + 'folder/busqueda',
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                        if (data.length > 0) {
                            msgRespuesta.textContent = '';
                        } else {
                            msgRespuesta.textContent = 'No hay resultado';
                        }
                    }
                });
            },
            minLength: 2,
            select: function(event, ui) {
                let ruta;
                if (ui.item.tipo === 'archivo') {
                    ruta = base_url + 'assets/uploads/' + ui.item.value;
                    window.open(ruta);
                } else {
                    ruta = base_url + 'carpcompartidas/' + ui.item.id + '/detalle';
                    window.location = ruta;
                }
                busqueda.value = '';
                return false;
            }
        });
    })
</script>
<?php $this->endSection(); ?>