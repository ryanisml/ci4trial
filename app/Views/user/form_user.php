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
            <?= $subtitle ?> <?= $pagename ?>
            <a href="<?= base_url('user') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= $formurl ?>" method="POST">
                <input type="hidden" name="iduser" value="<?= (isset($getuser) && $getuser->id_user != null) ? $getuser->id_user : ''; ?>">
                <div class="form-group">
                    <label for="email">Username:</label>
                    <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" value="<?= (isset($getuser) && $getuser->username != null) ? $getuser->username : ''; ?>" <?= (isset($getuser) && $getuser->username != null) ? 'readonly' : ''; ?>>
                </div>
                <div class="form-group">
                    <label for="pwd">Email:</label>
                    <input type="email" class="form-control" name="email" autocomplete="off" placeholder="Email" value="<?= (isset($getuser) && $getuser->email != null) ? $getuser->email : ''; ?>" <?= (isset($getuser) && $getuser->email != null) ? 'readonly' : ''; ?>>
                    <label class="text-small text-danger">* Password akan dikirim melalui email</label>
                </div>
                <?php if(isset($getuser) && $getuser->status != null){ ?>
                    <div class="form-group">
                        <label>Status Akun</label>
                        <select class="form-control" name="aktivasi">
                            <option value="1" <?= (isset($getuser) && $getuser->status != null && $getuser->status == 1) ? 'selected' : ''; ?>>Aktif</option>
                            <option value="0" <?= (isset($getuser) && $getuser->status != null && $getuser->status == 0) ? 'selected' : ''; ?>>Non Aktif</option>
                        </select>
                    </div>
                <?php } ?>
                <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>