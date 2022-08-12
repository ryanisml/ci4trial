<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Tables - SB Admin</title>
        <link href="<?= base_url() ?>/public/asset/css/styles.css" rel="stylesheet" />
        <script src="<?= base_url() ?>/public/asset/js/all.min.js"></script>
        <link rel="stylesheet" href="<?= base_url() ?>/public/asset/bootstrap/bootstrap.min.css">
        <?php
            if (!empty($cssfile)) {
                foreach ($cssfile as $row) {
                    echo '<link rel ="stylesheet" type="text/css" href="' . $row . '">';
                }
            }
        ?>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="#">M Y&nbsp;&nbsp;DASHBOARD</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <label class="text-white" id="txt"></label>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <a class="dropdown-item" id="btnKeluar" href="<?= base_url('home/logout') ?>">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <?= $this->include('layout/sidebar') ?>
            <div id="layoutSidenav_content">
                <main>
                    <?= $this->renderSection('content'); ?>
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Developed with <i class="fas fa-coffee"></i> by Ryan Ismail 2021</div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="<?= base_url() ?>/public/asset/js/jquery-3.6.0.min.js"></script>
        <script src="<?= base_url() ?>/public/asset/js/popper.min.js"></script>
        <script src="<?= base_url() ?>/public/asset/bootstrap/bootstrap.min.js"></script>
        <script src="<?= base_url() ?>/public/asset/swal/sweetalert2.all.min.js"></script>
        <script src="<?= base_url() ?>/public/asset/js/scripts.js"></script>
        <?php
            if (!empty($jsfile)) {
                foreach ($jsfile as $row) {
                    echo '<script src="'.$row.'"></script>';
                }
            }
        ?>
    </body>
</html>
