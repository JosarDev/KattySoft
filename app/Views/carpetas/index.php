<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Carpetas
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="text-end">
    <?php if ($regresar) { ?>
        <a class="btn btn-danger mb-2" href="<?= base_url('carpetas'); ?>">Regresar</a>
    <?php }
    if ($nuevo) { ?>
        <a class="btn btn-primary mb-2" href="#" id="btnNuevo">Nuevo</a>
    <?php } ?>
</div>

<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center flex-wrap">
            <h5>Carpetas Principales</h5>
            <!-- Descomentar para Busqueda -->
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
                                    <div class="user-groups ms-auto">
                                        <!-- <img src="<?= base_url('assets/images/avatar/') ?>" width="35" height="35" class="rounded-circle" alt=""> -->
                                    </div>
                                    <div class="user-plus" onclick="accionCarpeta(<?= $carpeta['carpeta_id']; ?>)">+</div>
                                </div>
                                <h6 class="mb-0 text-primary">
                                    <a href="<?= base_url('carpetas/' . $carpeta['carpeta_id']); ?>"><?= $carpeta['nombre']; ?></a>
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
 
<?php echo $this->include('carpetas/modal.php');

$this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="<?= base_url('assets/js/pages/carpetas.js'); ?>"></script>
<?php $this->endSection(); ?>