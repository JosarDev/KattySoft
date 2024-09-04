<!doctype html>
<html lang="en" class="semi-dark">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url('assets/'); ?>images/logo.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url('assets/'); ?>plugins/notifications/css/lobibox.min.css" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url('assets/'); ?>css/pace.min.css" rel="stylesheet" />
    <script src="<?= base_url('assets/'); ?>js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/bootstrap-extended.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/fontGoogleApi.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/app.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/icons.css" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/dark-theme.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/semi-dark.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/header-colors.css" />
    <link rel="stylesheet" href="<?= base_url('assets/'); ?>css/custom.css" />
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
    <!-- Estilos personalizados -->
    <?= $this->renderSection('css'); ?>

    <title>KattySoft | <?= $this->renderSection('title'); ?></title>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">
        <!--sidebar wrapper -->
        <div class="sidebar-wrapper" data-simplebar="true">
            <div class="sidebar-header">
                <div>
                    <img src="<?= base_url('assets/'); ?>images/logo.png" class="logo-icon" alt="logo icon">
                </div>
                <div>
                    <h4 class="logo-text">KattySoft</h4>
                </div>
                <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
                </div>
            </div>
            <!--navigation para los usuarios dependiendo de su rol-->
            <?php
            if ($_SESSION['rol'] == 1) {
                echo $this->include('layout/menu-admin.php');
            } elseif ($_SESSION['rol'] == 2) {
                echo $this->include('layout/menu-invitado.php');
            } elseif ($_SESSION['rol'] == 3) {
                echo $this->include('layout/menu-servicios.php');
            
            }
            ?>
            <!--end navigation-->

        </div>
        <!--end sidebar wrapper -->
        <!--start header -->
        <header>
            <div class="topbar d-flex align-items-center">
                <nav class="navbar navbar-expand">
                    <div class="mobile-toggle-menu"><i class='bx bx-menu'></i>
                    </div>
                    <div class="search-bar flex-grow-1">
                        <div class="position-relative search-bar-box">
                            Gestor de Documentos
                        </div>
                    </div>
                    <div class="top-menu ms-auto">
                        <ul class="navbar-nav align-items-center">
                            <li class="nav-item mobile-search-icon">
                                <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="user-box dropdown">
                        <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php $perfil = ($_SESSION['avatar'] != null) ? 'assets/images/avatars/' . $_SESSION['avatar'] : 'assets/images/avatars/default.png'; ?>
                            <img src="<?= base_url($perfil); ?>" class="user-img" alt="user avatar">
                            <div class="user-info ps-3 text-center">
                                <p class="user-name mb-0"><?= $_SESSION['nombre']; ?></p>
                                <p class="designation mb-0">
                                    <?php
                                    if ($_SESSION['rol'] == 1) {
                                        echo '<span class="badge bg-success">Admin</span>';
                                    } elseif ($_SESSION['rol'] == 2) {
                                        echo '<span class="badge bg-primary">Invitado</span>';
                                    } elseif ($_SESSION['rol'] == 3) {
                                        echo '<span class="badge bg-warning">Servicios</span>';
                                    }
                                    ?>
                                </p>
                            </div>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="<?= base_url('perfil'); ?>"><i class="bx bx-user"></i><span>Perfil</span></a>
                            </li>
                            <li>
                                <div class="dropdown-divider mb-0"></div>
                            </li>
                            <li><a class="dropdown-item" href="<?= base_url('logout'); ?>"><i class='bx bx-log-out-circle'></i><span>Salir</span></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <!--end header -->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">

                <span></span>

                <?php if (session()->getFlashdata('respuesta')) { ?>
                    <div class="alert alert-<?= session()->getFlashdata('respuesta')['type']; ?> alert-dismissible fade show" role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                        <strong>Aviso!</strong> <?= session()->getFlashdata('respuesta')['msg']; ?>
                    </div>
                <?php } ?>

                <?= $this->renderSection('content'); ?>

            </div>
        </div>
        <!--end page wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button--> <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->
        <footer class="page-footer">
            <p class="mb-0">Copyright © <?= date('Y'); ?>. All right reserved.</p>
        </footer>
    </div>
    <!--end wrapper-->
    <!--start switcher-->
    <?= $this->include('layout/paint.php'); ?>
    <!--end switcher-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/all.min.js"></script>
    <script src="<?= base_url('assets/'); ?>js/botones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>
    <!--app JS-->

    <script src="<?= base_url('assets/'); ?>js/app.js"></script>

    <script>
        const base_url = '<?= base_url(); ?>';
    </script>

    <script src="<?= base_url('assets/'); ?>js/custom.js"></script>

    <?= $this->renderSection('js'); ?>

</body>

</html>