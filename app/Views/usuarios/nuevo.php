<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Nuevo Usuario
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="card">
    <div class="card-body">
        <h6 class="card-title">Nuevo Usuario</h6>
        <hr>
        <form action="<?= base_url('usuarios'); ?>" method="post" autocomplete="off">
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="usuario" class="form-label"><i class="fas fa-user"></i> Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control" value="<?= set_value('usuario'); ?>" placeholder="Usuario" />
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('usuario'); ?></span>
                    <?php } ?>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="correo" class="form-label"><i class="fas fa-envelope"></i> Correo</label>
                    <input type="email" name="correo" id="correo" class="form-control" value="<?= set_value('correo'); ?>" placeholder="Correo Electrónico" />
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('correo'); ?></span>
                    <?php } ?>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="nombre" class="form-label"><i class="fas fa-list"></i> Nombre</label>
                    <input type="text" name="nombre" id="nombre" class="form-control" value="<?= set_value('nombre'); ?>" placeholder="Nombre" />
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('nombre'); ?></span>
                    <?php } ?>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="apellido" class="form-label"><i class="fas fa-list-alt"></i> Apellido</label>
                    <input type="text" name="apellido" id="apellido" class="form-control" value="<?= set_value('apellido'); ?>" placeholder="Apellido" />
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('apellido'); ?></span>
                    <?php } ?>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="rol" class="form-label">Rol</label>
                    <select class="form-select" name="rol" id="rol">
                        <option value="1">Admin</option>
                        <option value="2" selected>Invitado</option>
                        <option value="3">Servicios</option>
                    </select>
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('rol'); ?></span>
                    <?php } ?>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="clave" class="form-label"><i class="fas fa-key"></i> Contraseña</label>
                    <input type="password" name="clave" id="clave" class="form-control" value="<?= set_value('clave'); ?>" placeholder="Contraseña" />
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('clave'); ?></span>
                    <?php } ?>
                </div>

                <div class="mb-3 col-md-4">
                    <label for="confirmar" class="form-label"><i class="fas fa-lock"></i> Confirmar Contraseña</label>
                    <input type="password" name="confirmar" id="confirmar" class="form-control" value="<?= set_value('confirmar'); ?>" placeholder="Confirmar Contraseña" />
                    <?php if (isset($validator)) { ?>
                        <span class="text-danger"><?= $validator->getError('confirmar'); ?></span>
                    <?php } ?>
                </div>

                <div class="col-md-12 text-end">
                    <div class="btn-group ms-3" role="group" aria-label="">
                        <a href="<?= base_url('usuarios'); ?>" class="btn btn-danger">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Guardar
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<?php $this->endSection(); ?>