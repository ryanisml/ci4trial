<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?= base_url() ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">DATA</div>
                <a class="nav-link" href="<?= base_url('user') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    User
                </a>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="false" aria-controls="collapsePages1">
                    <div class="sb-nav-link-icon"><i class="fas fa-award"></i></div>
                    Barang
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages2" aria-labelledby="headingTthree" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('barang') ?>">Lihat Data</a>
                        <a class="nav-link" href="<?= base_url('barang/tambah') ?>">Tambah Data</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1" aria-expanded="false" aria-controls="collapsePages1">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Penjualan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages1" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('penjualan') ?>">Lihat Data</a>
                        <a class="nav-link" href="<?= base_url('penjualan/tambah') ?>">Tambah Data</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pembelian
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= base_url('pembelian') ?>">Lihat Data</a>
                        <a class="nav-link" href="<?= base_url('pembelian/tambah') ?>">Tambah Data</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Others</div>
                <a class="nav-link" href="<?= base_url('others/satuan') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Satuan
                </a>
                <a class="nav-link" href="<?= base_url('others/kategori') ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Kategori
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?= session()->get('username') ?>
        </div>
    </nav>
</div>