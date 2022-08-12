data_barang.php<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Data <?= $pagename ?></h1>
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
            <?= $subtitle ?> Data <?= $pagename ?>
            <a href="<?= base_url('penjualan') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <table class="table table-sm">
                <tr>
                    <th colspan="3">Detail Data Penjualan</th>
                </tr>
                <tr>
                    <td width="20%">Kode Penjualan</td>
                    <td width="2%">:</td>
                    <td><?= $getheader->kode_penjualan ?></td>
                </tr>
                <tr>
                    <td>Total Barang</td>
                    <td>:</td>
                    <td><?= count($getdetail) ?> barang</td>
                </tr>
                <tr>
                    <td>Tanggal Penjualan</td>
                    <td>:</td>
                    <td><?= $getheader->tanggal_jual ?></td>
                </tr>
                <tr>
                    <td>Dibuat Oleh</td>
                    <td>:</td>
                    <td><?= $getheader->created_by ?></td>
                </tr>

            </table>
            <table id="othersTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Beli</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($getdetail as $row): ?>
                        <tr>
                            <td><?= $row->kode_barang ?></td>
                            <td><?= $row->nama_barang ?></td>
                            <td><?= $row->jumlah_beli ?></td>
                            <td>Rp<?= number_format($row->harga_satuan_beli, 2, ",", ".") ?></td>
                            <td>Rp<?= number_format($row->harga_satuan_beli * $row->jumlah_beli, 2, ",", ".") ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>