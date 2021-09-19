<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Import extends CI_Controller
{
	private $uploadConfig;

	public function __construct()
	{
		parent::__construct();
		$this->uploadConfig = [
			'upload_path' => './uploads/imports/',
			'allowed_types' => 'xls|xlsx',
			'file_ext_tolower' => TRUE,
			'encrypt_name' => TRUE
		];

		$this->load->library('upload');
		$this->upload->initialize($this->uploadConfig);

		if (!isAuthenticated()) {
			redirect('login');
		}
	}

	public function download_samples($type)
	{
		if($type === 'dosen' || $type === 'mahasiswa' || $type === 'mata-kuliah') {
			$pathFile = FCPATH . 'examples/format-' . $type . '.xlsx';
			if(file_exists($pathFile)) {
				$this->load->helper('download');
				$fileName = 'Format-Import-Data-' . ucfirst($type) . '.xlsx';
				force_download($fileName, file_get_contents($pathFile));
			} else {
				$this->session->set_flashdata('message', [
					'type' => 'error',
					'text' => 'File tidak ditemukan.'
				]);
				redirect(base_url(strtolower($type)), 'refresh');
			}
		}

		$this->session->set_flashdata('message', [
			'type' => 'error',
			'text' => 'File tidak ditemukan.'
		]);
		redirect(base_url('error-page'), 'refresh');
	}

	public function mata_kuliah()
	{
		if (isset($_POST['import'])) {
			if ($this->upload->do_upload('file')) {
				$uploadedData = $this->upload->data();
				$uploadedFile = $uploadedData['full_path'];
				$reader = new Xlsx();
				$spreadsheet = $reader->load($uploadedFile);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				$dataMK = [];

				for ($i = 1, $iMax = count($sheetData); $i < $iMax; $i++) {
					$kodeMK = $sheetData[$i][1];
					if($kodeMK !== '') {
						$checkMK = $this->MataKuliah->getBy('kode_mata_kuliah', $kodeMK);
						if (!$checkMK) {
							$dataMK[] = [
								'kode_mata_kuliah' => $kodeMK,
								'nama_mata_kuliah' => $sheetData[$i][2],
								'sks' => $sheetData[$i][3],
							];
						}
					}
				}

				unlink($uploadedFile);

				$insertMK = $this->MataKuliah->insert($dataMK, true);

				if ($insertMK) {
					$messages = setArrayMessage('success', 'import', 'mata-kuliah');
				} else {
					$messages = setArrayMessage('error', 'import', 'mata-kuliah');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('mata-kuliah'), 'refresh');

			} else {
				$error = $this->upload->display_errors("", "");
				$error = str_replace(" ", "-", $error);
				redirect(base_url('mata-kuliah') . '?show_modal=true&errmsg=' . $error);
			}
		} else {
			redirect(base_url('mata-kuliah'));
		}
	}

	public function dosen()
	{
		if (isset($_POST['import'])) {
			if ($this->upload->do_upload('file')) {
				$uploadedData = $this->upload->data();
				$uploadedFile = $uploadedData['full_path'];
				$reader = new Xlsx();
				$spreadsheet = $reader->load($uploadedFile);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				$dataDosen = [];
				$userDosen = [];

				for ($i = 1, $iMax = count($sheetData); $i < $iMax; $i++) {
					$idProgramStudi = NULL;
					if ($sheetData[$i][4] !== '') {
						$checkProdi = $this->ProgramStudi->whereLike('nama_program_studi', $sheetData[$i][4]);
						if ($checkProdi) {
							$idProgramStudi = $checkProdi->id_program_studi;
						}
					}

					$nidn = $sheetData[$i][1];
					$checkDosen = $this->Dosen->getBy('nidn', $nidn);
					if (!$checkDosen) {
						$dataDosen[] = [
							'nidn' => $nidn,
							'nama_lengkap' => $sheetData[$i][2],
							'jenis_kelamin' => $sheetData[$i][3],
							'id_program_studi' => $idProgramStudi,
							'gelar' => $sheetData[$i][5],
						];

						$userDosen[] = [
							'username' => $nidn,
							'nama_lengkap' => strtoupper($sheetData[$i][2]),
							'password' => password_hash($nidn, PASSWORD_DEFAULT),
							'level' => 'DOSEN',
							'id_dosen' => NULL
						];
					}
				}

				unlink($uploadedFile);

				$insertDosen = $this->Dosen->insert($dataDosen, true);
				$insertUser = $this->User->insert($userDosen, true);

				if ($insertUser && $insertDosen) {
					$messages = setArrayMessage('success', 'import', 'dosen');
				} else {
					$messages = setArrayMessage('error', 'import', 'dosen');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('dosen'), 'refresh');

			} else {
				$error = $this->upload->display_errors("", "");
				$error = str_replace(" ", "-", $error);
				redirect(base_url('dosen') . '?show_modal=true&errmsg=' . $error);
			}
		} else {
			redirect(base_url('dosen'));
		}
	}

	public function mahasiswa()
	{
		if (isset($_POST['import'])) {
			if ($this->upload->do_upload('file')) {
				$uploadedData = $this->upload->data();
				$uploadedFile = $uploadedData['full_path'];
				$reader = new Xlsx();
				$spreadsheet = $reader->load($uploadedFile);
				$sheetData = $spreadsheet->getActiveSheet()->toArray();
				$dataMahasiswa = [];
				$userMahasiswa = [];

				for ($i = 1, $iMax = count($sheetData); $i < $iMax; $i++) {
					$nim = $sheetData[$i][1];

					//dd($sheetData[$i]);
					$checkMahasiswa = $this->Mahasiswa->getBy('nim', $nim);
					if (!$checkMahasiswa) {

						//Check kelas
						$idKelas = $this->getOrInsertKelas($sheetData[$i][4]);
						$dataMahasiswa[] = [
							'nim' => $nim,
							'nama_lengkap' => $sheetData[$i][2],
							'jenis_kelamin' => $sheetData[$i][3],
							'id_kelas' => $idKelas,
						];

						$userMahasiswa[] = [
							'username' => $nim,
							'nama_lengkap' => strtoupper($sheetData[$i][2]),
							'password' => password_hash($nim, PASSWORD_DEFAULT),
							'level' => 'MAHASISWA',
							'id_dosen' => NULL
						];
					}
				}

				unlink($uploadedFile);

				$insertMahasiswa = $this->Mahasiswa->insert($dataMahasiswa, true);
				$insertUser = $this->User->insert($userMahasiswa, true);

				if ($insertUser && $insertMahasiswa) {
					$messages = setArrayMessage('success', 'import', 'mahasiswa');
				} else {
					$messages = setArrayMessage('error', 'import', 'mahasiswa');
				}

				$this->session->set_flashdata('message', $messages);
				redirect(base_url('mahasiswa'), 'refresh');

			} else {
				$error = $this->upload->display_errors("", "");
				$error = str_replace(" ", "-", $error);
				redirect(base_url('mahasiswa') . '?show_modal=true&errmsg=' . $error);
			}
		} else {
			redirect(base_url('mahasiswa'));
		}
	}

	private function getOrInsertKelas($kelas)
	{
		$separator = contains('/', $kelas) ? '/' : '-';
		$splitKelas = explode($separator, $kelas);
		$namaKelas = $splitKelas[0];
		$semester = $splitKelas[1];

		$queryCheckKelas = $this->Kelas->customQuery("SELECT * FROM kelas WHERE nama_kelas LIKE '%$namaKelas%' AND semester = '$semester'", false);
		if ($queryCheckKelas) {
			return $queryCheckKelas->id_kelas;
		} else {
			$prodi = getProdiByCode($namaKelas);
			$prodi = $this->ProgramStudi->getBy('nama_program_studi', $prodi);
			$idProdi = $prodi->id_program_studi;

			$this->Kelas->insert([
				'nama_kelas' => $namaKelas,
				'id_program_studi' => $idProdi,
				'semester' => $semester,
			]);

			return $this->Kelas->getLastInsertId('id_kelas');
		}

	}
}
