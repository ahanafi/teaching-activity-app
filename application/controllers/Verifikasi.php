<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if(!isAuthenticated()) {
			redirect(base_url('login'));
		}
	}

	public function index()
	{
		if (getUser('level') === 'MAHASISWA') {
			$nim = getUser('username');
			$mahasiswa = $this->Mahasiswa->findById(['nim' => $nim]);

			$beritaAcara = $this->BeritaAcara
				->setWherePosition('jadwal')
				->findById([
					'id_kelas' => $mahasiswa->id_kelas
				], true);
		}

		if (getUser('level') === 'KAPRODI') {
			$nidn = getUser('username');
			$dosen = $this->Dosen->findById(['nidn' => $nidn]);

			$beritaAcara = $this->BeritaAcara
				->setWherePosition('jadwal')
				->findById([
					'dosen.id_program_studi' => $dosen->id_program_studi
				], true);
		}

		$this->main_lib->getTemplate('verifikasi/index', [
			'berita_acara' => $beritaAcara,
			'nomor' => 1
		]);
	}

	public function detail($idBeritaAcara = null)
	{
		$beritaAcara = $this->BeritaAcara
			->setWherePosition('berita_acara')
			->findById([
				'id_berita_acara' => $idBeritaAcara
			]);

		if (!$beritaAcara || $idBeritaAcara === '') {
			redirect(base_url('error'));
		}

		$buktiKegiatan = $this->BuktiKegiatan->findById(['id_berita_acara' => $idBeritaAcara], true);
		$verifikasi = $this->Verifikasi->findById(['id_berita_acara' => $idBeritaAcara]);

		$dosen = $this->Dosen->findById(['dosen.id_dosen' => $beritaAcara->id_dosen]);

		$data = [
			'bap' => $beritaAcara,
			'dosen' => $dosen,
			'dokumentasi' => $buktiKegiatan,
			'verifikasi' => $verifikasi,
			'label' => getUser('level') === 'MAHASISWA' ? 'NIM' : 'NIDN',
		];

		$this->main_lib->getTemplate("verifikasi/detail", $data);
	}

	public function verify($idBeritaAcara)
	{
		if (!checkSignature()) {
			$this->session->set_flashdata('message', [
				'type' => 'warning',
				'text' => 'Mohon unggah tanda tangan digital terlebih dahulu!'
			]);
			redirect(base_url('verifikasi-bap/detail/' . $idBeritaAcara), 'refresh');
		}

		if (isset($_POST['verify']) && $idBeritaAcara !== '') {
			$this->form_validation->set_rules('sesuai_rps', 'Kesesuaian RPS', 'required');
			if ($this->form_validation->run() === TRUE) {
				$verifikator = $this->main_lib->getPost('verifikator');
				$postData = $this->getPostData($verifikator);
				$postData['id_berita_acara'] = $idBeritaAcara;

				$insertOrUpdate = ($this->Verifikasi->getBy('id_berita_acara', $idBeritaAcara) !== null)
					? $this->Verifikasi->update($postData, ['id_berita_acara' => $idBeritaAcara])
					: $this->Verifikasi->insert($postData);

				if(strtolower($verifikator) === 'kaprodi') {
					$this->BeritaAcara->updateStatus($idBeritaAcara);
				}

				if ($insertOrUpdate) {
					$messages = setArrayMessage('success', 'update', 'verifikasi BAP');
				} else {
					$messages = setArrayMessage('error', 'update', 'verifikasi BAP');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('verifikasi-bap'), 'refresh');
			} else {
				$this->detail($idBeritaAcara);
			}
		} else {
			redirect(base_url('verifikasi-bap'));
		}
	}

	private function getPostData($sender = 'mahasiswa')
	{
		if ($sender === 'mahasiswa') {
			return [
				'nim_verifikator' => $this->main_lib->getPost('nim'),
				'catatan_mahasiswa' => $this->main_lib->getPost('catatan'),
				'sesuai_rps_mahasiswa' => $this->main_lib->getPost('sesuai_rps'),
			];
		}

		if ($sender === 'kaprodi') {
			return [
				'nidn_verifikator' => $this->main_lib->getPost('nidn'),
				'catatan_kaprodi' => $this->main_lib->getPost('catatan'),
				'sesuai_rps_kaprodi' => $this->main_lib->getPost('sesuai_rps'),
				'tanggal_periksa' => date('Y-m-d H:i:s')
			];
		}
	}
}
