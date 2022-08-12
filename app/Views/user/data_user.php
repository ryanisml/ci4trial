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
            <a href="<?= base_url('user/tambah') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-plus"></i> Tambah</a>
        </div>
        <div class="card-body">
            <table id="datatablesSimple" class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; foreach($duser as $row): ?>
                        <tr>
                            <td><?= $no ?></td>
                            <td><?= $row->username ?></td>
                            <td><?= $row->email ?></td>
                            <td class="text-center"><?= ($row->status) ? 'Akun Aktif' : 'Akun Non Aktif'; ?></td>
                            <td class="text-center"><a href="<?= base_url('user/send/'.$row->id_user) ?>" class="btn btn-sm btn-warning" title="Kirim ulang password"><i class="fas fa-envelope"></i></a>&nbsp;&nbsp;&nbsp;<a href="<?= base_url('user/ubah/'.$row->id_user) ?>" class="btn btn-sm btn-warning" title="Edit Data"><i class="fas fa-edit"></i></a><?php if($row->username != 'admin'){ ?>&nbsp;&nbsp;&nbsp;<a href="<?= base_url('user/hapus/'.$row->id_user) ?>" class="btn btn-sm btn-warning btnhapus" data-status="<?= $row->username ?>" title="Hapus Data"><i class="fas fa-trash"></i></a><?php } ?></td>
                        </tr>
                    <?php $no++; endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>