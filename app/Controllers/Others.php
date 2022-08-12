<?php

namespace App\Controllers;
use App\Models\DataModel;

class Others extends BaseController
{
	protected $dm;

	public function __construct(){
		$this->dm = new DataModel();
        if (session()->get('username') == null) {
            return redirect()->to('home/login');
        }
	}

	public function kategori(){
		$data = array(
            'title' => 'Kategori Barang - Tugas',
            'pagename' => 'Kategori',
            'subtitle' => 'Detail',
            'resdata' => $this->dm->get_all_where('tb_kategori', "status = 1"),
            'cssfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.css',
            ),
            'jsfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                base_url().'/public/asset/js/datatables-others.js'
            )
        );
		return view('others/data_kategori', $data);
	}

	public function satuan(){
		$data = array(
            'title' => 'Satuan Barang - Tugas',
            'pagename' => 'Satuan',
            'subtitle' => 'Detail',
            'resdata' => $this->dm->get_all_where('tb_satuan', "status = 1"),
            'cssfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.css',
            ),
            'jsfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                base_url().'/public/asset/js/datatables-others.js'
            )
        );
		return view('others/data_satuan', $data);
	}
}
