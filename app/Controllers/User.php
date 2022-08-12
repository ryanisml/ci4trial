<?php

namespace App\Controllers;
use App\Models\DataModel;

class User extends BaseController
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
            'title' => 'Data User Dashboard - Tugas',
            'pagename' => 'User',
            'subtitle' => 'Table',
            'duser' => $this->dm->get_all('tb_user'),
            'cssfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.css',
            ),
            'jsfile' => array(
                base_url().'/public/asset/datatable/jquery.dataTables.min.js',
                base_url().'/public/asset/js/datatables-simple-demo.js'
            )
        );
		return view('user/data_user', $data);
	}

	public function tambah(){
		if ($this->request->getPost() != null) {
			$username = $this->request->getPost('username');
			$email = $this->request->getPost('email');
			$table = 'tb_user';
			$where = "username = '".$username."' OR email = '".$email."'";
			$cek = $this->dm->get_where_id($table, $where);
			if ($cek != false) {
				if ($cek->username == $username) {
					session()->setFlashdata('pesan', array('message' => 'Username telah digunakan', 'class' => 'danger', 'title' => 'Gagal!'));
				}else{
					session()->setFlashdata('pesan', array('message' => 'Email telah digunakan', 'class' => 'danger', 'title' => 'Gagal!'));
				}
				return redirect()->to('user/tambah');
			}else{
				$pass = substr(md5(time()), 0, 6);

				$this->send_email($email, $username, $pass, 'Pembuatan Akun Baru - Tugas');

				$datas = array(
					'username' => $username,
					'email'	=> $email,
					'password' => md5($pass),
					'status' => 1
				);

				$hasil = $this->dm->insert_data($table, $datas);
				if ($hasil) {
					session()->setFlashdata('pesan', array('message' => 'Berhasil menyimpan data user', 'class' => 'success', 'title' => 'Sukses!'));
					return redirect()->to('user');
				}else{
					session()->setFlashdata('pesan', array('message' => 'Gagal menyimpan data', 'class' => 'danger', 'title' => 'Maaf!'));
					return redirect()->to('user/tambah');
				}
			}
		}else{
			$data = array(
	            'title' => 'Tambah Data User Dashboard - Tugas',
	            'pagename' => 'User',
	            'subtitle' => 'Form',
	            'formurl' => base_url('user/tambah')
	        );
			return view('user/form_user', $data);
		}
	}

	public function ubah($id){
		$table = 'tb_user';
		$where = "id_user = '".$id."'";
		$cek = $this->dm->get_where_id($table, $where);
		if ($cek != false) {
			if ($this->request->getPost('iduser') != null) {
				$aktif = $this->request->getPost('aktivasi');

				$datas = array(
					'status' => $aktif
				);

				$hasil = $this->dm->update_data($table, $datas, $where);

				if ($hasil) {
					session()->setFlashdata('pesan', array('message' => 'Berhasil mengubah status akun', 'class' => 'success', 'title' => 'Sukses!'));
				}else{
					session()->setFlashdata('pesan', array('message' => 'Gagal mengubah status akun', 'class' => 'danger', 'title' => 'Maaf!'));
				}
				return redirect()->to('user');
			}else{
				$data = array(
		            'title' => 'Ubah Data User Dashboard - Tugas',
		            'pagename' => 'User',
		            'subtitle' => 'Form',
		            'iduser' => $id,
		            'getuser' => $this->dm->get_where_id('tb_user', "id_user = $id"),
		            'formurl' => base_url('user/ubah/'.$id)
		        );
				return view('user/form_user', $data);
			}
		}else{
			session()->setFlashdata('pesan', array('message' => 'Data user tidak ditemukan', 'class' => 'warning', 'title' => 'Informasi!'));
			return redirect()->to('user');
		}
	}

	public function hapus($id){
		$table = 'tb_user';
		$where = "id_user = '".$id."'";
		$cek = $this->dm->get_where_id($table, $where);
		if ($cek != false) {
			$hapus = $this->dm->delete_data($table, $where);
			if ($hapus) {
				session()->setFlashdata('pesan', array('message' => 'Berhasil menghapus data', 'class' => 'success', 'title' => 'Sukses!'));
			}else{
				session()->setFlashdata('pesan', array('message' => 'Gagal menghapus data', 'class' => 'danger', 'title' => 'Maaf!'));
			}
		}else{
			session()->setFlashdata('pesan', array('message' => 'Data user tidak ditemukan', 'class' => 'warning', 'title' => 'Informasi!'));
		}
		return redirect()->to('user');
	}

	public function send($id){
		$table = 'tb_user';
		$where = "id_user = '".$id."'";
		$cek = $this->dm->get_where_id($table, $where);
		if ($cek != false) {
			$pass = substr(md5(time()), 0, 6);
			$this->send_email($cek->email, $cek->username, $pass, 'Pembaruan Akun - Tugas');
			$datas = array(
				'password' => md5($pass)
			);

			$hasil = $this->dm->update_data($table, $datas, $where);
			if ($hasil) {
				session()->setFlashdata('pesan', array('message' => 'Berhasil mengirim ulang password ke email '.$cek->email, 'class' => 'success', 'title' => 'Sukses!'));
			}else{
				session()->setFlashdata('pesan', array('message' => 'Gagal mengirim ulang password ke email', 'class' => 'danger', 'title' => 'Maaf!'));
			}
		}else{
			session()->setFlashdata('pesan', array('message' => 'Data user tidak ditemukan', 'class' => 'warning', 'title' => 'Informasi!'));
		}
		return redirect()->to('user');

	}

	private function send_email($emailuser, $username, $password, $subject){
		//SEND EMAIL
        $email_smtp = \Config\Services::email();

        $config['userAgent']        = 'PHPMailer';              // Mail engine switcher: 'CodeIgniter' or 'PHPMailer'
        $config['protocol']         = 'smtp';                   // 'mail', 'sendmail', or 'smtp'
        $config['SMTPHost']        = 'smtp.gmail.com';
        $config['SMTPUser']        = 'emailtesting.ryan@gmail.com';
        $config['SMTPPass']        = 'Indonesia@123';
        $config['SMTPPort']        = 587;
        // $config['smtp_crypto']      = 'tls';                    // TLS or SSL
        // $config['smtp_timeout']     = 10;                        // (in seconds)
        // $config['smtp_debug']       = 1;                        // PHPMailer's SMTP debug info level: 0 = off, 1 = commands, 2 = commands and data
        // $config['wordwrap']         = true;
        // $config['wrapchars']        = 76;
        $config['mailType']         = 'html';                   // 'text' or 'html'
        // $config['charset']          = 'utf-8';
        // $config['validate']         = true;
        // $config['crlf']             = "\r\n";                     // "\r\n" or "\n" or "\r"
        // $config['newline']          = "\r\n";                     // "\r\n" or "\n" or "\r"

        $email_smtp->initialize($config);

		$email_smtp->setFrom('emailtesting.ryan@gmail.com', 'NO-REPLY');
		$email_smtp->setTo($emailuser);

		$email_smtp->setSubject($subject);
		$email_smtp->setMessage("Berikut ini adalah akun anda. <br/>Username : $username. <br/>Password : $password");

		$email_smtp->send();
	}
}
