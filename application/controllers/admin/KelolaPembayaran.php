<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KelolaPembayaran extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->cekAksesAdmin();
		$this->session->set_flashdata('menu', 'kelola-pembayaran');
		// $this->load->model('Model_Users','user');
	}

	public function index()
	{
		$this->load->view('admin/kelola_pembayaran/index');
	}

}

/* End of file KelolaPembayaran.php */
/* Location: ./application/controllers/admin/KelolaPembayaran.php */
