<?= $this->extend('layout/app'); ?>

<?php $this->section('title'); ?>
Admin
<?php $this->endSection(); ?>

<?php $this->section('content'); ?>

<div class="row row-cols-1 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4">
    <div class="col">
        <div class="card radius-10 bg-gradient-cosmic">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Usuarios</p>
                        <h4 class="my-1 text-white"><?= $usuarios; ?></h4>
                    </div>
                    <div id="chart1"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-ibiza">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Carpetas</p>
                        <h4 class="my-1 text-white"><?= $carpetas; ?></h4>
                    </div>
                    <div id="chart2"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-auto">
                        <p class="mb-0 text-white">Total Archivos</p>
                        <h4 class="my-1 text-white"><?= $archivos; ?></h4>
                    </div>
                    <div id="chart3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12 col-lg-12">
        <div class="card radius-10">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Registro de Usuarios</h6>
                    </div>
                </div>
                <div class="d-flex align-items-center ms-auto font-13 gap-2 my-3">
                    <span class="border px-1 rounded cursor-pointer"><i class="bx bxs-circle me-1 text-info"></i>Usuarios</span>
                </div>
                <div class="chart-container-1">
                    <canvas id="chart5"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row row-cols-1 row-cols-lg-3">
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Nuevos Usuarios</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="chart16"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Carpetas Recientes</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="chart17"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col d-flex">
        <div class="card radius-10 w-100">
            <div class="card-header bg-transparent">
                <div class="d-flex align-items-center">
                    <div>
                        <h6 class="mb-0">Archivos Recientes</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="chart-container-1">
                    <canvas id="chart18"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->endSection(); ?>

<?php $this->section('js'); ?>
<script src="<?= base_url('assets/'); ?>plugins/chartjs/js/Chart.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/chartjs/js/Chart.extension.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/sparkline-charts/jquery.sparkline.min.js"></script>
<script src="<?= base_url('assets/'); ?>js/index3.js"></script>
<?php $this->endSection(); ?>