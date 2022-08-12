<?= $this->extend('layout/template'); ?>

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
            <a href="<?= base_url('others/tambah-kategori') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table id="othersTable" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($resdata as $row): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row->nama_kategori ?></td>
                            <td class="text-center"><a href="<?= base_url('others/ubah-kategori/'.$row->id_kategori) ?>" class="btn btn-sm btn-warning" title="Edit Data"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?= base_url('others/hapus-kategori/'.$row->id_kategori) ?>" class="btn btn-sm btn-warning btnhapus" data-status="<?= $row->nama_kategori ?>" title="Hapus Data"><i class="fas fa-trash"></i></a></td>
                        </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>