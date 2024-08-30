<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Archivos
<?php $this->endSection(); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/DataTables/datatables.min.css'); ?>">
<link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<!-- Descomentar o Comentar para la funcion de subir archivos en carpetas compartidas-->
<!-- <div class="card">
    <div class="card-body">
        <h4 class="card-title">Subir Archivos</h4>
        <hr>
        <form action="<?= base_url('archivos/upload'); ?>" id="upload-form" class="dropzone">
            <input type="hidden" value="<?= $carpeta['carpeta_id']; ?>" id="carpeta_id" name="carpeta_id">
        </form>
    </div>
</div> -->

<div class="card">
    <div class="card-body">
        <input type="hidden" value="<?= $carpeta['carpeta_id']; ?>" id="carpeta_id">
        <h4 class="card-title">Archivos</h4>
        <hr>
        <div class="table-responsive">
            <table class="table table-primary nowrap" style="width: 100%;" id="tblArchivos">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Nombre</th>
                        <th>Tipo</th>
                        <th>Fecha</th>
                        <th></th>
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
<script src="<?= base_url('assets/js/pages/carpetas-compartidos.js'); ?>"></script>
<script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
<script src="<?= base_url('assets/js/pages/subirarchivo.js'); ?>"></script>

<?php $this->endSection(); ?>