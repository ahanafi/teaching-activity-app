<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{

	public function index()
	{
		$nim = getUser('username');
		$mahasiswa = $this->Mahasiswa->findById(['nim' => $nim]);

		$beritaAcara = $this->BeritaAcara->findById(['jadwal.id_kelas' => $mahasiswa->id_kelas], true);

		return $this->main_lib->getTemplate('berita-acara/index', [
			'berita_acara' => $beritaAcara,
			'nomor' => 1
		]);
	}
}
