<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Admin
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="row row-cols-1 row-cols-md-1 row-cols-lg-1 row-cols-xl-1">
    <div class="col">
        <div class="card">
            <div class="row g-0">
                <div class="col-md-12">
                    <div class="card-body text-center">
                        <h5 class="card-title">Bienvenido</h5>
                        <p class="card-text"><?= $_SESSION['nombre']; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>