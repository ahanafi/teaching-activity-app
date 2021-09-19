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

	public function berita_acara($idBeritaAcara = null)
	{
		$beritaAcara = $this->BeritaAcara->findById([
			'id_berita_acara' => $idBeritaAcara
		]);

		if(!$idBeritaAcara || $idBeritaAcara === '') {
			redirect(base_url('error'));
		}

		$buktiKegiatan = $this->BuktiKegiatan->findById([
			'id_berita_acara' => $idBeritaAcara
		], true);
		$verifikasi = $this->Verifikasi->findById(['id_berita_acara' => $idBeritaAcara]);

		$dosen = $this->Dosen->findById(['dosen.id_dosen' => $beritaAcara->id_dosen]);

		$data = [
			'bap' => $beritaAcara,
			'dokumentasi' => $buktiKegiatan,
			'verifikasi' => $verifikasi,
			'paraf_dosen' => $dosen->paraf
		];

		$time = time();
		$this->pdf->setFileName('BAP-' . $time . '.pdf');
        $this->pdf->setPaper('A4', 'Potrait');
        $this->pdf->loadView('cetak/berita-acara', $data);
		//$this->load->view('cetak/berita-acara', $data);
	}

}

/* End of file Cetak.php */
