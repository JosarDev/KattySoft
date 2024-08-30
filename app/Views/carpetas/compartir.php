<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Compartir Carpeta
<?php $this->endSection(); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/DataTables/datatables.min.css'); ?>">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="mb-3 text-end">
    <button type="button" id="btnGuardar" class="btn btn-primary">
        Guardar
    </button>
</div>


<div class="card">
    <div class="card-body">
        <h4 class="card-title"><i class="fas fa-folder text-info"></i> <?= $carpeta['nombre']; ?></h4>
        <hr>
        <input type="hidden" id="carpeta_id" value="<?= $carpeta['carpeta_id']; ?>">
    </div>
</div>


<div class="card">
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped align-middle nowrap" style="width: 100%;" id="tblUsuarios">
                <thead>
                    <tr>
                        <th>Accion</th>
                        <th>Item</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Foto</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>

    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="<?= base_url('assets/DataTables/datatables.min.js'); ?>"></script>
<script src="<?= base_url('assets/js/pages/compartir-carpeta.js'); ?>"></script>
<?php $this->endSection(); ?>