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
            <a href="<?= base_url('penjualan') ?>" class="float-right btn btn-primary btn-sm"><i class="fas fa-arrow-left"></i> Kembali</a>
        </div>
        <div class="card-body">
            <form action="<?= $formurl ?>" method="POST" id="fpenjualan">
                <input type="hidden" name="kode_penjualan" value="<?= (isset($getdata) && $getdata->kode_penjualan != null) ? $getuser->kode_penjualan : ''; ?>">
                <div class="form-group">
                    <label>Tanggal Penjualan :</label>
                    <input type="text" class="form-control" name="tanggal_jual" autocomplete="off" placeholder="Tanggal Penjualan" value="<?php echo date('d-m-Y H:i'); ?>" readonly>
                </div>
                <div class="form-group">
                    <label>Kode - Nama Barang : </label>
                    <select class="form-control selectbarang" name="kodebrg">
                        <option></option>
                        <?php foreach($barang as $row): ?>
                            <option value="<?= $row->kode_barang ?>" <?= (isset($getdata) && $getdata->kode_barang != null && $getdata->kode_barang == $row->kode_barang) ? 'selected' : ''; ?>><?= $row->kode_barang.' - '.$row->nama_barang ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <table class="table table-bordered" id="table_penjualan">
                    <thead>
                        <tr>
                            <td colspan="6" class="text-center"><b>List Barang</b></td>
                        </tr>
                        <tr>
                            <td>Kode</td>
                            <td>Nama Barang</td>
                            <td>Barcode</td>
                            <td>Harga Satuan</td>
                            <td>Stok</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
                <table class="table table-sm table-bordered float-right">
                    <tr>
                        <th width="20%" class="align-middle">Total Harga</th>
                        <td>
                            <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="Total Harga" readonly="">
                        </td>
                    </tr>
                    <tr>
                        <th class="align-middle">Total Bayar</th>
                        <td><input type="number" name="total_bayar" class="form-control" placeholder="Total Pembayaran" id="total_bayar"></td>
                    </tr>
                    <tr>
                        <th class="align-middle">Kembalian</th>
                        <td><input type="number" name="kembalian" class="form-control" placeholder="Kembalian" id="kembalian"></td>
                    </tr>
                </table>
                <!-- <div class="form-group">
                    <label>Stok Masuk :</label>
                    <input type="number" class="form-control" name="stok" autocomplete="off" placeholder="Stok Barang Masuk" value="<?= (isset($getdata) && $getdata->jumlah != null) ? $getdata->jumlah : '0'; ?>">
                </div>
                <div class="form-group">
                    <label>Harga Beli Satuan :</label>
                    <input type="number" class="form-control" name="harga_satuan" autocomplete="off" placeholder="Harga Beli" value="<?= (isset($getdata) && $getdata->harga_satuan != null) ? $getdata->harga_satuan : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Tanggal Beli :</label>
                    <input type="date" class="form-control" name="tanggal_beli" autocomplete="off" placeholder="Tanggal Pembelian" value="<?= (isset($getdata) && $getdata->tanggal_beli != null) ? $getdata->tanggal_beli : ''; ?>">
                </div>
                <div class="form-group">
                    <label>Nama Vendor :</label>
                    <input type="text" class="form-control" name="vendor" placeholder="Nama Vendor" value="<?= (isset($getdata) && $getdata->nama_vendor != null) ? $getdata->nama_vendor : ''; ?>">
                </div> -->
                <button type="button" class="btn btn-info btn-sm float-left" id="kalkulasi"><i class="fas fa-calculator"></i> Kalkulasi</button>
                <button type="submit" class="btn btn-primary btn-sm float-right"><i class="fas fa-save"></i> Simpan</button>
            </form>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>