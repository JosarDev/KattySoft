<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="<?= base_url('assets/'); ?>images/logo.png" type="image/png" />
    <!--plugins-->
    <link href="<?= base_url('assets/'); ?>plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="<?= base_url('assets/'); ?>plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="<?= base_url('assets/'); ?>css/pace.min.css" rel="stylesheet" />
    <script src="<?= base_url('assets/'); ?>js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="<?= base_url('assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/app.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/icons.css" rel="stylesheet">
    <?= $this->renderSection('css'); ?>

    <title>KattySoft | <?= $this->renderSection('title'); ?></title>
</head>

<body class="bg-login">
    <!--wrapper-->
    <?= $this->renderSection('content'); ?>
    <!--end wrapper-->
    <!-- Bootstrap JS -->
    <script src="<?= base_url('assets/'); ?>js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="<?= base_url('assets/'); ?>js/jquery.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/simplebar/js/simplebar.min.js"></script>
    <script src="<?= base_url('assets/'); ?>plugins/metismenu/js/metisMenu.min.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="<?= base_url('assets/'); ?>js/app.js"></script>

    <?= $this->renderSection('js'); ?>
    
</body>

</html>