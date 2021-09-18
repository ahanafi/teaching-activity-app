<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Verifikasi extends CI_Controller
{
	public function index()
	{
		$nim = getUser('username');
		$mahasiswa = $this->Mahasiswa->findById(['nim' => $nim]);

		$beritaAcara = $this->BeritaAcara
			->setWherePosition('jadwal')
			->findById([
				'id_kelas' => $mahasiswa->id_kelas
			], true);

		return $this->main_lib->getTemplate('verifikasi/index', [
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

		$buktiKegiatan = $this->BuktiKegiatan->findById([
			'id_berita_acara' => $idBeritaAcara
		], true);

		$data = [
			'bap' => $beritaAcara,
			'dokumentasi' => $buktiKegiatan
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
				$postData = $this->getPostData('mahasiswa');
				$postData['id_berita_acara'] = $idBeritaAcara;

				if ($this->Verifikasi->insert($postData)) {
					$messages = setArrayMessage('success', 'insert', 'jadwal kuliah');
				} else {
					$messages = setArrayMessage('error', 'insert', 'jadwal kuliah');
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
			];
		}
	}
}
