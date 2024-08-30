<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Perfil del usuario
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column align-items-center text-center">
                    <?php $perfil = ($_SESSION['avatar'] != null) ? 'assets/images/avatars/' . $_SESSION['avatar'] : 'assets/images/avatars/default.png'; ?>
                    <img src="<?= base_url($perfil); ?>" alt="Admin" id="preview" class="rounded-circle p-1 bg-primary" width="110">
                    <div class="mt-3">
                        <h4><?= $usuario['nombre']; ?></h4>
                        <p class="text-secondary mb-1"><?= $usuario['usuario']; ?></p>
                        <hr>
                        <p class="text-muted font-size-sm"><?= $usuario['correo']; ?></p>
                    </div>
                </div>
            </div>
        </div>
        <form action="<?= base_url('updatePassword'); ?>" method="post">
            <input type="hidden" name="_method" value="PUT">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-12 mb-2 text-secondary">
                            <h6 class="mb-1">Contraseña Actual</h6>
                            <input type="password" class="form-control" name="actual" value="" placeholder="Contraseña Actual" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('actual'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 text-secondary">
                            <h6 class="mb-1">Nueva Contraseña</h6>
                            <input type="password" class="form-control" name="nueva" value="" placeholder="Nueva Contraseña" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('nueva'); ?></span>
                            <?php } ?>
                        </div>
                        <div class="col-sm-12 mb-2 text-secondary">
                            <h6 class="mb-1">Confirmar Contraseña</h6>
                            <input type="password" class="form-control" name="confirmar" value="" placeholder="Confirmar Contraseña" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('confirmar'); ?></span>
                            <?php } ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Guardar" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-8">
        <form action="<?= base_url('perfil'); ?>" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="PUT">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Nombre</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="nombre" value="<?= set_value('nombre', $usuario['nombre']); ?>" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('nombre'); ?></span>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Apellido</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="apellido" value="<?= set_value('apellido', $usuario['apellido']); ?>" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('apellido'); ?></span>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Correo</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="correo" value="<?= set_value('correo', $usuario['correo']); ?>" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('correo'); ?></span>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Usuario</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="text" class="form-control" name="usuario" value="<?= set_value('usuario', $usuario['usuario']); ?>" />
                            <?php if (isset($validator)) { ?>
                                <span class="text-danger"><?= $validator->getError('usuario'); ?></span>
                            <?php } ?>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Foto</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <input type="file" class="form-control" id="avatar" name="avatar" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"></div>
                        <div class="col-sm-9 text-secondary">
                            <input type="submit" class="btn btn-primary px-4" value="Guardar Cambios" />
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script>
    const avatar = document.querySelector('#avatar');
    const preview = document.querySelector('#preview');
    avatar.addEventListener('change', function(e){
        const imagen = e.target.files[0];
        if (imagen.type == 'image/png' || imagen.type == 'image/jpg' || imagen.type == 'image/jpeg') {
            const tmpUrl = URL.createObjectURL(imagen);
            preview.src = tmpUrl;
        }else{
            avatar.value = '';
            alertaPesonalizada('warning', 'SELECIONA UNA IMAGEN - (Png, Jpg, Jpeg)');
        }
    })
</script>
<?php $this->endSection(); ?>