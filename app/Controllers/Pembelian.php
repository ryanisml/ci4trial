<?php

namespace App\Controllers;
use App\Models\DataModel;

class Pembelian extends BaseController
{
	protected $dm;

	public function __construct(){
		$this->dm = new DataModel();
        if (session()->get('username') == null) {
            return redirect()->to('home/login');
        }
	}

	public function index(){
		$data = array(
            'title' => 'Data Pembelian - Tugas',
            'pagename' => 'Pembelian',
            'subtitle' => 'Table',
            'resdata' => $this->dm->get_pembelian_barang(),
            'cssfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.css',
            ),
            'jsfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                base_url().'/public/asset/js/datatables-others.js'
            )
        );
		return view('pembelian/data_pembelian', $data);
	}

    public function tambah(){
        if ($this->request->getPost() != null) {
            $kode_barang = $this->request->getPost('kode_barang');
            $stok = $this->request->getPost('stok');
            $harga_satuan = $this->request->getPost('harga_satuan');
            $tanggal_beli = $this->request->getPost('tanggal_beli');
            $vendor = $this->request->getPost('vendor');

            $table = 'tb_pembelian';
            $kodebeli = 'BL00001';
            $cek = $this->dm->get_last_barang($table, 'kode_pembelian');
            if ($cek != false) {
                $kodeid = substr($cek->kode_pembelian, 2, 5) + 1;
                $kodebeli = 'BL'.str_pad($kodeid, 5, "0", STR_PAD_LEFT);
            }
            $datas = array(
                'kode_pembelian' => $kodebeli,
                'kode_barang' => $kode_barang,
                'jumlah' => $stok,
                'harga_beli_satuan' => $harga_satuan,
                'tanggal_beli' => $tanggal_beli,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('username'),
                'nama_vendor' => $vendor,
                'status' => 1
            );

            $has = $this->dm->insert_data($table, $datas);

            if ($has) {
                $cek = $this->dm->get_where_id('tb_barang', "kode_barang = '".$kode_barang."'");
                if ($cek != false) {
                    $datau = array(
                        'stok' => $cek->stok + $stok,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'updated_by' => session()->get('username')
                    );

                    $hasil = $this->dm->update_data('tb_barang', $datau, "kode_barang = '".$kode_barang."'");
                }
                session()->setFlashdata('pesan', array('message' => 'Berhasil menyimpan data pembelian barang', 'class' => 'success', 'title' => 'Sukses!'));
                return redirect()->to('pembelian');
            }else{
                session()->setFlashdata('pesan', array('message' => 'Gagal menyimpan data pembelian barang', 'class' => 'danger', 'title' => 'Maaf!'));
                return redirect()->to('pembelian/tambah');
            }
        }else{
            $data = array(
                'title' => 'Tambah Data Pembelian Stok Barang - Tugas',
                'pagename' => 'Pembelian Stok',
                'subtitle' => 'Form',
                'formurl'  => base_url('pembelian/tambah'),
                'barang' => $this->dm->get_all_where('tb_barang', "status = 1"),
                'cssfile' => array(
                    base_url().'/public/asset/datatable/jquery.dataTables.min.css',
                ),
                'jsfile' => array(
                    base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                    base_url().'/public/asset/js/datatables-others.js'
                )
            );
            return view('pembelian/form_pembelian', $data);
        }
    }
}
