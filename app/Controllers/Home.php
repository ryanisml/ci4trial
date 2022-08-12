<?php

namespace App\Controllers;
use App\Models\DataModel;

class Home extends BaseController
{
	protected $dm;

	public function __construct(){
		$this->dm = new DataModel();
	}

	public function index(){
		if (session()->get('username') == null) {
			return redirect()->to('home/login');
		}

		$data = array(
            'title' => 'Dashboard - Tugas',
            'pagename' => 'Dashboard',
            'subtitle' => 'Detail',
            'jsfile' => array(
                'https://cdn.amcharts.com/lib/4/core.js',
                'https://cdn.amcharts.com/lib/4/charts.js',
                'https://cdn.amcharts.com/lib/4/themes/dataviz.js',
                'https://cdn.amcharts.com/lib/4/themes/kelly.js',
                'https://cdn.amcharts.com/lib/4/themes/animated.js',
                'https://cdn.amcharts.com/lib/4/themes/material.js',
                base_url().'/public/asset/js/dashboard.js'
            )
        );
		return view('dashboard', $data);
	}

	public function login(){
		if (session()->get('username') != null) {
			return redirect()->to('home');
		}

		if ($this->request->getPost() != null) {
			$username = $this->request->getPost('username');
			$password = $this->request->getPost('password');
			$table = 'tb_user';
			$where = "username = '".$username."' AND password = '".md5($password)."'";
			$cek = $this->dm->get_where_id($table, $where);
			if ($cek != false) {
				$newdata = [
				        'username'  => $username,
				        'email'     => $cek->email
				];

				session()->set($newdata);
				return redirect()->to('home');
			}else{
				session()->setFlashdata('pesan', array('message' => 'Username atau password tidak ditemukan', 'class' => 'danger', 'title' => 'Gagal Login!'));
				return redirect()->to('home/login');
			}
		}else{
			$data = array(
	            'title' => 'Login Page Dashboard Apps - Tugas'
	        );
			return view('login_page', $data);
		}
	}

	public function logout(){
		session()->destroy();
		return redirect()->to('home/login');
	}

	public function cari_penjualan(){
		$response['success'] = false;
		if ($this->request->getPost() != null) {
			// var_dump($this->request->getPost());
			$kategori = $this->request->getPost('kategori');
			$tahun = $this->request->getPost('tahun');
			$bulan = $this->request->getPost('bulan');
			if ($kategori == 'bulanan') {
				$hasil = $this->dm->hitung_penjualan_bulan($bulan, $tahun);
			}else{
				$hasil = $this->dm->hitung_penjualan_tahun($tahun);
			}
			if ($hasil) {
				$response['success'] = true;
				$response['hasil'] = $hasil;
			}
		}
		echo json_encode($response);
	}

	public function cari_pembelian(){
		$response['success'] = false;
		if ($this->request->getPost() != null) {
			// var_dump($this->request->getPost());
			$kategori = $this->request->getPost('kategori');
			$tahun = $this->request->getPost('tahun');
			$bulan = $this->request->getPost('bulan');
			if ($kategori == 'bulanan') {
				$hasil = $this->dm->hitung_pembelian_bulan($bulan, $tahun);
			}else{
				$hasil = $this->dm->hitung_pembelian_tahun($tahun);
			}
			if ($hasil) {
				$response['success'] = true;
				$response['hasil'] = $hasil;
			}
		}
		echo json_encode($response);
	}

	public function cari_penjualan_terbanyak(){
		$response['success'] = false;
		if ($this->request->getPost() != null) {
			$kategori = $this->request->getPost('kategori');
			$tahun = $this->request->getPost('tahun');
			$bulan = $this->request->getPost('bulan');
			if ($kategori == 'bulanan') {
				$hasil = $this->dm->hitung_penjualan_banyak_bulan($bulan, $tahun);
			}else{
				$hasil = $this->dm->hitung_penjualan_banyak_tahun($tahun);
			}
			if ($hasil) {
				$response['success'] = true;
				$response['hasil'] = $hasil;
			}
		}
		echo json_encode($response);
	}

	public function cari_pembelian_terbanyak(){
		$response['success'] = false;
		if ($this->request->getPost() != null) {
			// var_dump($this->request->getPost());
			$kategori = $this->request->getPost('kategori');
			$tahun = $this->request->getPost('tahun');
			$bulan = $this->request->getPost('bulan');
			if ($kategori == 'bulanan') {
				$hasil = $this->dm->hitung_pembelian_banyak_bulan($bulan, $tahun);
			}else{
				$hasil = $this->dm->hitung_pembelian_banyak_tahun($tahun);
			}
			if ($hasil) {
				$response['success'] = true;
				$response['hasil'] = $hasil;
			}
		}
		echo json_encode($response);
	}

	public function tampil_data_barang(){
		$response['success'] = false;
		$hasil = $this->dm->sum_data_barang();
		if ($hasil) {
			$response['success'] = true;
			$response['hasil'] = $hasil;
		}
		echo json_encode($response);
	}
}
