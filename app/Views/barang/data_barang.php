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
            <a href="<?= base_url('barang/tambah') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table id="othersTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Kode Barang</th>
                        <th>Barcode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Harga Jual</th>
                        <th>Stok</th>
                        <th>Last Update</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($resdata as $row): ?>
                        <tr>
                            <td><?= $row->kode_barang ?></td>
                            <td><?= $row->barcode ?></td>
                            <td><?= $row->nama_barang ?></td>
                            <td><?= $row->nama_kategori ?></td>
                            <td><?= $row->nama_satuan ?></td>
                            <td>Rp<?= number_format($row->harga_satuan, 2, ",", ".") ?></td>
                            <td><?= $row->stok ?></td>
                            <td><?= ($row->updated_at != null) ? $row->updated_at.'('.$row->updated_by.')' : '-'; ?></td>
                            <td class="text-center"><a href="<?= base_url('barang/lihat/'.$row->kode_barang) ?>" class="btn btn-sm btn-warning" title="Lihat Detail Data"><i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?= base_url('barang/ubah/'.$row->kode_barang) ?>" class="btn btn-sm btn-warning" title="Edit Data Barang"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?= base_url('barang/hapus/'.$row->kode_barang) ?>" class="btn btn-sm btn-warning btnhapus" data-status="<?= $row->nama_barang ?>" title="Hapus Data Barang"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>