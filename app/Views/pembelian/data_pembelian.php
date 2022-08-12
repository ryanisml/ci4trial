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
            <a href="<?= base_url('pembelian/tambah') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table id="othersTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Beli</th>
                        <th>Nama Barang</th>
                        <th>Stok</th>
                        <th>Harga Satuan</th>
                        <th>Total Harga</th>
                        <th>Tanggal Beli</th>
                        <th>Vendor</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resdata as $row): ?>
                        <tr>
                            <td><?= $row->kode_pembelian ?></td>
                            <td><?= $row->kode_barang.' - '.$row->nama_barang ?></td>
                            <td><?= $row->jumlah ?></td>
                            <td>Rp<?= number_format($row->harga_beli_satuan, 2, ",", ".") ?></td>
                            <td>Rp<?= number_format($row->jumlah * $row->harga_beli_satuan, 2, ",", ".") ?></td>
                            <td><?= $row->tanggal_beli ?></td>
                            <td><?= $row->nama_vendor ?></td>
                            <td class="text-center"><a href="<?= base_url('pembelian/ubah/'.$row->kode_pembelian) ?>" class="btn btn-sm btn-warning" title="Edit Data Barang"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?= base_url('pembelian/hapus/'.$row->kode_pembelian) ?>" class="btn btn-sm btn-warning btnhapus" data-status="<?= $row->nama_barang ?>" title="Hapus Data Barang"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>