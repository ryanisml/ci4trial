<?php

namespace App\Controllers;
use App\Models\DataModel;

class Barang extends BaseController
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
            'title' => 'Data Barang - Tugas',
            'pagename' => 'Barang',
            'subtitle' => 'Table',
            'resdata' => $this->dm->get_barang(),
            'cssfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.css',
            ),
            'jsfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                base_url().'/public/asset/js/datatables-others.js'
            )
        );
		return view('barang/data_barang', $data);
	}

    public function tambah(){
        if ($this->request->getPost() != null) {
            $barcode = $this->request->getPost('barcode');
            $nama = $this->request->getPost('nama_barang');
            $kategori = $this->request->getPost('kategori');
            $satuan = $this->request->getPost('satuan');
            $harga = $this->request->getPost('harga');
            $stok = $this->request->getPost('stok');

            $table = 'tb_barang';
            $kodebrg = 'BRG0001';
            $cek = $this->dm->get_last_barang($table, 'kode_barang');
            if ($cek != false) {
                $kodeid = substr($cek->kode_barang, 3, 4) + 1;
                $kodebrg = 'BRG'.str_pad($kodeid, 4, "0", STR_PAD_LEFT);
            }
            $datas = array(
                'kode_barang' => $kodebrg,
                'barcode' => $barcode,
                'nama_barang' => $nama,
                'harga_satuan' => $harga,
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('username'),
                'id_satuan' => $satuan,
                'id_kategori' => $kategori,
                'status' => 1
            );

            $hasil = $this->dm->insert_data($table, $datas);
            if ($hasil) {
                session()->setFlashdata('pesan', array('message' => 'Berhasil menyimpan data barang', 'class' => 'success', 'title' => 'Sukses!'));
                return redirect()->to('barang');
            }else{
                session()->setFlashdata('pesan', array('message' => 'Gagal menyimpan data barang', 'class' => 'danger', 'title' => 'Maaf!'));
                return redirect()->to('barang/tambah');
            }
        }else{
            $data = array(
                'title' => 'Tambah Data Barang - Tugas',
                'pagename' => 'Barang',
                'subtitle' => 'Form',
                'formurl'  => base_url('barang/tambah'),
                'kategori' => $this->dm->get_all_where('tb_kategori', "status = 1"),
                'satuan' => $this->dm->get_all_where('tb_satuan', "status = 1"),
                'cssfile' => array(
                    base_url().'/public/asset/datatable/jquery.dataTables.min.css',
                ),
                'jsfile' => array(
                    base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                    base_url().'/public/asset/js/datatables-others.js'
                )
            );
            return view('barang/form_barang', $data);
        }
    }

    public function tes(){
        echo substr("BRG0001", 3, 4);
        echo "<br/>";
        $tempid = 2;
        echo 'BRG'.str_pad($tempid, 4, "0", STR_PAD_LEFT);
    }
}
