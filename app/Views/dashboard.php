<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4">
    <h1 class="mt-4"><?= $pagename ?></h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="#"><?= $pagename ?></a></li>
        <li class="breadcrumb-item active"><?= $subtitle ?></li>
    </ol>
    <?php $pesan = session()->getFlashdata('pesan'); if (isset($pesan)): ?>
        <div class="alert alert-<?= $pesan["class"] ?> alert-dismissible fade show" role="alert">
            <strong><?= $pesan["title"] ?></strong> <?= $pesan["message"] ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    <?php endif; ?>
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-table me-1"></i>
            STOK DATA BARANG UPDATE <?= date('H:i, d-m-Y') ?>
        </div>
        <div class="card-body">
            <div id="chartData" width="100%" style="height: 600px;"></div>
            <div id="data404" class="text-center"><h5>- Tidak ditemukan data penjualan -</h5></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Data Penjualan Barang
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kategori : </label>
                        <select class="form-control" name="kategori_penjualan" id="kategori_penjualan">
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="form-group" id="bulanjualan">
                        <label>Pilih Bulan : </label>
                        <select class="form-control" name="bulan_penjualan" id="bulan_penjualan">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group" id="tahunjualan">
                        <label>Pilih Tahun : </label>
                        <select class="form-control" name="tahun_penjualan" id="tahun_penjualan">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="cari_penjualan" class="btn btn-warning float-right">Cari</button>
                    </div>
                    <div id="clearfix"></div>
                    <br/>
                    <br/>
                    <div id="chartPenjualan" width="100%" style="height: 400px;"></div>
                    <div id="penjualan404" class="text-center"><h5>- Tidak ditemukan data penjualan -</h5></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-bar me-1"></i>
                    Data Pembelian Barang
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kategori : </label>
                        <select class="form-control" name="kategori_pembelian" id="kategori_pembelian">
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="form-group" id="bulanbeli">
                        <label>Pilih Bulan : </label>
                        <select class="form-control" name="bulan_pembelian" id="bulan_pembelian">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group" id="tahunbeli">
                        <label>Pilih Tahun : </label>
                        <select class="form-control" name="tahun_pembelian" id="tahun_pembelian">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="cari_pembelian" class="btn btn-warning float-right">Cari</button>
                    </div>
                    <div id="clearfix"></div>
                    <br/>
                    <br/>
                    <div id="chartPembelian" width="100%" style="height: 400px;"></div>
                    <div id="pembelian404" class="text-center"><h5>- Tidak ditemukan data penjualan -</h5></div>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
    <br/>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Penjualan Terbanyak
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kategori : </label>
                        <select class="form-control" name="kategori_penjualan_terbanyak" id="kategori_penjualan_terbanyak">
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="form-group" id="bulanjualbanyak">
                        <label>Pilih Bulan : </label>
                        <select class="form-control" name="bulan_penjualan_terbanyak" id="bulan_penjualan_terbanyak">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group" id="tahunjual">
                        <label>Pilih Tahun : </label>
                        <select class="form-control" name="tahun_penjualan_terbanyak" id="tahun_penjualan_terbanyak">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="cari_penjualan_terbanyak" class="btn btn-warning float-right">Cari</button>
                    </div>
                    <div id="clearfix"></div>
                    <br/>
                    <br/>
                    <div id="chartPenjualanbanyak" width="100%" style="height: 400px;"></div>
                    <div id="penjualanbanyak404" class="text-center"><h5>- Tidak ditemukan data penjualan -</h5></div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-chart-pie me-1"></i>
                    Pembelian Terbanyak
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label>Kategori : </label>
                        <select class="form-control" name="kategori_pembelian_terbanyak" id="kategori_pembelian_terbanyak">
                            <option value="bulanan">Bulanan</option>
                            <option value="tahunan">Tahunan</option>
                        </select>
                    </div>
                    <div class="form-group" id="bulanbelibanyak">
                        <label>Pilih Bulan : </label>
                        <select class="form-control" name="bulan_pembelian_terbanyak" id="bulan_pembelian_terbanyak">
                            <option value="1">Januari</option>
                            <option value="2">Februari</option>
                            <option value="3">Maret</option>
                            <option value="4">April</option>
                            <option value="5">Mei</option>
                            <option value="6">Juni</option>
                            <option value="7">Juli</option>
                            <option value="8">Agustus</option>
                            <option value="9">September</option>
                            <option value="10">Oktober</option>
                            <option value="11">November</option>
                            <option value="12">Desember</option>
                        </select>
                    </div>
                    <div class="form-group" id="tahunbelibanyak">
                        <label>Pilih Tahun : </label>
                        <select class="form-control" name="tahun_pembelian_terbanyak" id="tahun_pembelian_terbanyak">
                            <option value="2020">2020</option>
                            <option value="2021">2021</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="cari_pembelian_terbanyak" class="btn btn-warning float-right">Cari</button>
                    </div>
                    <div id="clearfix"></div>
                    <br/>
                    <br/>
                    <div id="chartPembelianbanyak" width="100%" style="height: 400px;"></div>
                    <div id="pembelianbanyak404" class="text-center"><h5>- Tidak ditemukan data penjualan -</h5></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>