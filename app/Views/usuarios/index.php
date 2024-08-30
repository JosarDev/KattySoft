<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Usuarios
<?php $this->endSection(); ?>

<?php $this->section('css'); ?>
<link rel="stylesheet" href="<?= base_url('assets/DataTables/datatables.min.css'); ?>">
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="text-end">
    <a class="btn btn-primary mb-2" href="<?= base_url('usuarios/new'); ?>">Nuevo</a>
</div>


<div class="card">
    <div class="card-body">

        <div class="table-responsive">
            <table class="table table-striped align-middle nowrap" style="width: 100%;" id="tblUsuarios">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Correo</th>
                        <th>Nombre</th>
                        <th>Fecha</th>
                        <th>Rol</th>
                        <th>Foto</th>
                        <th>Accion</th>
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
<script src="<?= base_url('assets/js/pages/usuarios.js'); ?>"></script>
<?php $this->endSection(); ?>