<?= $this->extend('layout/main'); ?>

<?php $this->section('title'); ?>
Login
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="wrapper">
    <div class="section-authentication-signin d-flex align-items-center justify-content-center my-5 my-lg-0">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-lg-10 mx-auto">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-lg-5 border-end">
                                <div class="card-body">
                                    <form action="<?= base_url('restablecer'); ?>" method="post">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <img src="<?= base_url(); ?>assets/images/logo.png" width="180" alt="">
                                            </div>
                                            <input type="hidden" name="token" value="<?= $usuario['token']; ?>">
                                            <input type="hidden" name="_method" value="PUT">
                                            <h4 class="mt-5 font-weight-bold">Generar Nueva Clave</h4>
                                            <div class="mb-3 mt-5">
                                                <label class="form-label">Nueva Contraseña</label>
                                                <input type="password" class="form-control" name="nueva" placeholder="Nueva Contraseña" />
                                                <?php if (isset($validator)) { ?>
                                                    <span class="text-danger"><?= $validator->getError('nueva'); ?></span>
                                                <?php } ?>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Confirmar Contraseña</label>
                                                <input type="password" class="form-control" name="confirmar" placeholder="Confirmar Contraseña" />
                                                <?php if (isset($validator)) { ?>
                                                    <span class="text-danger"><?= $validator->getError('confirmar'); ?></span>
                                                <?php } ?>
                                            </div>
                                            <div class="d-grid gap-2">
                                                <button type="submit" class="btn btn-primary">Guardar Contraseña</button>
                                                <a href="<?= base_url(); ?>" class="btn btn-light"><i class='bx bx-arrow-back mr-1'></i>Regresar a Login</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-7">
                                <img src="<?= base_url(); ?>assets/images/login-images/forgot-password-frent-img.jpg" class="card-img login-img h-100" alt="...">
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