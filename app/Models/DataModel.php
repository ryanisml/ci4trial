<?php

namespace App\Models;

use CodeIgniter\Model;

class DataModel extends Model
{
    protected $db;
    public function __construct(){
        $this->db = \Config\Database::connect();
    }

    public function get_all($table){
        $builder = $this->db->table($table);
        $hasil = $builder->get()->getResult();
        return $hasil;
    }

    public function get_all_where($table, $where){
        $builder = $this->db->table($table);
        $hasil = $builder->where($where)->get()->getResult();
        return $hasil;
    }

    public function get_where_id($table, $where){
        $builder = $this->db->table($table);
        $hasil = $builder->where($where)->get()->getRow();
        return $hasil;
    }

    public function insert_data($table, $data){
        $builder = $this->db->table($table);
        $hasil = $builder->insert($data);
        return $hasil;
    }

    public function update_data($table, $data, $where){
        $builder = $this->db->table($table);
        $hasil = $builder->set($data)->where($where)->update();
        return $hasil;
    }

    public function delete_data($table, $where){
        $builder = $this->db->table($table);
        $hasil = $builder->where($where)->delete();
        return $hasil;
    }

    public function get_barang(){
        $hasil = $this->db->table('tb_barang b')
                            ->join('tb_kategori k', 'b.id_kategori = k.id_kategori')
                            ->join('tb_satuan s', 'b.id_satuan = s.id_satuan')
                            ->where('b.status', 1)
                            ->get()
                            ->getResult();
        return $hasil;
    }

    public function get_pembelian_barang(){
        $hasil = $this->db->table('tb_pembelian p')
                            ->join('tb_barang b', 'b.kode_barang = p.kode_barang')
                            ->join('tb_kategori k', 'b.id_kategori = k.id_kategori')
                            ->join('tb_satuan s', 'b.id_satuan = s.id_satuan')
                            ->where('p.status', 1)
                            ->get()
                            ->getResult();
        return $hasil;
    }

    public function get_penjualan_barang(){
        $hasil = $this->db->table('tb_penjualan p')
                            ->select('*, (SELECT COUNT(*) FROM tb_dtl_penjualan d WHERE d.kode_penjualan = p.kode_penjualan) as jumlah_barang')
                            ->where('p.status', 1)
                            ->get()
                            ->getResult();
        return $hasil;
    }

    public function get_dtl_penjualan(){
        $hasil = $this->db->table('tb_dtl_penjualan p')
                            ->join('tb_barang b', 'b.kode_barang = p.kode_barang')
                            ->join('tb_kategori k', 'b.id_kategori = k.id_kategori')
                            ->join('tb_satuan s', 'b.id_satuan = s.id_satuan')
                            ->where('p.status', 1)
                            ->get()
                            ->getResult();
        return $hasil;
    }

    public function get_last_barang($table, $kolom){
        $hasil = $this->db->table($table)
                          ->orderBy($kolom, 'DESC')
                          ->limit(1)
                          ->get()
                          ->getRow();
        return $hasil;
    }

    public function hitung_penjualan_bulan($bulan, $tahun){
        $hasil = $this->db->table('tb_penjualan')
                          ->select("SUM(total_bayar) as jumlah, DATE_FORMAT(tanggal_jual, '%d/%m/%Y') as tanggal")
                          ->where('status', 1)
                          ->where('MONTH(tanggal_jual)', $bulan)
                          ->where('YEAR(tanggal_jual)', $tahun)
                          ->groupBy('DAY(tanggal_jual)')
                          ->orderBy('DAY(tanggal_jual)', 'ASC')
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_penjualan_tahun($tahun){
        $hasil = $this->db->table('tb_penjualan')
                          ->select('SUM(total_bayar) as jumlah, MONTHNAME(tanggal_jual) as tanggal')
                          ->where('status', 1)
                          ->where('YEAR(tanggal_jual)', $tahun)
                          ->groupBy('MONTH(tanggal_jual)')
                          ->orderBy('MONTH(tanggal_jual)', 'ASC')
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_pembelian_bulan($bulan, $tahun){
        $hasil = $this->db->table('tb_pembelian')
                          ->select("SUM(harga_beli_satuan * jumlah) as jumlah, DATE_FORMAT(tanggal_beli, '%d/%m/%Y') as tanggal")
                          ->where('status', 1)
                          ->where('MONTH(tanggal_beli)', $bulan)
                          ->where('YEAR(tanggal_beli)', $tahun)
                          ->groupBy('DAY(tanggal_beli)')
                          ->orderBy('DAY(tanggal_beli)', 'ASC')
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_pembelian_tahun($tahun){
        $hasil = $this->db->table('tb_pembelian')
                          ->select('SUM(harga_beli_satuan * jumlah) as jumlah, MONTHNAME(tanggal_beli) as tanggal')
                          ->where('status', 1)
                          ->where('YEAR(tanggal_beli)', $tahun)
                          ->groupBy('MONTH(tanggal_beli)')
                          ->orderBy('MONTH(tanggal_beli)', 'ASC')
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_penjualan_banyak_bulan($bulan, $tahun){
        $hasil = $this->db->table('tb_dtl_penjualan d')
                          ->select("SUM(jumlah_beli) as jumlah, nama_barang as barang")
                          ->join('tb_penjualan p', 'd.kode_penjualan = p.kode_penjualan')
                          ->where('d.status', 1)
                          ->where('p.status', 1)
                          ->where('MONTH(tanggal_jual)', $bulan)
                          ->where('YEAR(tanggal_jual)', $tahun)
                          ->groupBy("nama_barang")
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_penjualan_banyak_tahun($tahun){
        $hasil = $this->db->table('tb_dtl_penjualan d')
                          ->select("SUM(jumlah_beli) as jumlah, nama_barang as barang")
                          ->join('tb_penjualan p', 'd.kode_penjualan = p.kode_penjualan')
                          ->where('d.status', 1)
                          ->where('p.status', 1)
                          ->where('YEAR(tanggal_jual)', $tahun)
                          ->groupBy("nama_barang")
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_pembelian_banyak_bulan($bulan, $tahun){
        $hasil = $this->db->table('tb_pembelian p')
                          ->select("SUM(jumlah) as jumlah, nama_barang as barang")
                          ->join('tb_barang b', 'b.kode_barang = p.kode_barang')
                          ->where('b.status', 1)
                          ->where('p.status', 1)
                          ->where('MONTH(tanggal_beli)', $bulan)
                          ->where('YEAR(tanggal_beli)', $tahun)
                          ->groupBy("nama_barang")
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function hitung_pembelian_banyak_tahun($tahun){
        $hasil = $this->db->table('tb_pembelian p')
                          ->select('SUM(jumlah) as jumlah, nama_barang as barang')
                          ->join('tb_barang b', 'b.kode_barang = p.kode_barang')
                          ->where('b.status', 1)
                          ->where('p.status', 1)
                          ->where('YEAR(tanggal_beli)', $tahun)
                          ->groupBy("nama_barang")
                          ->get()
                          ->getResult();
        return $hasil;
    }

    public function sum_data_barang(){
        $hasil = $this->db->table('tb_barang')
                          ->select('SUM(stok) as jumlah, nama_barang as barang')
                          ->where('status', 1)
                          ->groupBy("nama_barang")
                          ->get()
                          ->getResult();
        return $hasil;
    }
}