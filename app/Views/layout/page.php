<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <?=$this->renderSection('meta')?>

    <!-- Favicons -->
    <link href="assets/img/favicon.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?php echo base_url(); ?>/admin/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/admin/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>/admin/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>/admin/assets/vendor/jquery/jquery-3.6.0.min.js"></script>
    <script src="<?php echo base_url(); ?>/admin/assets/vendor/bootstrap/js/bootstrap.min.js" ></script>

    <!-- Template Main CSS File -->
    <link href="<?php echo base_url(); ?>/admin/assets/css/style.css" rel="stylesheet">

    <?= $this->renderSection('css') ?>

</head>

<body>

<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
        <a href="/" class="logo d-flex align-items-center">
            <img src="<?php echo base_url(); ?>/admin/assets/img/logo.png" alt="">
            <span class="d-none d-lg-block">Litsovet</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->



    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">

            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                    <i class="bi bi-search"></i>
                </a>
            </li>

        </ul>
    </nav><!-- End Icons Navigation -->

</header>
<!-- End Header -->

<?= $this->renderSection('sidebar') ?>

<?= $this->renderSection('content') ?>

<!-- ======= Footer ======= -->
<?= $this->renderSection('footer') ?>
<!-- ======= End Footer ======= -->

<!-- default script -->
<script src="<?= base_url(); ?>/admin/assets/js/main.js"></script>
<!-- default script End -->

<?= $this->renderSection('script') ?>

</body>

</html>
