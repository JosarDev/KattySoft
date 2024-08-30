<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Archivos
<?php $this->endSection(); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/DataTables/datatables.min.css'); ?>">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <h4 class="card-title">Archivos Compartidos</h4>
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
<script src="<?= base_url('assets/js/pages/archivos-compartidos.js'); ?>"></script>
<?php $this->endSection(); ?>