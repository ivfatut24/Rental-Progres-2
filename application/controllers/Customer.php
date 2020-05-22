<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends MY_Controller
{
	private $kendaraan = [
		1 => ['Motor', 4000],
		2 => ['Mobil', 8000]
	];

	public function __construct()
	{
		parent::__construct();
		$this->load->model(['Model_Keranjang', 'Model_Products', 'Model_Pemesanan']);
		$data['list_barang'] = $this->Model_Products->getAllBarang();
		$this->cekAksesCustomer();
	}

	public function index()
	{
		$data['list_barang'] = $this->Model_Products->getAllBarang();
		$this->load->view("customer/dashboard", $data);
	}

	public function produk($id = '')
	{
		if (isPost()) {
			if($this->Model_Keranjang->insert()){
				echo '<script type="text/javascript">alert(\'success\');</script>';
			} else {
				echo '<script type="text/javascript">alert(\'failed\');</script>';
			}
		}

		if ($id == '') {
			$data['list_barang'] = $this->Model_Products->getAllBarang();			
			$this->load->view("customer/produk", $data);
		} else {
			$data['barang'] = $this->Model_Products->getProductById($id);
			$this->load->view("customer/detailproduk", $data);
		}
	}

	public function keranjang($action = '')
	{
		if (isPost()) {
			if ($action === 'delete') {
				if ($this->Model_Keranjang->delete()) {
					echo '<script type="text/javascript">alert(\'delete success\');</script>';
				} else {
					echo '<script type="text/javascript">alert(\'delete failed\');</script>';
				}
			}
			if ($action === 'checkout_1') {				
				$data['kode_kendaraan']	= $this->input->post('kode_kendaraan');
				$data['kendaraan']		= $this->kendaraan[$this->input->post('kode_kendaraan')];
				$data['subtotal']		= $this->input->post('subtotal');
				$data['total_sewa']		= $data['subtotal'];
				$data['transaksi']		= $this->Model_Keranjang->getTransaksi();
				$data['list_tujuan']	= $this->Model_Keranjang->getTujuan();

				$this->load->view("customer/checkout", $data);
				return;
			}
			if ($action === 'checkout_2') {
				$config['upload_path']		= './assets/uploads/jaminan/';
				$config['allowed_types']	= 'gif|jpg|png';
				$config['remove_spaces']	= TRUE;
				$config['encrypt_name']		= TRUE;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('foto_jaminan')){
					$this->session->set_flashdata('msg', '<div class="alert alert-danger text-center text-white" role="alert"><h4>'.$this->upload->display_errors().'</h4></div>');

					$data['kode_kendaraan']	= $this->input->post('kode_kendaraan');
					$data['kendaraan']		= @$this->kendaraan[$this->input->post('kode_kendaraan')];
					$data['subtotal']		= $this->input->post('subtotal');
					$data['total_sewa']		= $data['subtotal'];
					$data['transaksi']		= $this->Model_Keranjang->getTransaksi();
					$data['list_tujuan']	= $this->Model_Keranjang->getTujuan();
					$data['transaksi'] = [
						'id_transaksi'		=> $this->input->post('id_transaksi'),
						'tgl_sewa'			=> $this->input->post('tgl_sewa'),
						'tgl_pengembalian'	=> $this->input->post('tgl_pengembalian'),
						'id_tujuan'			=> $this->input->post('id_tujuan'),
						'metode_pengambilan'=> $this->input->post('metode_pengambilan'),
						'kode_kendaraan'	=> $this->input->post('kode_kendaraan'),
						'alamat_pengiriman'	=> $this->input->post('alamat_pengiriman'),
						'jarak'				=> $this->input->post('jarak'),
						'biaya_pengiriman'	=> $this->input->post('biaya_pengiriman'),
						'jaminan'			=> $this->input->post('jaminan'),
						'no_identitas'		=> $this->input->post('no_identitas'),
						'no_telp'			=> $this->input->post('no_telp'),
						'total_harga'		=> $this->input->post('total_harga'),
					];

					$this->load->view("customer/checkout", $data);
					return;
				}
				if ($this->Model_Keranjang->checkout()) {
					$data['transaksi'] = $this->Model_Keranjang->getTransaksi();
					$data['transaksi']['kendaraan'] = $this->kendaraan[$data['transaksi']['kode_kendaraan']];
					$data['detail_transaksi'] = $this->Model_Keranjang->get();
					$this->load->view("customer/checkout_detail_pemesanan", $data);
					return;
				}
			}
			if ($action === 'bayar') {
				if ($this->Model_Keranjang->bayar()) {
					echo '<script type="text/javascript">alert(\'Checkout success, silahkan bayar\');</script>';
				} else {
					echo '<script type="text/javascript">alert(\'Checkout failed\');</script>';
				}				
			}
		}
		$data['keranjang'] = $this->Model_Keranjang->get();
		$this->load->view("customer/keranjang", $data);
	}

	public function galery()
	{
		$this->load->view("customer/galery");
	}

	public function checkout_penghantaran($id_transaksi)
	{
		$data['transaksi'] = $this->Model_Keranjang->getTransaksi($id_transaksi);		
		$data['transaksi']['kendaraan'] = $this->kendaraan[$data['transaksi']['kode_kendaraan']];
		$data['detail_transaksi'] = $this->Model_Keranjang->get();
		$this->load->view("customer/checkout_detail_pemesanan", $data);
	}

	public function checkout_detail_pemesanan()
	{
		$this->load->view("customer/checkout_detail_pemesanan");
	}
}

/* End of file Customer.php */
/* Location: ./application/controllers/Customer.php */
