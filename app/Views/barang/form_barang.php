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
            <a href="<?= base_url('barang') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= $formurl ?>" method="POST">
                <input type="hidden" name="kode_barang" value="<?= (isset($getdata) && $getdata->kode_barang != null) ? $getuser->kode_barang : ''; ?>">
                <div class="form-group">
                    <label for="barcode">Barcode :</label>
                    <input type="number" class="form-control" name="barcode" placeholder="Barcode" autocomplete="off" value="<?= (isset($getdata) && $getdata->barcode != null) ? $getuser->barcode : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="nama">Nama Barang :</label>
                    <input type="text" class="form-control" name="nama_barang" autocomplete="off" placeholder="Nama Barang" value="<?= (isset($getdata) && $getdata->nama_barang != null) ? $getdata->nama_barang : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Kategori : </label>
                    <select class="form-control" name="kategori">
                        <?php foreach($kategori as $row): ?>
                            <option value="<?= $row->id_kategori ?>" <?= (isset($getdata) && $getdata->id_kategori != null && $getdata->id_kategori == $row->id_kategori) ? 'selected' : ''; ?>><?= $row->nama_kategori ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Satuan : </label>
                    <select class="form-control" name="satuan">
                        <?php foreach($satuan as $row): ?>
                            <option value="<?= $row->id_satuan ?>" <?= (isset($getdata) && $getdata->id_satuan != null && $getdata->id_satuan == $row->id_satuan) ? 'selected' : ''; ?>><?= $row->nama_satuan ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="harga">Harga Satuan Barang :</label>
                    <input type="number" class="form-control" name="harga" autocomplete="off" placeholder="Harga Satuan Barang" value="<?= (isset($getdata) && $getdata->harga_satuan != null) ? $getdata->harga_satuan : ''; ?>">
                </div>
                <div class="form-group">
                    <label for="stok">Stok Barang :</label>
                    <input type="number" class="form-control" name="stok" autocomplete="off" readonly placeholder="Stok Barang" value="<?= (isset($getdata) && $getdata->stok != null) ? $getdata->stok : '0'; ?>">
                </div>
                <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>