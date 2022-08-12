<?php

namespace App\Controllers;
use App\Models\DataModel;

class Penjualan extends BaseController
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
            'title' => 'Data Penjualan - Tugas',
            'pagename' => 'Penjualan',
            'subtitle' => 'Table',
            'resdata' => $this->dm->get_penjualan_barang(),
            'cssfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.css',
            ),
            'jsfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                base_url().'/public/asset/js/datatables-others.js'
            )
        );
		return view('penjualan/data_penjualan', $data);
	}

    public function detail($kode){
        $table = 'tb_penjualan';
        $where = "kode_penjualan = '".$kode."'";
        $cek = $this->dm->get_where_id($table, $where);
        if ($cek != false) {
            $data = array(
                'title' => 'Data Detail Penjualan - '.$kode.' - Tugas',
                'pagename' => 'Detail Penjualan',
                'subtitle' => 'Table',
                'getheader' => $cek,
                'getdetail' => $this->dm->get_all_where('tb_dtl_penjualan', "status = 1 AND kode_penjualan = '".$kode."'")
            );
            return view('penjualan/detail_penjualan', $data);
        }else{
            session()->setFlashdata('pesan', array('message' => 'Data penjualan barang tidak ditemukan', 'class' => 'warning', 'title' => 'Informasi!'));
            return redirect()->to('penjualan');
        }
    }

    public function tambah(){
        if ($this->request->getPost() != null) {
            $kode_barang = $this->request->getPost('kode_barang');
            $nama_barang = $this->request->getPost('nama_barang');
            $jumlah_beli = $this->request->getPost('jumlah_beli');
            $harga_satuan = $this->request->getPost('harga_satuan');
            $tanggal_jual = $this->request->getPost('tanggal_jual');
            $total_harga = $this->request->getPost('total_harga');
            $total_bayar = $this->request->getPost('total_bayar');
            
            $table = 'tb_penjualan';
            $kodebeli = 'JL0000001';
            $cek = $this->dm->get_last_barang($table, 'kode_penjualan');
            if ($cek != false) {
                $kodeid = substr($cek->kode_penjualan, 2, 7) + 1;
                $kodebeli = 'JL'.str_pad($kodeid, 7, "0", STR_PAD_LEFT);
            }
            $datas = array(
                'kode_penjualan' => $kodebeli,
                'total_harga' => $total_harga,
                'total_bayar' => $total_bayar,
                'tanggal_jual' => date('Y-m-d H:i:s', strtotime($tanggal_jual)),
                'created_at' => date('Y-m-d H:i:s'),
                'created_by' => session()->get('username'),
                'status' => 1
            );

            $has = $this->dm->insert_data($table, $datas);

            if ($has) {
                $inpdtl = null;
                for ($i=0; $i < count($kode_barang); $i++) { 
                    $datadtl = array(
                        'kode_penjualan' => $kodebeli,
                        'kode_barang' => $kode_barang[$i],
                        'nama_barang' => $nama_barang[$i],
                        'harga_satuan_beli' => $harga_satuan[$i],
                        'jumlah_beli' => $jumlah_beli[$i],
                        'created_at' => date('Y-m-d H:i:s'),
                        'created_by' => session()->get('username'),
                        'status' => 1
                    );
                    $inpdtl = $this->dm->insert_data('tb_dtl_penjualan', $datadtl);

                    $cek2 = $this->dm->get_where_id('tb_barang', "kode_barang = '".$kode_barang[$i]."'");
                    if ($cek2 != false) {
                        $datau = array(
                            'stok' => $cek2->stok - $jumlah_beli[$i],
                            'updated_at' => date('Y-m-d H:i:s'),
                            'updated_by' => session()->get('username')
                        );

                        $hasil = $this->dm->update_data('tb_barang', $datau, "kode_barang = '".$kode_barang[$i]."'");
                    }
                }
                if ($inpdtl) {
                    session()->setFlashdata('pesan', array('message' => 'Berhasil menyimpan data penjualan barang', 'class' => 'success', 'title' => 'Sukses!'));
                    return redirect()->to('penjualan');
                }else{
                    session()->setFlashdata('pesan', array('message' => 'Gagal menyimpan data penjualan barang', 'class' => 'danger', 'title' => 'Maaf!'));
                    return redirect()->to('penjualan/tambah');
                }
            }else{
                session()->setFlashdata('pesan', array('message' => 'Gagal menyimpan data penjualan barang', 'class' => 'danger', 'title' => 'Maaf!'));
                return redirect()->to('penjualan/tambah');
            }
        }else{
            $data = array(
                'title' => 'Tambah Data Penjualan Barang - Tugas',
                'pagename' => 'Penjualan Barang',
                'subtitle' => 'Form',
                'formurl'  => base_url('penjualan/tambah'),
                'barang' => $this->dm->get_all_where('tb_barang', "status = 1 AND stok > 0"),
                'cssfile' => array(
                    base_url().'/public/asset/datatable/jquery.dataTables.min.css',
                    base_url().'/public/asset/select2/select2.min.css'
                ),
                'jsfile' => array(
                    base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                    base_url().'/public/asset/select2/select2.min.js',
                    base_url().'/public/asset/js/penjualan.js'
                )
            );
            return view('penjualan/form_penjualan', $data);
        }
    }

    public function getdata(){
        $response['success'] = false;
        if ($this->request->getPost() != null) {
            $kode = $this->request->getPost('kodebarang');
            $cek = $this->dm->get_where_id('tb_barang', "kode_barang = '".$kode."'");
            if ($cek != false) {
                $response['success'] = true;
                $response['nama_barang'] = $cek->nama_barang;
                $response['barcode'] = $cek->barcode;
                $response['harga_satuan'] = $cek->harga_satuan;
                $response['stok'] = $cek->stok;
            }
        }

        echo json_encode($response);
    }
}
