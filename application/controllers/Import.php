<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class Import extends CI_Controller
{
	private $uploadConfig = array();

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

	public function dosen()
	{
		if (isset($_POST['import'])) {
			if ($this->upload->do_upload('file')) {
				$uploadedData = $this->upload->data();
				$fileName = $uploadedData['file_name'];
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
					if(!$checkDosen) {
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

				if($insertUser && $insertDosen){
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
}
