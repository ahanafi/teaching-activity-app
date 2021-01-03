<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cetak extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		if (!isAuthenticated()) {
			redirect('login');
		}

		$this->load->library('PDF');
	}

	public function index()
	{
		redirect(base_url('dashboard'));
	}

	public function berita_acara($id_berita_acara = null)
	{
		$beritaAcara = $this->BeritaAcara->findById([
			'id_berita_acara' => $id_berita_acara
		]);

		if(!$id_berita_acara || $id_berita_acara == '') {
			redirect(base_url('error'));
		}
		$buktiKegiatan = $this->BuktiKegiatan->findById([
			'id_berita_acara' => $id_berita_acara
		], true);

		$data = [
			'bap' => $beritaAcara,
			'dokumentasi' => $buktiKegiatan
		];

		$time = time();
		$this->pdf->setFileName('BAP-' . $time . '.pdf');
        $this->pdf->setPaper('A4', 'Potrait');
        $this->pdf->loadView('cetak/berita-acara', $data);
		//$this->load->view('cetak/berita-acara', $data);
	}

}

/* End of file Cetak.php */
