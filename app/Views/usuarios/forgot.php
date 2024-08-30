<?= $this->extend('layout/main'); ?>

<?php $this->section('title'); ?>
Restablecer Contraseña
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
                <div class="col mx-auto">
                    <div class="card my-3">
                        <div class="card-body">
                            <div class="border p-4 rounded">
                                <div class="text-center">
                                    <h3 class="">Olvidaste tu contraseña</h3>
                                </div>
                                <div class="form-body">
                                    <div class="mb-4 text-center">
                                        <img src="<?= base_url('assets/'); ?>images/logo.png" width="180" alt="" />
                                    </div>
                                    <?php if (session()->getFlashdata('respuesta')) { ?>
                                        <div class="alert alert-<?= session()->getFlashdata('respuesta')['type']; ?> alert-dismissible fade show" role="alert">
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                                            <strong>Aviso!</strong> <?= session()->getFlashdata('respuesta')['msg']; ?>
                                        </div>
                                    <?php } ?>
                                    <form class="row g-3" autocomplete="off" action="<?= base_url('forgot'); ?>" method="post">
                                        <div class="col-12">
                                            <label for="correo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico" value="">
                                            <?php if (isset($validator)) { ?>
                                                <span class="text-danger"><?= $validator->getError('correo'); ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12 text-end">
                                            <a type="submit" class="btn btn-danger">Cancelar</a>
                                            <button type="submit" class="btn btn-primary">Restablecer</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--end row-->
        </div>
    </div>
</div>

<?php $this->endSection(); ?>