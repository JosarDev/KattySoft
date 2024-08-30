<?= $this->extend('layout/main'); ?>

<?php $this->section('title'); ?>
Login
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
                                    <h3 class="">Login</h3>
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
                                    <form class="row g-3" autocomplete="off" action="<?= base_url('login'); ?>" method="post">
                                        <div class="col-12">
                                            <label for="correo" class="form-label">Correo Electrónico</label>
                                            <input type="email" class="form-control" id="correo" name="correo" placeholder="Correo Electrónico">
                                            <?php if (isset($validator)) { ?>
                                                <span class="text-danger"><?= $validator->getError('correo'); ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="col-12">
                                            <label for="clave" class="form-label">Contraseña</label>
                                            <div class="input-group" id="show_hide_password">
                                                <input type="password" class="form-control border-end-0" name="clave" id="clave" placeholder="Contraseña">
                                                <a href="javascript:;" class="input-group-text bg-transparent"><i class='bx bx-hide'></i></a>
                                            </div>
                                            <?php if (isset($validator)) { ?>
                                                <span class="text-danger"><?= $validator->getError('clave'); ?></span>
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-12 text-end"> <a href="<?= base_url('forgot'); ?>">Olvidaste tu Contraseña?</a>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-grid">
                                                <button type="submit" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Acceder</button>
                                            </div>
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